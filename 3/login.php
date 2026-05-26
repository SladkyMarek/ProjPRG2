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
<body>
    <div>
        <h1>Půjčovna her</h1>
        <h3>Přihlášení jako administrátor</h3>
        
        <p style="color: red;"><?php echo $chyba; ?></p>
        
        <form method="POST">
            Email:<br>
            <input type="text" name="email"><br><br>
            Heslo:<br>
            <input type="password" name="heslo"><br><br>
            <input type="submit" name="submit" value="Přihlásit">
        </form>
    </div>
</body>
</html>