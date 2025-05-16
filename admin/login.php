<?php
session_start();
if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin123') {
    $_SESSION['admin'] = true;
    header('Location: dashboard.php');
    exit();
}
?>
<form method="POST">
    <input type="text" name="username" placeholder="Username" /><br>
    <input type="password" name="password" placeholder="Password" /><br>
    <button type="submit">Login</button>
</form>
