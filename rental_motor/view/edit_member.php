<?php
require_once '../class/Member.php';

$member = new Member();

if (!isset($_GET['id'])) {
    header("Location: members.php");
    exit;
}

$id = $_GET['id'];
$data = $member->getById($id);

if (!$data) {
    echo "Member tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    if ($member->update($id, $nama, $alamat, $no_hp)) {
        header("Location: members.php");
        exit;
    } else {
        echo "Gagal update data!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Member</title>
</head>
<body>
    <h2>Edit Member</h2>
    <form method="POST">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required><br><br>
        
        <label>Alamat:</label><br>
        <input type="text" name="alamat" value="<?= htmlspecialchars($data['alamat']) ?>" required><br><br>
        
        <label>No HP:</label><br>
        <input type="text" name="no_hp" value="<?= htmlspecialchars($data['no_hp']) ?>" required><br><br>
        
        <button type="submit">Update</button>
        <a href="members.php">Batal</a>
    </form>
</body>
</html>
