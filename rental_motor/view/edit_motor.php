<?php
require_once '../class/Motor.php';

$motor = new Motor();
$message = '';

// Ambil data motor berdasarkan ID
$id = isset($_GET['id']) ? $_GET['id'] : null;
$motor_data = $id ? $motor->getById($id) : null;

if (!$motor_data) {
    header("Location: ../index.php");
    exit();
}

// Proses form update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $merk = $_POST['merk'];
    $tipe = $_POST['tipe'];
    $plat_nomor = $_POST['plat_nomor'];
    $status = $_POST['status'];

    if ($motor->update($id, $merk, $tipe, $plat_nomor, $status)) {
        $message = "Motor berhasil diperbarui!";
        $motor_data = $motor->getById($id); // Refresh data
    } else {
        $message = "Gagal memperbarui motor.";
    }
}

// Proses delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    if ($motor->delete($id)) {
        header("Location: ../index.php?message=Motor+berhasil+dihapus");
        exit();
    } else {
        $message = "Gagal menghapus motor.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Motor</title>
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f7f7f7; }
        h2 { color: #444; }
        form { max-width: 400px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input[type="text"], select { 
            width: 100%; 
            padding: 8px; 
            margin-bottom: 16px; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
        }
        button { 
            padding: 10px 20px; 
            color: #fff; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            margin-right: 10px;
        }
        .update-btn { background-color: #28a745; }
        .delete-btn { background-color: #dc3545; }
        .message { margin-bottom: 15px; color: green; }
        .error { color: #dc3545; }
        a { display: inline-block; margin-top: 15px; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>

<h2>Edit Motor</h2>

<?php if ($message): ?>
    <p class="message"><?= $message ?></p>
<?php endif; ?>

<form action="" method="post">
    <label for="merk">Merk Motor:</label>
    <input type="text" name="merk" id="merk" value="<?= htmlspecialchars($motor_data['merk']) ?>" required>

    <label for="tipe">Tipe Motor:</label>
    <input type="text" name="tipe" id="tipe" value="<?= htmlspecialchars($motor_data['tipe']) ?>" required>

    <label for="plat_nomor">Plat Nomor:</label>
    <input type="text" name="plat_nomor" id="plat_nomor" value="<?= htmlspecialchars($motor_data['plat_nomor']) ?>" required>

    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="tersedia" <?= $motor_data['status'] == 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
        <option value="dipinjam" <?= $motor_data['status'] == 'dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
        <option value="servis" <?= $motor_data['status'] == 'servis' ? 'selected' : '' ?>>Servis</option>
    </select>

    <div style="margin-top: 20px;">
        <button type="submit" name="update" class="update-btn">Update Motor</button>
        <button type="submit" name="delete" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus motor ini?')">Hapus Motor</button>
    </div>
</form>

<a href="../index.php">← Kembali ke Beranda</a>

</body>
</html>