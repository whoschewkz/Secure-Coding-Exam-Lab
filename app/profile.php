<?php
include 'auth.php';

$username = $_SESSION['user'] ?? '';
$isAdmin  = (($_SESSION['role'] ?? '') === 'admin');

include '_header.php';

if ($isAdmin && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        die("Invalid CSRF token.");
    }
    $target = $_POST['delete_user'] ?? '';
    $stmt = $GLOBALS['PDO']->prepare("DELETE FROM users WHERE username = ?");
    $stmt->execute([$target]);
    $msg = "<p style='color:green'>User <b>".htmlspecialchars($target, ENT_QUOTES, 'UTF-8')."</b> berhasil dihapus!</p>";
}
?>
<h2>Profile Page</h2>
<p><?php echo "User: ".htmlspecialchars($username, ENT_QUOTES, 'UTF-8').", Role: ".($isAdmin ? "Admin" : "User"); ?></p>

<?php if ($isAdmin): ?>
  <h3>Admin Panel</h3>
  <form method="post">
    <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf'], ENT_QUOTES, 'UTF-8'); ?>">
    <label>Delete user:
      <select name="delete_user" required>
        <?php
        $users = $GLOBALS['PDO']->query("SELECT username FROM users");
        foreach ($users as $u) {
            if ($u['username'] !== $username) {
                $opt = htmlspecialchars($u['username'], ENT_QUOTES, 'UTF-8');
                echo "<option value='{$opt}'>{$opt}</option>";
            }
        }
        ?>
      </select>
    </label>
    <button type="submit">Delete</button>
  </form>
  <?php if (!empty($msg)) echo $msg; ?>
<?php else: ?>
  <p style="color:red">You are a regular user. You do not have admin panel access.</p>
<?php endif; ?>

<?php include '_footer.php'; ?>
