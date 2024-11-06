<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$nomDeLaBase = "clinique";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $nomDeLaBase);

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
if (isset($_POST['connexion'])) {
    $identifiant = $_POST['identifiant'];
    $Mot_de_passe = $_POST['Mot_de_passe'];
}
// Requête SQL pour vérifier l'existence de l'utilisateur
$sql = "SELECT * FROM assistantes WHERE identifiant='$identifiant'  AND Mot_de_passe='$Mot_de_passe'";
$resultat = $connexion->query($sql);

// Vérification du résultat de la requête
if ($resultat->num_rows > 0) {
    // Utilisateur trouvé, accès autorisé
    echo "Accès autorisé.";
    header("Location: tableau_bord_assistante.php");
    exit();
} else {
    // Utilisateur non trouvé, accès refusé
    echo "Accès refusé! Identifiant ou mot de passe incorrect";
}
// Fermeture de la connexion à la base de données
$connexion->close();
