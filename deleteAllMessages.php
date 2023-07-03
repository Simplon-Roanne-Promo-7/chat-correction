<?php
include 'connexion.php';

$requete = $bdd->prepare("DELETE FROM author");
$requete->execute();

header('Location: index.php');
