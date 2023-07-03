<?php
include 'connexion.php';

$requete = $bdd->query("SELECT * FROM messages INNER JOIN author ON messages.author_id = author.id ORDER BY messages.created_at ASC LIMIT 15");
$messages = $requete->fetchAll();

$allUniqueAuthors = [];
foreach ($messages as $message) {
    if (!in_array($message['name'], $allUniqueAuthors)) {
        array_push($allUniqueAuthors, $message['name']);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="chat-window">
                    <div class="messages">
                        <?php foreach ($messages as $message) : ?>
                            <div class="message">
                                <span class="username"><?= $message['name'] ?></span>
                                <span class="date"><?= date('H:i', strtotime($message['created_at'])) ?> :</span>
                                <span class="text"><?= $message['content'] ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <form class="message-form" action="saveMessage.php" method="post">
                        <input type="text" placeholder="Pseudo" name="pseudo">
                        <input type="text" placeholder="Message" name="message">
                        <button type="submit">Envoyer</button>
                    </form>
                </div>
            </div>
            <div class="col-4">
                <aside class="sidebar">
                    <div class="user-list">
                        <?php foreach ($allUniqueAuthors as $author) : ?>
                            <div class="user">
                                <span class="username"><?= $author ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </aside>
                <form action="deleteAllMessages.php" method="post">
                    <button type="submit">DELETE ALL</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>