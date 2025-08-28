<?php include 'auth.php'; ?>
<?php include '_header.php'; ?>
<h2>Ping Server</h2>
<form><input name="target" placeholder="host atau IP"><button>Ping!</button></form>
<?php
if (!isset($_GET['target'])) {
    die("Missing parameter.");
}
$target = trim($_GET['target']);

// Validasi sederhana: IPv4 atau domain
$valid = filter_var($target, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ||
         preg_match('/^(?=.{1,253}$)(?:[a-z0-9](?:[a-z0-9\-]{0,61}[a-z0-9])?\.)+[a-z]{2,}$/i', $target);

if (!$valid) {
    die("Invalid target.");
}

$cmd = (stripos(PHP_OS, 'WIN') === 0) ? 'ping -n 2 ' : 'ping -c 2 ';
$output = shell_exec($cmd . escapeshellarg($target));
echo "<h3>Ping Result for: " . htmlspecialchars($target, ENT_QUOTES, 'UTF-8') . "</h3>";
echo "<pre>" . htmlspecialchars($output ?? '', ENT_QUOTES, 'UTF-8') . "</pre>";
?>
<?php include '_footer.php'; ?>
