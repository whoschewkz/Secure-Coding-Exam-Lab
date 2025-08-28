<?php include 'auth.php'; ?>
<?php include '_header.php'; ?>
<h2>Post comments</h2>
<form method="post">
  <input name="author" placeholder="Name..." required>
  <textarea name="content" placeholder="Comments..." required></textarea>
  <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf'], ENT_QUOTES, 'UTF-8'); ?>">
  <button>Post</button>
</form>

<?php
if ($_POST) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        die("Invalid CSRF token.");
    }
    $stmt = $GLOBALS['PDO']->prepare("INSERT INTO comments(author,content,created_at) VALUES(?,?,datetime('now'))");
    $stmt->execute([$_POST['author'], $_POST['content']]);
}
?>
<h3>Comment lists : </h3>
<?php
foreach ($GLOBALS['PDO']->query("SELECT * FROM comments ORDER BY id DESC") as $row) {
    $a = htmlspecialchars($row['author'], ENT_QUOTES, 'UTF-8');
    $c = htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8');
    echo "<p><b>{$a}</b>: {$c}</p>";
}
?>
<?php include '_footer.php'; ?>
