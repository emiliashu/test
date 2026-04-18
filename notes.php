<?php
require 'podkl.php';
require 'basa.php';

$action = $_GET['action'] ?? 'list';
$noteId = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'create') {
        createNote($pdo, $_SESSION['user_id'], $_POST['title'], $_POST['body']);
        header('Location: notes.php');
        exit;
    }
    
    if ($action === 'edit' && $noteId) {
        updateNote($pdo, $noteId, $_SESSION['user_id'], $_POST['title'], $_POST['body']);
        header('Location: notes.php');
        exit;
    }
}

if ($action === 'delete' && $noteId) {
    deleteNote($pdo, $noteId, $_SESSION['user_id']);
    header('Location: notes.php');
    exit;
}

if ($action === 'toggle_pin' && $noteId) {
    togglePin($pdo, $noteId, $_SESSION['user_id']);
    header('Location: notes.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notes</title>
</head>
<body>

<?php if ($action === 'create'): ?>

<h1>New note</h1>
<form method="POST">
    <p><input type="text" name="title" placeholder="Title"></p>
    <p><textarea name="body" placeholder="Body" rows="10" cols="40"></textarea></p>
    <button type="submit">Save</button>
    <a href="notes.php">Cancel</a>
</form>

<?php elseif ($action === 'edit' && $noteId): 
    $note = getNoteById($pdo, $noteId, $_SESSION['user_id']);
    if (!$note): ?>
        <p>Note not found</p>
        <a href="notes.php">Back</a>
    <?php else: ?>

<h1>Edit note</h1>
<form method="POST">
    <p><input type="text" name="title" value="<?= htmlspecialchars($note['title']) ?>"></p>
    <p><textarea name="body" rows="10" cols="40"><?= htmlspecialchars($note['body']) ?></textarea></p>
    <button type="submit">Update</button>
    <a href="notes.php">Cancel</a>
</form>

<?php endif; ?>

<?php else: ?>

<h1>My notes</h1>
<a href="notes.php?action=create">New note</a>

<?php
$notes = getNotesByUser($pdo, $_SESSION['user_id']);
if (empty($notes)): ?>
    <p>No notes</p>
<?php else: ?>
    <?php foreach ($notes as $note): ?>
        <div>
            <h3><?= $note['is_pinned'] ? '[PINNED] ' : '' ?><?= htmlspecialchars($note['title'] ?: 'Untitled') ?></h3>
            <p><?= nl2br(htmlspecialchars(substr($note['body'], 0, 200))) ?></p>
            <p>
                <a href="notes.php?action=edit&id=<?= $note['id'] ?>">Edit</a>
                <a href="notes.php?action=delete&id=<?= $note['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
                <a href="notes.php?action=toggle_pin&id=<?= $note['id'] ?>"><?= $note['is_pinned'] ? 'Unpin' : 'Pin' ?></a>
            </p>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

<?php endif; ?>

</body>
</html>