<?php
require_once '../class/Motor.php';

$motor = new Motor();
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $merk = $_POST['merk'];
    $tipe = $_POST['tipe'];
    $plat_nomor = $_POST['plat_nomor'];
    $status = 'tersedia'; // default status saat nambah motor baru

    if ($motor->create($merk, $tipe, $plat_nomor, $status)) {
        $message = "Motor berhasil ditambahkan!";
    } else {
        $message = "Gagal menambahkan motor.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Motor</title>
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f7f7f7; }
        h2 { color: #444; }
        form { max-width: 400px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 20px; background-color: #28a745; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .message { margin-bottom: 15px; color: green; }
        a { display: inline-block; margin-top: 15px; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>

<h2>Tambah Motor Baru</h2>

<?php if ($message): ?>
    <p class="message"><?= $message ?></p>
<?php endif; ?>

<form action="" method="post">
    <label for="merk">Merk Motor:</label>
    <input type="text" name="merk" id="merk" required>

    <label for="tipe">Tipe Motor:</label>
    <input type="text" name="tipe" id="tipe" required>

    <label for="plat_nomor">Plat Nomor:</label>
    <input type="text" name="plat_nomor" id="plat_nomor" required>

    <button type="submit">Simpan</button>
    <a href="motors.php">Edit</a>
</form>

<a href="../index.php">← Kembali ke Beranda</a>

</body>
</html>
