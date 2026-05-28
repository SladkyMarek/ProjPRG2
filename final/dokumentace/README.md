# Administrační systém pro půjčovnu deskových her

Interní webová aplikace určená pro efektivní správu inventáře, registrovaných uživatelů a sledování stavu výpůjček v reálném čase.

## 1. Úvod
Systém slouží jako nástroj pro administrátory k digitalizaci agendy spojené s provozem půjčovny deskových her. 
* **Technologický stack:** PHP (aplikační logika), MySQL/MariaDB (databáze), PDO (bezpečné databázové dotazy), HTML5 a CSS3 (responzivní design s využitím Flexboxu).

## 2. Analýza problému
Aplikace řeší běžné problémy kamenných půjčen, jako je nepřehledné vedení záznamů a riziko duplicitního půjčení jedné hry. Zajišťuje:
* **Stavové řízení:** Automatické hlídání dostupnosti her (dostupná, vypůjčená, nedostupná).
* **Zachování integrity dat (Soft Delete):** Hry se při smazání neodstraňují z databáze fyzicky, aby nedošlo k porušení historie výpůjček. Pouze se přepíná jejich příznak viditelnosti.
* **Řízení přístupu:** Striktní ochrana dat – do systému má přístup výhradně uživatel s rolí `admin`.

## 3. Struktura projektu a souborů
/pujcovna_her/
  ├── index.php          – vstupní bod (automatické přesměrování na login)
  ├── login.php          – přihlašovací formulář pro administrátora a ověření práv
  ├── logout.php         – bezpečné odhlášení a ukončení aktivní relace
  ├── dashboard.php      – hlavní přehledový panel (rozcestník s rychlými přehledy)
  ├── hry.php            – správa herního inventáře (přidání, výpis, soft-delete)
  ├── uzivatele.php      – správa uživatelských účtů (registrace, rozřazení do rolí)
  ├── vypujcky.php       – transakční jádro (vytvoření výpůjčky, evidence vrácení)
  ├── config.php         – připojení k databázi přes PDO a kontrola zabezpečení relací
  ├── style.css          – centralizovaný stylopis pro vzhled celého systému
  └── pujcovna_her.sql   – SQL dump databáze včetně struktury a ukázkových dat

## 4. Popis funkcionalit
* **Autorizace:** Každý podsystém kontroluje platnost relace. Nepřihlášený uživatel je okamžitě přesměrován na login.
* **Životní cyklus hry:** Nová hra začíná ve stavu `dostupná`. Při zápisu výpůjčky se zablokuje pro další transakce. Po fyzickém vrácení a zadání data se automaticky uvolní zpět do oběhu.
* **Filtrování dat:** Dashboard a správa her aktivně skrývají záznamy, které byly označeny jako smazané, nebo slouží jako testovací/servisní data.

## 5. Instalace a spuštění
1. Stáhněte a nainstalujte lokální webový server (např. **XAMPP**).
2. Umístěte všechny zdrojové soubory projektu do adresáře serveru (např. `xampp/htdocs/pujcovna/`).
3. Spusťte Apache a MySQL v kontrolním panelu XAMPP.
4. Otevřete **phpMyAdmin** (`http://localhost/phpmyadmin/`), vytvořte novou databázi s názvem `pujcovna her` (kódování `utf8mb4_general_ci`) a importujte do ní přiložený soubor `pujcovna_her.sql`.
5. V případě potřeby upravte přihlašovací údaje k databázi v souboru `config.php`.
6. Spusťte aplikaci v prohlížeči zadáním adresy `http://localhost`.

## 6. Závěr
Systém úspěšně plní požadavky na přehledné a bezchybné vedení agendy půjčovny. Pro nasazení do ostrého produkčního provozu se doporučuje v příští fázi implementovat hashování uživatelských hesel (např. pomocí `password_hash()`) a vytvořit klientské rozhraní pro koncové zákazníky.