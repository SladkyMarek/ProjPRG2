<?php
session_start();

// Obyčejné připojení
$pdo = new PDO("mysql:host=localhost;dbname=pujcovna her;charset=utf8", "root", "");

// Jednoduché funkce pro kontrolu
function jePrihlasen() {
    if (isset($_SESSION['uzivatel_id'])) {
        return true;
    } else {
        return false;
    }
}

function vyzaduiPrihlaseni() {
    if (jePrihlasen() == false) {
        header('Location: login.php');
        exit;
    }
}
?>