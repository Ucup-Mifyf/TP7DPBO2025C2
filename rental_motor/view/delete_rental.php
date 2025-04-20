<?php
require_once '../class/Rental.php';
require_once '../class/Motor.php';

$rentalObj = new Rental();
$motorObj = new Motor();

$id = $_GET['id'] ?? null;

if ($id) {
    // Dapatkan data rental sebelum dihapus
    $rental = $rentalObj->getById($id);
    
    if ($rental && $rentalObj->delete($id)) {
        // Kembalikan status motor ke 'tersedia'
        $motorObj->setStatus($rental['motor_id'], 'tersedia');
        header("Location: rentals.php?success=Data+penyewaan+berhasil+dihapus");
    } else {
        header("Location: rentals.php?error=Gagal+menghapus+data+penyewaan");
    }
} else {
    header("Location: rentals.php?error=ID+tidak+valid");
}
exit();