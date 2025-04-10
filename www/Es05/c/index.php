<?php
// Avvio la sessione php per recuperare eventuali dati di sessione
session_start();

// Verifica se l'utente è autenticato
$utente = $_SESSION['username'] ?? 'Ospite';

// Creazione dei link in funzione dell'utente Ospite o Autenticato 
// ...
$html_link .= '<a href="login.php">Pagina Login</a>';
$html_link2 .= '<a href="register.php">Pagine di Registrazione</a>';
$html_link3 .= '<a href="riservata.php">Pagina Riservata</a>';
 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h2>ES05 - Login con PHP e MySql</h2>
  <p>Benvenuto <?=$utente?>. Questa è la home page del sito.<br />
  <?=$html_link?><br/>
  <?=$html_link2?><br/>
  <?=$html_link3?>
  <!-- Link -->
</body>
</html>
