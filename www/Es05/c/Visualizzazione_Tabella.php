<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'ES05_user');
define('DB_PASSWORD', 'mia_password');
define('DB_NAME', 'ES05');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die("Connessione fallita: " . mysqli_connect_error());
    }
    
$sql = "SELECT * FROM utente";
$result = mysqli_query($conn, $sql);

if($result){
    $html_out = '<table>';

    $field = mysqli_fetch_fields($result);

    foreach($field as $f){
        $html_out .= '<th>'.$f->name.'</th>';
    }

    while($row = mysqli_fetch_assoc($result)){
        $html_out .= '<tr>';
        foreach($row as $r){
            $html_out .= '<td>'.$r.'</td>';
        }
        $html_out .= '</tr>';
    }
    $html_out .= '</table>';
    echo $html_out;
}
else{
    echo "Errore nella query: " . mysqli_error($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
</head>
<body>
    
</body>
</html>