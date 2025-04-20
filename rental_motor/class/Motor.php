<?php
require_once __DIR__ . '/../config/db.php';

class Motor {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM motors");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM motors WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($merk, $tipe, $plat_nomor, $status = 'available') {
        $stmt = $this->conn->prepare("INSERT INTO motors (merk, tipe, plat_nomor, status) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$merk, $tipe, $plat_nomor, $status]);
    }

    public function update($id, $merk, $tipe, $plat_nomor, $status) {
        $stmt = $this->conn->prepare("UPDATE motors SET merk = ?, tipe = ?, plat_nomor = ?, status = ? WHERE id = ?");
        return $stmt->execute([$merk, $tipe, $plat_nomor, $status, $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM motors WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function search($keyword) {
        $stmt = $this->conn->prepare("SELECT * FROM motors WHERE merk LIKE ? OR tipe LIKE ?");
        $stmt->execute(["%$keyword%", "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setStatus($id, $status) {
        $stmt = $this->conn->prepare("UPDATE motors SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
?>
