<?php
require_once '../class/Rental.php';
require_once '../class/Member.php';
require_once '../class/Motor.php';

$rental = new Rental();
$member = new Member();
$motor = new Motor();

$members = $member->getAll();
$motors = $motor->getAll();

// Proses form saat disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $member_id = $_POST['member_id'];
    $motor_id = $_POST['motor_id'];
    $tanggal_pinjam = date('Y-m-d');
    $tanggal_kembali = null; // Set default null untuk tanggal kembali

    if ($rental->create($member_id, $motor_id, $tanggal_pinjam, $tanggal_kembali)) {
        // Update status motor jadi "dipinjam"
        $motor->setStatus($motor_id, 'dipinjam');
        echo "<script>
            alert('Berhasil membuat data rental!'); 
            window.location='../index.php'; // Pastikan path benar
        </script>";
        exit(); // Pastikan tidak ada output lain setelah redirect
    } else {
        echo "<script>alert('Gagal membuat rental!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Rental</title>
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f5f5f5; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 500px; margin: auto; }
        label { display: block; margin-top: 10px; }
        select, button { width: 100%; padding: 8px; margin-top: 5px; }
        button { background-color: #007bff; color: white; border: none; border-radius: 4px; margin-top: 20px; }
        a { text-decoration: none; display: inline-block; margin-top: 15px; color: #007bff; }
        .action-links { margin-top: 20px; }
    </style>
</head>
<body>

<h2>Form Peminjaman Motor</h2>

<form method="POST" action="">
    <label for="member_id">Pilih Member:</label>
    <select name="member_id" required>
        <option value="">-- Pilih Member --</option>
        <?php foreach ($members as $m): ?>
            <option value="<?= $m['id']; ?>"><?= htmlspecialchars($m['nama']); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="motor_id">Pilih Motor:</label>
    <select name="motor_id" required>
        <option value="">-- Pilih Motor Tersedia --</option>
        <?php foreach ($motors as $m): ?>
            <?php if ($m['status'] === 'tersedia'): ?>
                <option value="<?= $m['id']; ?>">
                    <?= htmlspecialchars($m['merk'] . ' - ' . $m['plat_nomor']); ?>
                </option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>

    <button type="submit">Simpan Rental</button>
</form>

<div class="action-links">
    <a href="../index.php">← Kembali</a>
    <tr>
    <a href="rentals.php"><u>Edit</u></a>
            </tr>
</div>

</body>
</html>