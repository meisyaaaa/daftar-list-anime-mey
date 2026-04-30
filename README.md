# Sistem Registrasi dan Daftar Pengguna - Teknik Informatika UMMI

Projek ini dikembangkan sebagai implementasi praktikum pemrograman web yang mengintegrasikan antarmuka HTML5/CSS3 dengan pemrosesan sisi server menggunakan PHP dan penyimpanan data relasional MySQL. Sistem ini dirancang untuk menangani pendaftaran pengguna secara dinamis.

## 🛠️ Fitur Teknis
* Arsitektur PHP-MySQL: Integrasi penuh antara skrip PHP dengan database MySQL menggunakan ekstensi `mysqli`.
* Keamanan Input: Implementasi `mysqli_real_escape_string` dan `htmlspecialchars` untuk mencegah injeksi karakter berbahaya pada form.
* Manajemen Session: Penggunaan `$_SESSION` untuk menyimpan status notifikasi dan melacak data pendaftar terakhir tanpa akses database berulang.
* Validasi Server-Side: Pengecekan logika kolom kosong dan validasi filter email di sisi server.
* User Interface: Desain responsif menggunakan CSS internal dengan fitur hover efek dan layout tabel yang bersih.

## 📂 Struktur File
* `index.php`: File utama yang berisi logika pemrosesan form, header multimedia, dan tabel output data.
* `koneksi.php`: Skrip konfigurasi untuk menghubungkan aplikasi ke server database lokal.
* `MTP.jpg` & `Mairimashita!.Iruma-kun..jpg`: Aset visual untuk header aplikasi.

## 📑 Spesifikasi Database
Aplikasi berjalan di atas database bernama `db_web` dengan tabel utama `pengguna`. Struktur tabelnya adalah sebagai berikut:

```sql
CREATE TABLE pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);
```

## 🔧 Prosedur Instalasi

1.  Persiapan Lingkungan: Pastikan Apache dan MySQL sudah aktif pada panel kontrol XAMPP Anda.
2.  Penempatan Folder: Salin seluruh file projek ke direktori `C:/xampp/htdocs/praktikum_1/`.
3.  Konfigurasi Database:
    * Masuk ke phpMyAdmin.
    * Buat database baru dengan nama `db_web`.
    * Impor atau jalankan query SQL pembuatan tabel yang tertera di atas.
4.  Verifikasi Koneksi: 
    * Buka file `koneksi.php`.
    * Sesuaikan kredensial (host, user, password, db) dengan pengaturan lokal Anda.
5.  Akses Aplikasi: Jalankan browser dan ketikkan alamat `http://localhost/praktikum_1/index.php`.

## 📌 Alur Kerja Program
1.  Skrip memeriksa apakah ada request `POST` dari tombol `submit_data`.
2.  Data nama dan email disaring dan divalidasi.
3.  Jika valid, data dimasukkan ke database dan disimpan sementara di session.
4.  Program melakukan `header redirection` untuk membersihkan memori `POST` (mencegah duplikasi data saat refresh).
5.  Data yang tersimpan di database ditampilkan kembali pada tabel di bagian bawah halaman secara descending (terbaru di atas).

---
© 2026 Teknik Informatika UMMI