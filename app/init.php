<?php
// init.php (versi aman)

$dbDir  = __DIR__ . '/data';
$dbFile = $dbDir . '/app.db';
$needSeed = !file_exists($dbFile);

// Pastikan folder data/ ada
if (!is_dir($dbDir)) {
    mkdir($dbDir, 0755, true);
}

$pdo = new PDO('sqlite:' . $dbFile);
// Mode error & prepared statements native
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

// (Opsional) sedikit penguatan SQLite
$pdo->exec("PRAGMA foreign_keys = ON;");
$pdo->exec("PRAGMA journal_mode = WAL;");

if ($needSeed) {
    // Buat skema
    $pdo->exec("
        CREATE TABLE users(
            id INTEGER PRIMARY KEY,
            username TEXT UNIQUE,
            password TEXT NOT NULL,
            role TEXT NOT NULL
        );
        CREATE TABLE articles(
            id INTEGER PRIMARY KEY,
            title TEXT,
            body TEXT
        );
        CREATE TABLE comments(
            id INTEGER PRIMARY KEY,
            author TEXT,
            content TEXT,
            created_at TEXT
        );
    ");

    // SEED: gunakan password_hash agar login aman
    $alicePass = password_hash('alice123', PASSWORD_DEFAULT);
    $adminPass = password_hash('admin123', PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users(username,password,role) VALUES(?,?,?)");
    $stmt->execute(['alice', $alicePass, 'user']);
    $stmt->execute(['admin', $adminPass, 'admin']);

    $stmtA = $pdo->prepare("INSERT INTO articles(title,body) VALUES(?,?)");
    $stmtA->execute(['PHP', 'Server side scripting']);
    $stmtA->execute(['Java', 'Programming language']);
}

$GLOBALS['PDO'] = $pdo;
