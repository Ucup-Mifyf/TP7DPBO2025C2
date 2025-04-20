# Sistem Rental Motor - Dokumentasi

## Deskripsi Proyek
Sistem Rental Motor adalah aplikasi web berbasis PHP untuk mengelola penyewaan motor. Sistem ini memungkinkan:
- Manajemen data motor
- Manajemen data member
- Proses penyewaan motor
- Pelacakan status rental

## Fitur Utama
- **Manajemen Motor**:
  - Tambah, edit, hapus data motor
  - Update status motor (tersedia/dipinjam)
  
- **Manajemen Member**:
  - Registrasi member baru
  - Edit data member

- **Proses Rental**:
  - Peminjaman motor oleh member
  - Pengembalian motor
  - Histori penyewaan

## Struktur File
```
/rental-motor/
├── class/
│   ├── Rental.php
│   ├── Member.php
│   ├── Motor.php
├── config/
│   └── db.php
├── pages/
│   ├── add_motor.php
│   ├── edit_motor.php
│   ├── add_member.php
│   ├── edit_member.php
│   ├── add_rental.php
│   ├── edit_rental.php
│   ├── rentals.php
├── index.php
└── README.md
```

## Instalasi
1. Clone repository:
   ```bash
   git clone https://github.com/username/rental-motor.git
   ```

2. Buat database baru dan import SQL:
   ```sql
   CREATE DATABASE rental_motor;
   USE rental_motor;
   
   CREATE TABLE motors (
       id INT AUTO_INCREMENT PRIMARY KEY,
       merk VARCHAR(50) NOT NULL,
       tipe VARCHAR(50) NOT NULL,
       plat_nomor VARCHAR(15) NOT NULL,
       status ENUM('tersedia','dipinjam') DEFAULT 'tersedia'
   );
   
   CREATE TABLE members (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nama VARCHAR(100) NOT NULL,
       alamat TEXT NOT NULL,
       no_hp VARCHAR(15) NOT NULL
   );
   
   CREATE TABLE rentals (
       id INT AUTO_INCREMENT PRIMARY KEY,
       member_id INT NOT NULL,
       motor_id INT NOT NULL,
       tanggal_pinjam DATE NOT NULL,
       tanggal_kembali DATE NULL,
       FOREIGN KEY (member_id) REFERENCES members(id),
       FOREIGN KEY (motor_id) REFERENCES motors(id)
   );
   ```

3. Konfigurasi database di `config/db.php`:
   ```php
   $host = 'localhost';
   $db   = 'rental_motor';
   $user = 'root';
   $pass = '';
   ```

## Cara Penggunaan
1. Akses aplikasi melalui browser:
   ```
   http://localhost/rental-motor
   ```

2. Menu utama:
   - **Motor**: Tambah/edit motor
   - **Member**: Kelola data member
   - **Rental**: Proses penyewaan

3. Proses rental:
   - Pilih member dan motor tersedia
   - Klik "Simpan Rental"
   - Untuk pengembalian, edit rental dan isi tanggal kembali

## Screenshot
![Tampilan Utama](screenshots/main.png)
![Form Rental](screenshots/rental-form.png)

## Teknologi Digunakan
- PHP 7.4+
- MySQL 5.7+
- Bootstrap 5 (untuk tampilan)
- Vanilla JavaScript

## Kontribusi
1. Fork proyek ini
2. Buat branch fitur baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -am 'Tambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## Troubleshooting
Jika menemukan error:
1. Pastikan konfigurasi database benar
2. Cek error log PHP/Apache
3. Verifikasi permission folder
4. Pastikan ekstensi PDO MySQL aktif di PHP

Untuk pertanyaan lebih lanjut, silakan buat issue di repository.


https://github.com/user-attachments/assets/b6c8e880-dcbc-4dc7-8caa-4856edd7538b


