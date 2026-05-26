<?php
require 'config.php';
vyzaduiPrihlaseni();

if (isset($_POST['pujcit'])) {
    $hra = $_POST['hra'];
    $email = $_POST['email'];
    $datum_pujceni = $_POST['datum_pujceni'];

    if (!empty($hra) && !empty($email)) {
        $dotaz = $pdo->prepare("INSERT INTO vypujcky (hry_id, uzivatele_id, datum_pujceni, stav) VALUES (?, ?, ?, 'aktivní')");
        $dotaz->execute([$hra, $email, $datum_pujceni]);
        
        $pdo->prepare("UPDATE hry SET stav = 'vypůjčená' WHERE id = ?")->execute([$hra]);
    
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

if (isset($_GET['smazat'])) {
    $id = $_GET['smazat'];
    $pdo->prepare("DELETE FROM vypujcky WHERE id = ?")->execute([$id]);
}

if (isset($_POST['vratit'])) { 
    $id = $_POST['id_vypujcky'];
    $datum_vrat = $_POST['datum_vraceni'];

    $stmtHra = $pdo->prepare("SELECT hry_id FROM vypujcky WHERE id = ?");
    $stmtHra->execute([$id]);
    $vypujcka = $stmtHra->fetch();
    
    if ($vypujcka) {
        $hra_id = $vypujcka['hry_id'];

        $stmt = $pdo->prepare("UPDATE vypujcky SET datum_vraceni = ?, stav = 'vrácená' WHERE id = ?");
        $stmt->execute([$datum_vrat, $id]);

        $pdo->prepare("UPDATE hry SET stav = 'dostupná' WHERE id = ?")->execute([$hra_id]);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } 
}

$aktivni_vypujcky = $pdo->query("
    SELECT v.*, h.nazev, u.jmeno, u.prijmeni 
    FROM vypujcky v 
    JOIN hry h ON v.hry_id = h.id 
    JOIN uzivatele u ON v.uzivatele_id = u.id 
    WHERE v.stav = 'aktivní'
")->fetchAll();

$vracene_vypujcky = $pdo->query("
    SELECT v.*, h.nazev, u.jmeno, u.prijmeni 
    FROM vypujcky v 
    JOIN hry h ON v.hry_id = h.id 
    JOIN uzivatele u ON v.uzivatele_id = u.id 
    WHERE v.stav = 'vrácená'
")->fetchAll();

$uzivatele = $pdo->query("SELECT id, jmeno, prijmeni, email FROM uzivatele ORDER BY prijmeni, jmeno")->fetchAll();
$hry = $pdo->query("SELECT id, nazev FROM hry WHERE stav = 'dostupná' ORDER BY nazev")->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Výpůjčky</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Správa výpůjček</h1>
    
    <div class="layout">
        <div class="sidebar">
            <div class="menu">
                <a href="dashboard.php">Hlavní stránka</a>
                <a href="uzivatele.php">Uživatelé</a>
                <p>Výpújčky</p>
                <a href="hry.php">Hry</a>
                <a href="logout.php" class="logout" >Odhlásit se</a>
            </div>
        </div>

        <div class="content">
            <div class="infoElement iE0">
                <h3>Vypůjčit</h3>
                <form method="POST">
                    <div class="formDiv"> Hra: 
                    <select name="hra" class="form">
                        <option value="">Vyber hru</option>
                        <?php foreach ($hry as $h) { ?>
                            <option value="<?php echo $h['id']; ?>"><?php echo $h['nazev']; ?></option>
                        <?php } ?>
                    </select></div>
                    <div class="formDiv">Email uzivatele: 
                    <select name="email" class="form">
                        <option value="">Vyber uzivatele</option>
                        <?php foreach ($uzivatele as $u) { ?>
                            <option value="<?php echo $u['id']; ?>"><?php echo $u['email']; ?></option>
                        <?php } ?>
                    </select></div>
                    <div class="formDiv">Datum pujčení: <input type="text" name="datum_pujceni" class="form"></div>
                    <div class="formDiv submitDiv"><input type="submit" name="pujcit" value="Půjčit" class="form submit"></div>
                </form>
            </div>
            
            <div class="info">
                <div class="infoElement iE1">
                    <h3>Aktivní výpůjčky</h3>
                    <table border="1" cellpadding="5">
                        <tr>
                            <th>Hra</th>
                            <th>Zákazník</th>
                            <th>Od</th>
                            <th>Do</th>
                            <th>Stav</th>
                        </tr>
                        <?php foreach ($aktivni_vypujcky as $a) { ?>
                        <tr>
                            <td><?php echo $a['nazev']; ?></td>
                            <td><?php echo $a['jmeno'] . " " . $a['prijmeni']; ?></td>
                            <td><?php echo $a['datum_pujceni']; ?></td>
                            <td><?php echo $a['stav']; ?></td>
                            <td>
                                <form method="POST" action="vypujcky.php">
                                    <input type="hidden" name="id_vypujcky" value="<?php echo $a['id']; ?>">
                                    <input type="text" name="datum_vraceni">
                                    <input type="submit" name="vratit" value="Vrátit">
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>

                <div class="infoElement iE2">
                    <h3>Vrácené výpůjčky</h3>
                    <table border="1" cellpadding="5">
                        <tr>
                            <th>Hra</th>
                            <th>Zákazník</th>
                            <th>Pujčena</th>
                            <th>Vrácena</th>
                            <th>Stav</th>
                        </tr>
                        <?php foreach ($vracene_vypujcky as $v) { ?>
                        <tr>
                            <td><?php echo $v['nazev']; ?></td>
                            <td><?php echo $v['jmeno'] . " " . $v['prijmeni']; ?></td>
                            <td><?php echo $v['datum_pujceni']; ?></td>
                            <td><?php echo $v['datum_vraceni']; ?></td>
                            <td><?php echo $v['stav']; ?></td>
                            <td class="delete"><a href="vypujcky.php?smazat=<?php echo $v['id']; ?>">Smazat</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div> </div>
    </div>
</body>
</html>