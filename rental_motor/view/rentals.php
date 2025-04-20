<?php
require_once '../class/Rental.php';
$rental = new Rental();
$rentals = $rental->getAll();
?>

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
        
        <a href="add_rental.php" class="btn btn-add">+ Tambah Penyewaan Baru</a>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penyewa</th>
                    <th>Motor</th>
                    <th>Plat Nomor</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
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
                            <td>
                                <a href="edit_rental.php?id=<?= $rental['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="delete_rental.php?id=<?= $rental['id'] ?>" class="btn btn-delete" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
<a href="../index.php">Beranda</a>
</html>