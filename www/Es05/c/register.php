<?php
include 'functions.php';

session_start();

$msg = $_GET['error'] ?? '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    try{
        [$registerRetval, $registerRetmsg] = register($username, $password, $email);
    
        $msg = $registerRetmsg;

    if ($regRetval) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        die();
    }

        if($registerRetval) {
    
            $link = 'Location: ';
            $link .= $_POST['from'] != null ? $_POST['from'] : 'index.php';
    
            header($link);
            die();
    
        }
        


      }catch(Exception $e){
        $msg = 'Errore durante la registrazione: '. $e->getMessage();
      }
}

?>

<?php
//Form di login
$html_form = <<<FORM
<form action="$_SERVER[PHP_SELF]" method="post">
  <label for="nome"> </label><input type="text" name="username" placeholder="Nome utente" required/><br />
  <label for="password"> </label><input type="password" name="password" placeholder="Password" required/><br />
  <label for="email"> </label><input type="text" name="email" placeholder="email" required/><br />
  <input type="submit" value="Register" /><input type="reset" value="Cancel" />
  <input type="hidden" name="from" value="{$_GET['from']}" />
  <p class='error'>$msg</p>
</form>
FORM;

// Creo il codice html da visualizzare a seconda dei valori di $from e $retval
  $html_out = "<p class='error'>$errmsg</p>";
  $html_out .= $html_form;
  $html_out .= "<a href='index.php'>Torna alla Home Page</a>.<br />";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
</head>
<body>
  <h2>Pagina di registazione</h2>
  <?=$html_out?>
</body>
</html>