<?php
require 'config.php';

vyzaduiPrihlaseni();

$hry = $pdo->query("SELECT * FROM hry WHERE autor != 'admin'")->fetchAll();
$zakaznici = $pdo->query("SELECT * FROM uzivatele WHERE role = 'zakaznik'")->fetchAll();

$vypujcky = $pdo->query("
    SELECT v.*, h.nazev, u.jmeno, u.prijmeni 
    FROM vypujcky v 
    JOIN hry h ON v.hry_id = h.id 
    JOIN uzivatele u ON v.uzivatele_id = u.id 
    WHERE v.stav = 'aktivní'
")->fetchAll();

?>
<!DOCTYPE html>
<html>

<head>
  <title>Půjčovna Deskových Her</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="robots" content="index,follow">
  <meta name="generator" content="GrapesJS Studio">
  <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1 class="nadpis">Hlavní stránka</h1>
    <div class="layout">
        <div class="sidebar">
            <div class="menu">
                <p>Hlavní stránka</p>
                <a href="uzivatele.php">Uživatelé</a>
                <a href="vypujcky.php">Výpújčky</a>
                <a href="hry.php">Hry</a>
                <a href="logout.php" class="logout">Odhlásit se</a>
            </div>
        </div>
        <div class="content">
            <div class="info">
                <div class="infoElement iE1">
                    <h3>Hry</h3>
                    <table border="1">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Název</th>
                                <th>Autor</th>
                                <th>Rok vydání</th>
                                <th>Stav</th>
                            </tr>
                            <?php foreach ($hry as $h) { ?>
                            <tr>
                                <td><?php echo $h['id']?></td>
                                <td><?php echo $h['nazev']?></td>
                                <td><?php echo $h['autor']?></td>
                                <td><?php echo $h['rok vydani']?></td>
                                <td><?php echo $h['stav']?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="infoElement iE2">
                    <h3>Zákazníci</h3>
                    <table border="1">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Jméno</th>
                                <th>Prijmeni</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                            <?php foreach ($zakaznici as $z) { ?>
                            <tr>
                                <td><?php echo $z['id']?></td>
                                <td><?php echo $z['jmeno']?></td>
                                <td><?php echo $z['prijmeni']?></td>
                                <td><?php echo $z['email']; ?></td>
                                <td><?php echo $z['role']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="infoElement iE3"">
                    <h3>Výpůjčky</h3>
                    <table border="1">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Hra</th>
                                <th>Komu</th>
                                <th>Půjčeno</th>
                                <th>Vráceno</th>
                                <th>Stav</th>
                            </tr>
                            <?php foreach ($vypujcky as $v) { ?>
                            <tr>
                                <td><?php echo $v['id']?></td>
                                <td><?php echo $v['nazev']; ?></td>
                                <td><?php echo $v['jmeno'] . " " . $v['prijmeni']; ?></td>
                                <td><?php echo $v['datum_pujceni']; ?></td>
                                <td><?php echo $v['datum_vraceni']; ?></td>
                                <td><?php echo $v['stav']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
</body>

</html>