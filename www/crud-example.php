<?php
/**
 * Esempio di CRUD (Create, Read, Update, Delete) con PHP e MySQL
 * Gestione tabella prodotti
 */

// Configurazione database
$host = 'localhost';
$username = 'root';
$password = 'root';
$database = 'lamp_db';

// Connessione al database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Errore connessione: " . $e->getMessage());
}

// Gestione operazioni CRUD
$action = $_GET['action'] ?? 'list';
$message = '';

switch($action) {
    case 'create':
        if ($_POST) {
            try {
                $stmt = $pdo->prepare("INSERT INTO prodotti (nome, descrizione, prezzo, categoria) VALUES (?, ?, ?, ?)");
                $stmt->execute([$_POST['nome'], $_POST['descrizione'], $_POST['prezzo'], $_POST['categoria']]);
                $message = "✅ Prodotto aggiunto con successo!";
            } catch(Exception $e) {
                $message = "❌ Errore: " . $e->getMessage();
            }
        }
        break;
        
    case 'update':
        if ($_POST) {
            try {
                $stmt = $pdo->prepare("UPDATE prodotti SET nome=?, descrizione=?, prezzo=?, categoria=? WHERE id=?");
                $stmt->execute([$_POST['nome'], $_POST['descrizione'], $_POST['prezzo'], $_POST['categoria'], $_POST['id']]);
                $message = "✅ Prodotto aggiornato con successo!";
            } catch(Exception $e) {
                $message = "❌ Errore: " . $e->getMessage();
            }
        }
        break;
        
    case 'delete':
        if (isset($_GET['id'])) {
            try {
                $stmt = $pdo->prepare("DELETE FROM prodotti WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                $message = "✅ Prodotto eliminato con successo!";
            } catch(Exception $e) {
                $message = "❌ Errore: " . $e->getMessage();
            }
        }
        break;
}

// Recupera tutti i prodotti
$stmt = $pdo->query("SELECT * FROM prodotti ORDER BY id DESC");
$prodotti = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Se stiamo modificando, recupera il prodotto specifico
$prodotto_edit = null;
if ($action === 'edit' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM prodotti WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $prodotto_edit = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Prodotti - Esempio LAMP</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 20px; 
            background: #f5f5f5; 
        }
        .container { 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
            margin-bottom: 20px; 
        }
        h1 { color: #333; text-align: center; }
        .message { 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 5px; 
            background: #d4edda; 
            color: #155724; 
            border: 1px solid #c3e6cb; 
        }
        .form-group { margin: 15px 0; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, select { 
            width: 100%; 
            padding: 8px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            box-sizing: border-box; 
        }
        button { 
            background: #007bff; 
            color: white; 
            padding: 10px 20px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            margin-right: 10px; 
        }
        button:hover { background: #0056b3; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .btn-warning { background: #ffc107; color: #212529; }
        .btn-warning:hover { background: #e0a800; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            padding: 12px; 
            text-align: left; 
            border-bottom: 1px solid #ddd; 
        }
        th { background: #f8f9fa; font-weight: bold; }
        tr:hover { background: #f5f5f5; }
        .actions { white-space: nowrap; }
        .nav { 
            text-align: center; 
            margin-bottom: 20px; 
        }
        .nav a { 
            display: inline-block; 
            padding: 10px 20px; 
            margin: 0 5px; 
            background: #6c757d; 
            color: white; 
            text-decoration: none; 
            border-radius: 4px; 
        }
        .nav a:hover { background: #5a6268; }
        .nav a.active { background: #007bff; }
    </style>
</head>
<body>
    <h1>🛍️ Gestione Prodotti - CRUD Example</h1>
    
    <div class="nav">
        <a href="?action=list" class="<?= $action === 'list' ? 'active' : '' ?>">📋 Lista Prodotti</a>
        <a href="?action=create" class="<?= $action === 'create' ? 'active' : '' ?>">➕ Nuovo Prodotto</a>
        <a href="/" >🏠 Home</a>
        <a href="/test-db.php" >🔍 Test DB</a>
    </div>

    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <?php if ($action === 'create' || $action === 'edit'): ?>
        <div class="container">
            <h2><?= $action === 'create' ? '➕ Aggiungi Nuovo Prodotto' : '✏️ Modifica Prodotto' ?></h2>
            <form method="POST" action="?action=<?= $action === 'create' ? 'create' : 'update' ?>">
                <?php if ($action === 'edit'): ?>
                    <input type="hidden" name="id" value="<?= $prodotto_edit['id'] ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="nome">Nome Prodotto:</label>
                    <input type="text" name="nome" id="nome" required 
                           value="<?= $prodotto_edit['nome'] ?? '' ?>">
                </div>
                
                <div class="form-group">
                    <label for="descrizione">Descrizione:</label>
                    <textarea name="descrizione" id="descrizione" rows="3"><?= $prodotto_edit['descrizione'] ?? '' ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="prezzo">Prezzo (€):</label>
                    <input type="number" name="prezzo" id="prezzo" step="0.01" required 
                           value="<?= $prodotto_edit['prezzo'] ?? '' ?>">
                </div>
                
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <select name="categoria" id="categoria">
                        <option value="Elettronica" <?= ($prodotto_edit['categoria'] ?? '') === 'Elettronica' ? 'selected' : '' ?>>Elettronica</option>
                        <option value="Accessori" <?= ($prodotto_edit['categoria'] ?? '') === 'Accessori' ? 'selected' : '' ?>>Accessori</option>
                        <option value="Gaming" <?= ($prodotto_edit['categoria'] ?? '') === 'Gaming' ? 'selected' : '' ?>>Gaming</option>
                        <option value="Monitor" <?= ($prodotto_edit['categoria'] ?? '') === 'Monitor' ? 'selected' : '' ?>>Monitor</option>
                        <option value="Altro" <?= ($prodotto_edit['categoria'] ?? '') === 'Altro' ? 'selected' : '' ?>>Altro</option>
                    </select>
                </div>
                
                <button type="submit">
                    <?= $action === 'create' ? '💾 Salva Prodotto' : '🔄 Aggiorna Prodotto' ?>
                </button>
                <a href="?action=list"><button type="button" class="btn-warning">↩️ Annulla</button></a>
            </form>
        </div>
    <?php endif; ?>

    <div class="container">
        <h2>📋 Lista Prodotti (<?= count($prodotti) ?> elementi)</h2>
        
        <?php if (empty($prodotti)): ?>
            <p>Nessun prodotto trovato. <a href="?action=create">Aggiungi il primo prodotto</a></p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrizione</th>
                        <th>Prezzo</th>
                        <th>Categoria</th>
                        <th>Data Creazione</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prodotti as $prodotto): ?>
                        <tr>
                            <td><?= $prodotto['id'] ?></td>
                            <td><strong><?= htmlspecialchars($prodotto['nome']) ?></strong></td>
                            <td><?= htmlspecialchars(substr($prodotto['descrizione'], 0, 50)) ?><?= strlen($prodotto['descrizione']) > 50 ? '...' : '' ?></td>
                            <td>€ <?= number_format($prodotto['prezzo'], 2) ?></td>
                            <td><span style="background: #e9ecef; padding: 2px 8px; border-radius: 12px; font-size: 0.85em;"><?= $prodotto['categoria'] ?></span></td>
                            <td><?= date('d/m/Y H:i', strtotime($prodotto['data_creazione'])) ?></td>
                            <td class="actions">
                                <a href="?action=edit&id=<?= $prodotto['id'] ?>">
                                    <button class="btn-warning">✏️ Modifica</button>
                                </a>
                                <a href="?action=delete&id=<?= $prodotto['id'] ?>" 
                                   onclick="return confirm('Sei sicuro di voler eliminare questo prodotto?')">
                                    <button class="btn-danger">🗑️ Elimina</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
