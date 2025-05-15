<?php
// Costanti per la connessione al database
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'ES05_user');
define('DB_PASSWORD', 'mia_password');
define('DB_NAME', 'es05');
$html_out = "";
try {
// Connessione al database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verifica della connessione
if (!$conn) {
    //die("Connessione fallita: " . mysqli_connect_error());
    $html_out = "Attenzione! Connessione al database fallita." . mysqli_connect_error();
}
$html_out = "Connessione al database riuscita.";
// ... successivamente eseguire le query qui ...

// Chiusura della connessione
mysqli_close($conn);
} catch (Exception $e) {
$html_out = "Attenzione! Si è verificata un'eccezione. " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h2>Test della connessione al database</h2>
  <?=$html_out?>
</body>
</html>
