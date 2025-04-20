<?php
require_once __DIR__ . '/../config/db.php';


class Member {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM members");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM members WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nama, $alamat, $no_hp) {
        $stmt = $this->conn->prepare("INSERT INTO members (nama, alamat, no_hp) VALUES (?, ?, ?)");
        return $stmt->execute([$nama, $alamat, $no_hp]);
    }

    public function update($id, $nama, $alamat, $no_hp) {
        $stmt = $this->conn->prepare("UPDATE members SET nama = ?, alamat = ?, no_hp = ? WHERE id = ?");
        return $stmt->execute([$nama, $alamat, $no_hp, $id]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM members WHERE id = :id";
        $stmt = $this->conn->prepare($query); // ganti dari $this->db ke $this->conn
        $stmt->bindParam(':id', $id);
    
        if (!$stmt->execute()) {
            var_dump($stmt->errorInfo()); // Bisa dihapus kalau udah yakin
            return false;
        }
    
        return true;
    }     
    
    public function search($keyword) {
        $stmt = $this->conn->prepare("SELECT * FROM members WHERE nama LIKE ?");
        $stmt->execute(["%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
