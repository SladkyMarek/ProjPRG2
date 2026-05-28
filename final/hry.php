<?php
require 'config.php';
vyzaduiPrihlaseni();

if (isset($_POST['pridat'])) {
    $nazev = $_POST['nazev'];
    $autor = $_POST['autor'];
    $rok_vydani = $_POST['rok_vydani'];
    $pocet_hracu = $_POST['pocet_hracu'];
    $stav = 'dostupná';
    
    $dotaz = $pdo->prepare("INSERT INTO hry (nazev, autor, rokvydani, pocetLidi, stav) VALUES (?, ?, ?, ?, ?)");
    $dotaz->execute([$nazev, $autor, $rok_vydani, $pocet_hracu, $stav]);
}

if (isset($_GET['smazat'])) {
    $id = $_GET['smazat'];
    
    $pdo->prepare("UPDATE hry SET smazat = '1' WHERE id = ?")->execute([$id]);
}

$free = $pdo->query("SELECT * FROM hry WHERE stav = 'dostupná' AND smazat = 0")->fetchAll();
$not = $pdo->query("SELECT * FROM hry WHERE stav = 'nedostupná' AND smazat = 0")->fetchAll();
$taken = $pdo->query("SELECT * FROM hry WHERE stav = 'vypůjčená' AND smazat = 0")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Správa her</h1>
    
    <div class="layout">
        <div class="sidebar">
            <div class="menu">
                <a href="dashboard.php">Hlavní stránka</a>
                <a href="uzivatele.php">Uživatelé</a>
                <a href="vypujcky.php">Výpújčky</a>
                <p>Hry</p>
                <a href="logout.php" class="logout" >Odhlásit se</a>
            </div>
        </div>

        <div class="content">

            <div class="infoElement iE0">
                <h3>Přidat novou hru</h3>
                <form method="POST">
                    <div class="formDiv">Název hry: <input type="text" name="nazev" class="form"></div>
                    <div class="formDiv">Autor: <input type="text" name="autor" class="form"></div>
                    <div class="formDiv">Rok Vydání: <input type="text" name="rok_vydani" class="form"></div>
                    <div class="formDiv">Počet Hráčů: <input type="text" name="pocet_hracu" class="form"></div>
                    <div class="formDiv submitDiv"><input type="submit" name="pridat" value="Přidat hru" class="form submit"></div>
                </form>
            </div>
            
            <div class="info">
                <div class="infoElement iE1">
                    <h3>Dostupné</h3>
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Název</th>
                            <th>Autor</th>
                            <th>Rok vydání</th>
                            <th>Počet hráčů</th>
                        </tr>
                        <?php foreach ($free as $f) { ?>
                        <tr>
                            <td><?php echo $f['id']?></td>
                            <td><?php echo $f['nazev']?></td>
                            <td><?php echo $f['autor']?></td>
                            <td><?php echo $f['rokvydani']?></td>
                            <td><?php echo $f['pocetLidi']?></td>
                            <td class="delete"><a href="hry.php?smazat=<?php echo $f['id']; ?>">Smazat</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                
                <div class="infoElement iE2">
                    <h3>Půjčené</h3>
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Název</th>
                            <th>Autor</th>
                            <th>Rok vydání</th>
                            <th>Počet hráčů</th>
                        </tr>
                        <?php foreach ($taken as $t) { ?>
                        <tr>
                            <td><?php echo $t['id']?></td>
                            <td><?php echo $t['nazev']?></td>
                            <td><?php echo $t['autor']?></td>
                            <td><?php echo $t['rokvydani']?></td>
                            <td><?php echo $t['pocetLidi']?></td>
                            <td class="delete"><a href="hry.php?smazat=<?php echo $t['id']; ?>">Smazat</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                
                <div class="infoElement iE3">
                    <h3>Nedostupné</h3>
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Název</th>
                            <th>Autor</th>
                            <th>Rok vydání</th>
                            <th>Počet hráčů</th>
                        </tr>
                        <?php foreach ($not as $n) { ?>
                        <tr>
                            <td><?php echo $n['id']?></td>
                            <td><?php echo $n['nazev']?></td>
                            <td><?php echo $n['autor']?></td>
                            <td><?php echo $n['rokvydani']?></td>
                            <td><?php echo $n['pocetLidi']?></td>
                            <td class="delete"><a href="hry.php?smazat=<?php echo $n['id']; ?>">Smazat</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>