<?php include 'auth.php'; ?>
<?php include '_header.php'; ?>
<h2>Wiki Search</h2>
<form><input name="q"><button>Search</button></form>
<?php
if (isset($_GET['q'])) {
    $q = $_GET['q'];
    $stmt = $GLOBALS['PDO']->prepare("SELECT * FROM articles WHERE title LIKE ?");
    $stmt->execute(['%'.$q.'%']);
    $safeQ = htmlspecialchars($q, ENT_QUOTES, 'UTF-8');
    echo "<p>Searching: {$safeQ}</p>";
    foreach ($stmt as $row) {
        $t = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
        $b = htmlspecialchars($row['body'], ENT_QUOTES, 'UTF-8');
        echo "<li>{$t}: {$b}</li>";
    }
}
?>
<?php include '_footer.php'; ?>
