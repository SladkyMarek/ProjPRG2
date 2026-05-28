<?php
require 'config.php';

$chyba = "";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $heslo = $_POST['heslo'];
    
    if ($email == "" || $heslo == "") {
        $chyba = "Vyplňte všechno!";
    } else {
        $dotaz = $pdo->prepare("SELECT * FROM uzivatele WHERE email = ?");
        $dotaz->execute([$email]);
        $uzivatel = $dotaz->fetch();
        
        if ($uzivatel && $uzivatel['heslo'] == $heslo) {
            
            if ($uzivatel['role'] == "admin") {
                $_SESSION['uzivatel_id'] = $uzivatel['id'];
                header('Location: dashboard.php');
                exit;
            } else {$chyba = "Nedostatečné pravomoce!";}
        } else {
            $chyba = "Špatný email nebo heslo!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Půjčovna her</h1>
    <div class="login">
        <div class="size">
            <div class="infoElement iE0">
                <h3>Přihlášení jako administrátor</h3>
                <p style="color: red;"><?php echo $chyba; ?></p>
                <form method="POST">
                    <div class="formDiv">Email:<input type="email" name="email" class="form"><br></div>
                    <div class="formDiv">Heslo:<input type="password" name="heslo" class="form"><br></div>
                    <div class="formDiv submitDiv"><input type="submit" name="submit" value="Přihlásit" class="submit"></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>