<?php

include 'connexion.php';

$pseudo = $_POST['pseudo'];
$message = $_POST['message'];

$requete = $bdd->query("SELECT * FROM author WHERE name = '$pseudo'");
$resultat = $requete->fetch(PDO::FETCH_ASSOC);


if ($resultat) {
    $id_author = $resultat['id'];
} else {
    $requete = $bdd->prepare("INSERT INTO author (name) VALUES (?)");
    $requete->execute([$pseudo]);
    $id_author = $bdd->lastInsertId();
}

$requete = $bdd->prepare("INSERT INTO messages (author_id, content, created_at) VALUES (:author_id, :content, NOW())");
$requete->execute([
    "author_id" => $id_author,
    "content" => $message
]);

header('Location: index.php');
