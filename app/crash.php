<?php include 'auth.php'; ?>
<?php include '_header.php'; ?>
<h2>Crash Test</h2>
<?php
$factor = $_GET['factor'] ?? 1;

if (!is_numeric($factor)) {
    echo "factor harus angka.";
} else {
    $factor = (float)$factor;
    if ($factor == 0.0) {
        echo "Tidak bisa membagi dengan nol.";
    } else {
        $result = 100 / $factor;
        echo "100 / " . htmlspecialchars((string)($_GET['factor'] ?? ''), ENT_QUOTES, 'UTF-8') . " = " . $result;
    }
}
?>
<?php include '_footer.php'; ?>
