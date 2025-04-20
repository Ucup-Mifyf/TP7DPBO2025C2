<?php
require_once '../class/Member.php';

$member = new Member();

$members = $member->getAll();

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $member->delete($id);
    header("Location: members.php"); // Biar refresh dan update data
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Member</title>
</head>
<body>
    <h2>Daftar Member</h2>
    <a class="button" href="add_member.php">+ Tambah Member</a>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
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
                    <td>
                        <a href='edit_member.php?id={$m['id']}'>Edit</a>
                        <a href='?page=members&delete=" . $m['id'] . "' onclick=\"return confirm('Yakin mau hapus member ini?')\">Delete</a>
                    </td>
                </tr>";
                $no++;
            }            
            if ($no === 1) {
                echo "<tr><td colspan='5'>Belum ada member</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="../index.php">← Kembali ke Beranda</a>
</body>
</html>
