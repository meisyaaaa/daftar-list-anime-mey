<?php
// 1. Memulai Session
session_start();
include 'koneksi.php';

$pesan = "";

// 2. FORM HANDLING & VALIDASI (INPUT DATA)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_data'])) {
    $nama  = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nama']));
    $email = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['email']));

    if (empty($nama) || empty($email)) {
        $pesan = "Semua kolom harus diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesan = "Format email salah!";
    } else {
        $query_ins = "INSERT INTO pengguna (nama, email) VALUES ('$nama', '$email')";
        
        if (mysqli_query($conn, $query_ins)) {
            $_SESSION['info'] = "Data berhasil disimpan ke database!";
            $_SESSION['user_terakhir'] = $nama;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $pesan = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Implementasi Lengkap PHP & MySQL - UMMI</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; line-height: 1.6; padding: 20px; color: #333; max-width: 900px; margin: auto; background-color: #f0f2f5; }
        header { background: white; padding: 20px; border-bottom: 5px solid #ff0066; margin-bottom: 20px; text-align: center; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        
        /* Container Gambar Anime */
        .anime-container { display: flex; justify-content: center; gap: 20px; margin-bottom: 20px; flex-wrap: wrap; }
        .anime-container img { width: 300px; height: auto; border-radius: 10px; border: 3px solid #ff0066; box-shadow: 0 4px 8px rgba(0,0,0,0.2); transition: transform 0.3s; }
        .anime-container img:hover { transform: scale(1.05); }

        .highlight { color: #ff0066; font-weight: bold; }
        .alert { background: #d4edda; color: #155724; padding: 15px; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 15px; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; border-radius: 4px; margin-bottom: 15px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; border-radius: 8px; overflow: hidden; }
        table, th, td { border: 1px solid #ddd; }
        th { background-color: #ff0066; color: white; padding: 15px; }
        td { padding: 12px; text-align: center; }
        tr:nth-child(even) { background-color: #fff0f5; }

        form { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; text-align: left; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], input[type="email"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        
        .btn-container { text-align: center; margin-top: 20px; }
        button { background: #28a745; color: white; border: none; padding: 12px 25px; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; }
        button:hover { background: #218838; }
        .btn-alert { background: #007bff; margin-top: 10px; }
    </style>
</head>
<body>

    <header>
        <div class="anime-container">
            <img src="MTP.jpg" alt="MTP Anime">
            <img src="Mairimashita!.Iruma-kun..jpg" alt="Iruma-kun Anime">
        </div>
        <h1>Teknik Informatika UMMI</h1>
        <h2>Implementasi Dasar-Dasar Pemrograman PHP</h2>
        <p>Database: <span class="highlight">db_web</span> | Tabel: <span class="highlight">pengguna</span></p>
    </header>

    <?php if (isset($_SESSION['info'])): ?>
        <div class="alert">
            <?php echo $_SESSION['info']; unset($_SESSION['info']); ?>
        </div>
    <?php endif; ?>

    <?php if ($pesan): ?>
        <div class="error"><?php echo $pesan; ?></div>
    <?php endif; ?>

    <section>
        <h3>Formulir anime_list</h3>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama..." required>
            </div>
            <div class="form-group">
                <label for="email">Alamat Email:</label>
                <input type="email" id="email" name="email" placeholder="contoh@ummi.ac.id" required>
            </div>
            <div class="btn-container">
                <button type="submit" name="submit_data">Simpan ke Database</button>
                <br>
                <button type="button" class="btn-alert" onclick="alert('Halo Mahasiswa Informatika UMMI!')">Tes JavaScript</button>
            </div>
        </form>
    </section>

    <hr>

    <section>
        <h3>daftar pengguna </h3>
        <?php if (isset($_SESSION['user_terakhir'])): ?>
            <p>Pendaftar Terakhir: <b><?php echo $_SESSION['user_terakhir']; ?></b></p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query_sel = "SELECT * FROM pengguna ORDER BY id DESC";
                $result = mysqli_query($conn, $query_sel);

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['email']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Belum ada data di tabel pengguna.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <footer>
        <p align="center" style="margin-top: 40px; font-size: 0.9em; color: #666;">
            &copy; 2026 Teknik Informatika UMMI
        </p>
    </footer>

</body>
</html>

<?php mysqli_close($conn); ?>