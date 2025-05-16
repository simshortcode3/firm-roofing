<?php
session_start();
if (!isset($_SESSION['admin'])) die("Unauthorized");

$data_file = '../data.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents($data_file), true);

    if ($_POST['action'] === 'add') {
        $data[] = $_POST['content'];
    } elseif ($_POST['action'] === 'delete') {
        unset($data[$_POST['index']]);
        $data = array_values($data);
    }

    file_put_contents($data_file, json_encode($data, JSON_PRETTY_PRINT));
}

$data = json_decode(file_get_contents($data_file), true);
?>

<h2>Admin Dashboard</h2>

<form method="POST">
    <input type="text" name="content" placeholder="Add content..." required />
    <input type="hidden" name="action" value="add" />
    <button type="submit">Add</button>
</form>

<ul>
    <?php foreach ($data as $index => $item): ?>
        <li>
            <?= htmlspecialchars($item) ?>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="index" value="<?= $index ?>" />
                <input type="hidden" name="action" value="delete" />
                <button type="submit">Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
