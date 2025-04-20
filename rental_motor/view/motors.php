<?php
require_once '../class/Motor.php';

$motor = new Motor();

$motors = $motor->getAll();

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $motor->delete($id);
    header("Location: motors.php"); // Biar refresh dan update data
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar motor</title>
</head>
<body>
    <h2>Daftar motor</h2>
    <a class="button" href="add_motor.php">+ Tambah motor</a>
    <table border="1" cellpadding="5">
        <thead>
            <tr><th>No</th>
                <th>Merk</th>
                <th>Plat Nomor</th>
                <th>Tipe</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($motors as $m) {
                echo "<tr>
                    <td>{$no}</td>
                    <td>{$m['merk']}</td>
                    <td>{$m['plat_nomor']}</td>
                    <td>{$m['tipe']}</td>
                    <td>
                        <a href='edit_motor.php?id={$m['id']}'>Edit</a>
                        <a href='?page=motors&delete=" . $m['id'] . "' onclick=\"return confirm('Yakin mau hapus motor ini?')\">Delete</a>
                    </td>
                </tr>";
                $no++;
            }            
            if ($no === 1) {
                echo "<tr><td colspan='5'>Belum ada motor</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="../index.php">← Kembali ke Beranda</a>
</body>
</html>
