<?php
require_once "class/Database.php";

if ($_POST) {
    $db = new Database();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users 
            WHERE username='$username' 
            AND password='$password'";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['is_login'] = true;
        header("Location: index.php");
        exit;
    } else {
        echo "LOGIN GAGAL";
    }
}
?>

<h1>LOGIN</h1>

<form method="post">
    <input name="username" placeholder="username"><br><br>
    <input type="password" name="password" placeholder="password"><br><br>
    <button>Login</button>
</form>