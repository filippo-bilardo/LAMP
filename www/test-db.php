<?php
/**
 * Test di connessione al database MySQL
 * Esempio per ambiente LAMP
 */

// Configurazione database
$host = 'localhost';
$username = 'root'; //'lamp_user';
$password = ''; //'lamp_pass';
$database = 'lamp_db';

echo "<h1>🧪 Test Connessione Database MySQL</h1>";

try {
    // Tentativo di connessione
    $conn = new mysqli($host, $username, $password, $database);
    
    // Verifica connessione
    if ($conn->connect_error) {
        throw new Exception("Connessione fallita: " . $conn->connect_error);
    }
    
    echo "<div style='color: green; padding: 10px; border: 1px solid green; border-radius: 5px; margin: 10px 0;'>";
    echo "✅ <strong>Connessione riuscita!</strong><br>";
    echo "📊 Host: " . $host . "<br>";
    echo "👤 Username: " . $username . "<br>";
    echo "💾 Database: " . $database . "<br>";
    echo "🔗 Versione MySQL: " . $conn->server_info;
    echo "</div>";
    
    // Test query
    $result = $conn->query("SELECT 'Hello LAMP!' as messaggio, NOW() as timestamp");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "<div style='background: #f0f8ff; padding: 10px; border-radius: 5px; margin: 10px 0;'>";
        echo "<h3>📋 Test Query:</h3>";
        echo "<strong>Messaggio:</strong> " . $row['messaggio'] . "<br>";
        echo "<strong>Timestamp:</strong> " . $row['timestamp'];
        echo "</div>";
    }
    
    // Mostra tabelle esistenti
    $result = $conn->query("SHOW TABLES");
    echo "<div style='background: #fff8dc; padding: 10px; border-radius: 5px; margin: 10px 0;'>";
    echo "<h3>📋 Tabelle nel database '$database':</h3>";
    if ($result->num_rows > 0) {
        echo "<ul>";
        while($row = $result->fetch_array()) {
            echo "<li>" . $row[0] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<em>Nessuna tabella trovata. Il database è vuoto.</em>";
    }
    echo "</div>";
    
    $conn->close();
    
} catch (Exception $e) {
    echo "<div style='color: red; padding: 10px; border: 1px solid red; border-radius: 5px; margin: 10px 0;'>";
    echo "❌ <strong>Errore di connessione:</strong><br>";
    echo $e->getMessage();
    echo "</div>";
    
    echo "<div style='background: #ffe4e1; padding: 10px; border-radius: 5px; margin: 10px 0;'>";
    echo "<h3>🔧 Possibili soluzioni:</h3>";
    echo "<ul>";
    echo "<li>Verificare che MySQL sia avviato: <code>sudo service mysql status</code></li>";
    echo "<li>Verificare le credenziali di accesso</li>";
    echo "<li>Verificare che il database '$database' esista</li>";
    echo "</ul>";
    echo "</div>";
}

echo "<div style='margin-top: 20px; padding: 10px; border-top: 1px solid #ccc;'>";
echo "<h3>🔗 Link utili:</h3>";
echo "<a href='/' style='margin-right: 10px;'>🏠 Home</a>";
echo "<a href='/info.php' style='margin-right: 10px;'>ℹ️ PHP Info</a>";
echo "<a href='http://localhost:8081' target='_blank'>🗄️ phpMyAdmin</a>";
echo "</div>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background: #f5f5f5;
}
code {
    background: #f0f0f0;
    padding: 2px 4px;
    border-radius: 3px;
    font-family: monospace;
}
a {
    color: #007cba;
    text-decoration: none;
    padding: 5px 10px;
    background: #e7f3ff;
    border-radius: 3px;
    display: inline-block;
}
a:hover {
    background: #cce7ff;
}
</style>
