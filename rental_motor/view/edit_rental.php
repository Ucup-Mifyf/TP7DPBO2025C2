<?php
require_once '../class/Rental.php';
require_once '../class/Member.php';
require_once '../class/Motor.php';

$rentalObj = new Rental();
$memberObj = new Member();
$motorObj = new Motor();

$id = $_GET['id'] ?? null;
$rental = $rentalObj->getById($id);

if (!$rental) {
    header("Location: rentals.php");
    exit();
}

$members = $memberObj->getAll();
$motors = $motorObj->getAll();

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $member_id = $_POST['member_id'];
    $motor_id = $_POST['motor_id'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'] ?? null;

    // Update data rental
    if ($rentalObj->update($id, $member_id, $motor_id, $tanggal_pinjam, $tanggal_kembali)) {
        // Jika motor diganti, update status motor lama dan baru
        if ($rental['motor_id'] != $motor_id) {
            $motorObj->setStatus($rental['motor_id'], 'tersedia');
            $motorObj->setStatus($motor_id, 'dipinjam');
        }
        
        $message = "Data penyewaan berhasil diperbarui!";
        $rental = $rentalObj->getById($id); // Refresh data
    } else {
        $error = "Gagal memperbarui data penyewaan";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Penyewaan Motor</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #343a40; text-align: center; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        select, input { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        input[type="date"] { padding: 7px; }
        .btn { 
            padding: 8px 15px; 
            background-color: #007bff; 
            color: white; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-back { background-color: #6c757d; }
        .message { padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data Penyewaan</h2>
        
        <?php if ($message): ?>
            <div class="message success"><?= $message ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="message error"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="member_id">Nama Member</label>
                <select name="member_id" id="member_id" required>
                    <option value="">-- Pilih Member --</option>
                    <?php foreach ($members as $member): ?>
                        <option value="<?= $member['id'] ?>" <?= $member['id'] == $rental['member_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($member['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="motor_id">Motor</label>
                <select name="motor_id" id="motor_id" required>
                    <option value="">-- Pilih Motor --</option>
                    <?php foreach ($motors as $motor): ?>
                        <option value="<?= $motor['id'] ?>" <?= $motor['id'] == $rental['motor_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($motor['merk'] . ' ' . $motor['tipe'] . ' (' . $motor['plat_nomor'] . ')') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" 
                       value="<?= $rental['tanggal_pinjam'] ?>" required>
            </div>
            
            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali (Opsional)</label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali" 
                       value="<?= $rental['tanggal_kembali'] ?? '' ?>">
            </div>
            
            <button type="submit" class="btn">Simpan Perubahan</button>
            <a href="rentals.php" class="btn btn-back">Kembali</a>
        </form>
    </div>
</body>
</html>