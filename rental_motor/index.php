<?php
require_once 'class/Motor.php';
require_once 'class/Member.php';
require_once 'class/Rental.php';

$motor = new Motor();
$member = new Member();
$rental = new Rental();

$motors = $motor->getAll();
$members = $member->getAll();
$rentals = $rental->getAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rental Motor</title>
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f5f5f5; }
        h1, h2 { color: #333; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
        th, td { border: 1px solid #aaa; padding: 10px; text-align: left; }
        th { background-color: #ddd; }
        a.button {
            padding: 8px 14px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<h1>Selamat Datang di Rental Motor</h1>

<h2>Motor</h2>
<a class="button" href="view/add_motor.php">+ Tambah Motor</a>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Merk</th>
            <th>Tipe</th>
            <th>Plat Nomor</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($motors as $m) {
                echo "<tr>
                    <td>{$no}</td>
                    <td>{$m['merk']}</td>
                    <td>{$m['tipe']}</td>
                    <td>{$m['plat_nomor']}</td>
                    <td>{$m['status']}</td>
                </tr>";
                $no++;
            }
        if ($no === 1) {
            echo "<tr><td colspan='5'>Tidak ada motor tersedia</td></tr>";
        }
        ?>
    </tbody>
</table>

<h2>Daftar Member</h2>
<a class="button" href="view/add_member.php">+ Tambah Member</a>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($members as $m) {
            echo "<tr>
                <td>{$no}</td>
                <td>{$m['nama']}</td>
                <td>{$m['alamat']}</td>
                <td>{$m['no_hp']}</td>
            </tr>";
            $no++;
        }
        if ($no === 1) {
            echo "<tr><td colspan='4'>Belum ada member</td></tr>";
        }
        ?>
    </tbody>
</table>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Penyewaan Motor</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { color: #343a40; text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #007bff; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .btn { 
            padding: 6px 12px; 
            text-decoration: none; 
            border-radius: 4px; 
            font-size: 14px;
        }
        .btn-edit { background-color: #ffc107; color: #212529; }
        .btn-delete { background-color: #dc3545; color: white; }
        .btn-add { 
            display: inline-block; 
            margin-bottom: 20px; 
            background-color: #28a745; 
            color: white;
            padding: 10px 15px;
        }
        .status-available { color: #28a745; font-weight: bold; }
        .status-rented { color: #dc3545; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Penyewaan Motor</h1>
        
        <a href="view/add_rental.php" class="btn btn-add">+ Tambah Penyewaan Baru</a>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penyewa</th>
                    <th>Motor</th>
                    <th>Plat Nomor</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rentals)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">Tidak ada data penyewaan</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($rentals as $index => $rental): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($rental['nama_member']) ?></td>
                            <td><?= htmlspecialchars($rental['merk'] . ' ' . $rental['tipe']) ?></td>
                            <td><?= htmlspecialchars($rental['plat_nomor']) ?></td>
                            <td><?= date('d-m-Y', strtotime($rental['tanggal_pinjam'])) ?></td>
                            <td>
                                <?= $rental['tanggal_kembali'] ? date('d-m-Y', strtotime($rental['tanggal_kembali'])) : 'Belum Kembali' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>