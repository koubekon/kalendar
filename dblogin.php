<?php 
// Připojení k databázi
$servername = "localhost";
$username = "koubeko";
$password = "KraKEN-20.2.1994";
$dbname = "koubeko";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Chyba při připojení k databázi: " . $conn->connect_error);
}

// Nastavení doby trvání session na 30 minut
$sessionLifetime = 30 * 60; // 30 minut
session_set_cookie_params($sessionLifetime);
session_start();

// Kontrola času nečinnosti
$inactiveLimit = 15 * 60; // 15 minut

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactiveLimit)) {
    // Uživatel byl nečinný po dobu delší než časový limit, takže ho odhlásíme
    session_unset();
    session_destroy();
    // Případně provedete další akce, jako přesměrování na stránku přihlášení
}

// Aktualizace času poslední aktivity
$_SESSION['last_activity'] = time();
?>