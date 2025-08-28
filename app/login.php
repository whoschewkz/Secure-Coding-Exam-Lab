<?php
include 'auth.php';

if ($_POST) {
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';

    $stmt = $GLOBALS['PDO']->prepare("SELECT username, password, role FROM users WHERE username = ?");
    $stmt->execute([$u]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // NB: untuk demo plaintext, samakan dengan seed. Produksi: gunakan password_verify()
    if ($row && hash_equals($row['password'], $p)) {
        session_regenerate_id(true);
        $_SESSION['user'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Login failed.";
    }
}
?>
<?php include '_header.php'; ?>
<h2>Login</h2>
<?php if (!empty($error)) echo "<p style='color:red'>".htmlspecialchars($error, ENT_QUOTES, 'UTF-8')."</p>"; ?>
<form method="post">
  <label>Username <input name="username" required></label>
  <label>Password <input type="password" name="password" required></label>
  <button type="submit">Login</button>
</form>
<?php include '_footer.php'; ?>
