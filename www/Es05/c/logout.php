<?php 

    session_start();
    
    //distrugge la sessione
    session_unset();
    session_destroy();

    //reindirizza alla pagina index.php
    header("Location: index.php");
    exit();

?>