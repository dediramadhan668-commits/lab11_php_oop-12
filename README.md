# Praktikum 12 Autentikasi dan Session
PHP dan XAMPP

# Identitas Mahasiswa 
=========================
Nama. Dedi Ramadhan
NIM. 312410171
Mata Kuliah. Pemrograman Web
=========================
# Deskripsi Project
Project ini membahas autentikasi login dan logout menggunakan PHP dan MySQL. Sistem memakai session untuk menyimpan status login user. Studi kasus memakai user admin dari database.
=========================
# Tujuan Praktikum
• Memahami konsep login dan logout
• Memahami session pada PHP
• Mengimplementasikan autentikasi berbasis database

# Tools
• XAMPP
• Apache
• MySQL
• phpMyAdmin
• Visual Studio Code
• Browser

# Struktur Folder
```
lab11_php_oop/
├── index.php
├── config.php
├── class/
│   └── Database.php
├── module/
│   ├── home/
│   │   └── index.php
│   └── user/
│       ├── login.php
│       └── logout.php
└── template/
```

# Konfigurasi Database

Nama database
latihan_oop
```
Query tabel users

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    nama VARCHAR(100)
);
```

# Insert user admin

INSERT INTO users (username, password, nama)
VALUES ('admin', 'admin', 'Administrator');


# Penjelasan File Utama

index.php
Berfungsi sebagai router halaman dan session handler.
```php
<?php
session_start();

$mod  = $_GET['mod']  ?? 'home';
$page = $_GET['page'] ?? 'index';

$file = "module/$mod/$page.php";

if (file_exists($file)) {
    include $file;
} else {
    echo "404";
}


class/Database.php
Mengatur koneksi database MySQL.

<?php
class Database {
    public $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "latihan_oop");
        if ($this->conn->connect_error) {
            die("Koneksi database gagal");
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }
}
```

module/home/index.php
# Menampilkan menu sesuai status login.

<h1>HOME</h1>

<?php if (!isset($_SESSION['is_login'])): ?>
    <a href="index.php?mod=user&page=login">Login</a>
<?php else: ?>
    <p>Selamat datang, ADMIN</p>
    <a href="index.php?mod=user&page=logout">Logout</a>
<?php endif; ?>


module/user/login.php
# Proses autentikasi user.
```php
<?php
require_once "class/Database.php";

if ($_POST) {
    $db = new Database();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['is_login'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Login gagal";
    }
}
?>

<h1>LOGIN</h1>

<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="post">
    <input name="username" placeholder="username"><br><br>
    <input type="password" name="password" placeholder="password"><br><br>
    <button>Login</button>
</form>
```

module/user/logout.php
Menghapus session login.
```php
<?php
session_destroy();
header("Location: index.php");
exit;
```

# Cara Menjalankan
==================
• Jalankan Apache dan MySQL di XAMPP
• Buka phpMyAdmin dan buat database
• Import tabel users
• Akses http://localhost/lab11_php_oop
==================
# Akun Login
==================
Username. admin
Password. admin
==================
# Hasil
==================
• Login berbasis database berhasil
• Session aktif setelah login
• Logout menghapus session
• Tampilan berubah sesuai status login
==================
# Pengembangan Lanjutan
==================
• Password hashing
• Proteksi halaman
• Halaman profil user
• Sistem CRUD
==================
# Catatan kecil. Login admin tanpa hashing itu cepat. Hacker juga cepat senyum. 
