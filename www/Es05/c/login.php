<?php
// Includo il file delle funzioni
include 'functions.php';

// Avvio la sessione php per recuperare eventuali dati di sessione
session_start();

$msg = $_GET['error'] ?? '';

if(isset($_SESSION['username'])) {
    $msg = 'Login già effettuato';
}
else if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
  try{
    [$loginRetval, $loginRetmsg] = login($username, $password);
    
    $msg = $loginRetmsg;
    
    if($loginRetval) {
        $_SESSION['username'] = $username; 

        $link = 'Location: ';
        $link .= $_POST['from'] != null ? $_POST['from'] : 'index.php';

        header($link);
        die();

    }
  }catch(Exception $e){
    $msg = 'Errore durante il login: '. $e->getMessage();
  }
}
?>

<?php
//Form di login
$html_form = <<<FORM
<form action="$_SERVER[PHP_SELF]" method="post">
  <label for="nome"> </label><input type="text" name="username" placeholder="Nome utente" required/><br />
  <label for="password"> </label><input type="password" name="password" placeholder="Password" required/><br />
  <input type="submit" value="Login" /><input type="reset" value="Cancel" />
  <input type="hidden" name="from" value="{$_GET['from']}" />
  <p class='error'>$msg</p>
</form>
FORM;

// Creo il codice html da visualizzare a seconda dei valori di $from e $retval
  $html_out = "<p class='error'>$errmsg</p>";
  $html_out .= $html_form;
  $html_out .= "Non hai un account? <a href='register.php'>Registrati adesso</a>.<br />";
  $html_out .= "Hai dimenticato la password? <a href='pwd_reset.php'>Resetta la password</a>.<br />";
  $html_out .= "<a href='index.php'>Torna alla Home Page</a>.<br />";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h2>Pagina di login</h2>
  <?=$html_out?>
</body>
</html>
