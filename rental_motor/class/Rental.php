<?php
require_once __DIR__ . '/../config/db.php';

class Rental {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("
            SELECT r.*, m.nama as nama_member, mo.merk, mo.tipe, mo.plat_nomor
            FROM rentals r
            JOIN members m ON r.member_id = m.id
            JOIN motors mo ON r.motor_id = mo.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM rentals WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($member_id, $motor_id, $tanggal_pinjam, $tanggal_kembali) {
        // insert ke rentals
        $stmt = $this->conn->prepare("INSERT INTO rentals (member_id, motor_id, tanggal_pinjam, tanggal_kembali) VALUES (?, ?, ?, ?)");
        $success = $stmt->execute([$member_id, $motor_id, $tanggal_pinjam, $tanggal_kembali]);

        // update status motor jadi 'rented'
        if ($success) {
            $stmt2 = $this->conn->prepare("UPDATE motors SET status = 'rented' WHERE id = ?");
            $stmt2->execute([$motor_id]);
        }

        return $success;
    }

    public function update($id, $member_id, $motor_id, $tanggal_pinjam, $tanggal_kembali) {
        $stmt = $this->conn->prepare("UPDATE rentals SET member_id = ?, motor_id = ?, tanggal_pinjam = ?, tanggal_kembali = ? WHERE id = ?");
        return $stmt->execute([$member_id, $motor_id, $tanggal_pinjam, $tanggal_kembali, $id]);
    }

    public function delete($id) {
        // ambil motor_id dulu buat balikin status ke 'available'
        $stmt = $this->conn->prepare("SELECT motor_id FROM rentals WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $motor_id = $result['motor_id'];

            // delete rental
            $stmt2 = $this->conn->prepare("DELETE FROM rentals WHERE id = ?");
            $success = $stmt2->execute([$id]);

            if ($success) {
                // balikin status motor
                $stmt3 = $this->conn->prepare("UPDATE motors SET status = 'available' WHERE id = ?");
                $stmt3->execute([$motor_id]);
            }

            return $success;
        }

        return false;
    }

    public function search($keyword) {
        $stmt = $this->conn->prepare("
            SELECT r.*, m.nama as nama_member, mo.merk, mo.tipe
            FROM rentals r
            JOIN members m ON r.member_id = m.id
            JOIN motors mo ON r.motor_id = mo.id
            WHERE m.nama LIKE ? OR mo.merk LIKE ? OR mo.tipe LIKE ?
        ");
        $stmt->execute(["%$keyword%", "%$keyword%", "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
