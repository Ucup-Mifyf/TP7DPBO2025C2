<?php
require_once '../class/Member.php';

$member = new Member();
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];

    if ($member->create($nama, $alamat, $no_telp)) {
        $message = "Member berhasil ditambahkan!";
    } else {
        $message = "Gagal menambahkan member.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Member</title>
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f7f7f7; }
        h2 { color: #444; }
        form { max-width: 400px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .message { margin-bottom: 15px; color: green; }
        a { display: inline-block; margin-top: 15px; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>

<h2>Tambah Member Baru</h2>

<?php if ($message): ?>
    <p class="message"><?= $message ?></p>
<?php endif; ?>

<form action="" method="post">
    <label for="nama">Nama Member:</label>
    <input type="text" name="nama" id="nama" required>

    <label for="alamat">Alamat:</label>
    <input type="text" name="alamat" id="alamat" required>

    <label for="no_telp">No. Telepon:</label>
    <input type="text" name="no_telp" id="no_telp" required>

    <button type="submit">Simpan</button>
    <a href="members.php">Edit</a>
</form>

<a href="../index.php">← Kembali ke Beranda</a>

</body>
</html>
