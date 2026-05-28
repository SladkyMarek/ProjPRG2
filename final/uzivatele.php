<?php
require 'config.php';
vyzaduiPrihlaseni();

if (isset($_POST['pridat'])) {
    $email = $_POST['email'];
    $heslo = $_POST['heslo']; 
    $role = $_POST['role'];
    $jmeno = $_POST['jmeno'];
    $prijmeni = $_POST['prijmeni'];
    
    $dotaz = $pdo->prepare("INSERT INTO uzivatele (email, heslo, role, jmeno, prijmeni) VALUES (?, ?, ?, ?, ?)");
    $dotaz->execute([$email, $heslo, $role, $jmeno, $prijmeni]);
}

$admin = $pdo->query("SELECT * FROM uzivatele WHERE role = 'admin'")->fetchAll();
$zakaznici = $pdo->query("SELECT * FROM uzivatele WHERE role = 'zakaznik'")->fetchAll();
$banned = $pdo->query("SELECT * FROM uzivatele WHERE role = 'vyřazen'")->fetchAll();

$uzivatele = $pdo->query("SELECT * FROM uzivatele")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Uživatelé</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Správa uživatelů</h1>
    
    <div class="layout">
        <div class="sidebar">
            <div class="menu">
                <a href="dashboard.php">Hlavní stránka</a>
                <p>Uživatelé</p>
                <a href="vypujcky.php">Výpújčky</a>
                <a href="hry.php">Hry</a>
                <a href="logout.php" class="logout" >Odhlásit se</a>
            </div>
        </div>
        
        <div class="content">
            <div class="infoElement iE0">
                <h3>Přidat uživatele</h3>
                <form method="POST">
                    <div class="formDiv">Jméno: <input type="text" name="jmeno" class="form name" require></div>
                    <div class="formDiv">Příjmení: <input type="text" name="prijmeni" class="form surename" require></div>
                    <div class="formDiv">Email: <input type="email" name="email" class="form mail" require></div>
                    <div class="formDiv">Heslo: <input type="password" name="heslo" class="form pasw" require></div>
                    <div class="formDiv">Role: 
                    <select name="role" class="form role">
                        <option value="Zákazník">Zákazník</option>
                        <option value="Admin">Admin</option>
                        <option value="Vyřazen">Vyřadit</option>
                    </select></div>
                    <div class="formDiv submitDiv"><input type="submit" name="pridat" value="Přidat" class="submit"></div>
                    </form>
            </div>
                
            <div class="info">
                <div class="infoElement iE1">
                    <h3>Zákazníci</h3>
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Jméno</th>
                            <th>Příjmení</th>
                            <th>Email</th>
                        </tr>
                        <?php foreach ($zakaznici as $z) { ?>
                        <tr>
                            <td><?php echo $z['id']?></td>
                            <td><?php echo $z['jmeno']?></td>
                            <td><?php echo $z['prijmeni']?></td>
                            <td><?php echo $z['email']?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                
                <div class="infoElement iE2">
                    <h3>Administrátoři</h3>
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Jméno</th>
                            <th>Příjmení</th>
                            <th>Email</th>
                        </tr>
                        <?php foreach ($admin as $a) { ?>
                        <tr>
                            <td><?php echo $a['id']?></td>
                            <td><?php echo $a['jmeno']?></td>
                            <td><?php echo $a['prijmeni']?></td>
                            <td><?php echo $a['email']?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                
                <div class="infoElement iE3">
                    <h3>Vyřazení</h3>
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Jméno</th>
                            <th>Příjmení</th>
                            <th>Email</th>
                        </tr>
                        <?php foreach ($banned as $b) { ?>
                        <tr>
                            <td><?php echo $b['id']?></td>
                            <td><?php echo $b['jmeno']?></td>
                            <td><?php echo $b['prijmeni']?></td>
                            <td><?php echo $b['email']?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>