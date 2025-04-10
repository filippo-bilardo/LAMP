<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'ES05_user');
define('DB_PASSWORD', 'mia_password');
define('DB_NAME', 'ES05');

function login($username, $password) {
    // Connessione al database
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die("Connessione fallita: " . mysqli_connect_error());
    }

    // Query per selezionare tutti i record dalla tabella users
    $query = "SELECT UserID FROM utente where Username = '$username' and Password = '$password';";
    

    // Esecuzione della query
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Controllo se ci sono record        
        if (mysqli_num_rows($result) > 0) {
            return [true, 'Login avvenuto con successo'];
        } else {
            return [false, 'Login sbagliato'];
        }

        // Liberazione dei risultati
        mysqli_free_result($result);
    } else {
        return [false, 'Errore: ' . mysqli_error($conn)];
    }

    // Chiusura della connessione
    mysqli_close($conn);
  }

  function checkSession()
{
    if (isset($_SESSION['username'])) {
        return [true, 'Sessione attiva'];
    } else {
        return [false, 'Sessione non attiva'];
    }
}

function isRegistered($username, $password)
{
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die('Connessione fallita: ' . mysqli_connect_error());
    }

    // Query per selezionare tutti i record dalla tabella users
    $query = "SELECT UserID FROM utente where Username = '$username'";

    // Esecuzione della query
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Controllo se ci sono record
        if (mysqli_num_rows($result) > 0) {
            return true;  // nome utente gia in uso
        } else {
            return false;
        }

        // Liberazione dei risultati
        mysqli_free_result($result);
    } else {
        die('Errore: ' . mysqli_error($conn));
    }

    // Chiusura della connessione
    mysqli_close($conn);
}

function register($username, $password, $email)
{
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die("Connessione fallita: " . mysqli_connect_error());
    }
    if (isRegistered($username, $password)) {
        return [false, 'Username già in uso'];
    }
    try {
        // Query per aggiungere un nuovo record alla tabella users

        $query = "INSERT INTO utente (Username, Password, Email) VALUES ('$username', '$password', '$email');";

        // Esecuzione della query
        $result = mysqli_query($conn, $query);

        if ($result) {
            return [true, 'Registrazione avvenuta con successo'];
        } else {
            return [false, 'Errore: ' . mysqli_error($conn)];
        }
    } catch (\Exception $e) {
        return [false, 'Errore: ' . $e->getMessage()];
    }

    mysqli_close($conn);

    
}
    