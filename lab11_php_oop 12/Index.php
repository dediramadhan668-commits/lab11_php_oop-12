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