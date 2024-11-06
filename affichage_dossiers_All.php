<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="style.css">
    <title>Gestion clinique</title>
</head>
<body>
    <a class="retour" href="gestion_dossier_patient.php">Retour</a>
    <h2>Information sur Nos patients</h2>
<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$nomDeLaBase = "clinique";
$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $nomDeLaBase);

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
if (isset($_POST[''])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $sexe = $_POST['sexe'];
    $poids = $_POST['poids'];
    $groupe_sangain = $_POST['groupe_sangain'];
    $telephone = $_POST['telephone'];
    $domicile = $_POST['domicile'];
    $email = $_POST['email'];
}

$sql = "SELECT * FROM patients";
$resultat = $connexion->query($sql);

// Vérification du résultat de la requête
if ($resultat->num_rows > 0) {
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nom</th>';
    echo '<th>Prénom</th>';
    echo '<th>Âge</th>';
    echo '<th>Sexe</th>';
    echo '<th>Poids</th>';
    echo '<th>Groupe Sanguin</th>';
    echo '<th>Téléphone</th>';
    echo '<th>Domicile</th>';
    echo '<th>Email</th>';
    echo '<th>Actions</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($resultat)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
        echo '<td>' . htmlspecialchars($row['prenom']) . '</td>';
        echo '<td>' . htmlspecialchars($row['age']) . '</td>';
        echo '<td>' . htmlspecialchars($row['sexe']) . '</td>';
        echo '<td>' . htmlspecialchars($row['poids']) . '</td>';
        echo '<td>' . htmlspecialchars($row['groupe_sangain']) . '</td>';
        echo '<td>' . htmlspecialchars($row['telephone']) . '</td>';
        echo '<td>' . htmlspecialchars($row['domicile']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
        echo '<td class="icones">';
        echo '<a href="modifier_dossier.php?id=' . $row['id'] . '"><img src="icones/icons8-modifier-la-propriété-48.png" alt="Modifier" title="Modifier"></a>';
        echo '<a href="supprimer_dossier.php?id=' . $row['id'] . '"><img src="icones/icons8-supprimer-pour-toujours-48.png" alt="Supprimer" title="Supprimer"></a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<p>Aucun patient trouvé.</p>';
}
?>

</body>
</html>

