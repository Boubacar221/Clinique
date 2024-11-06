<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gestion clinique</title>
</head>
<body>
    <h2>Rechercher un patient</h2>
    <form action="" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>
        <input type="submit" name="rechercher" value="rechercher">
        
    </form>
    <?php
    $serveur = "localhost";
    $utilisateur = "root";
    $motDePasse = "";
    $nomDeLaBase = "clinique";
    $connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $nomDeLaBase);
    
    if (!$connexion) {
        die("La connexion à la base de données a échoué : " . mysqli_connect_error());
    }
    if(isset($_POST['rechercher'])){ // si le formulaire a été soumis
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sql = "SELECT * FROM patients WHERE nom='$nom'  AND prenom='$prenom'";
    $resultat = $connexion->query($sql);
 // Vérification du résultat de la requête
if ($resultat->num_rows > 0) {
// echo "<h3> Liste de toutes nos voitures </h3>";
while ($row = $resultat->fetch_assoc()) {
    echo "<table border='5'>
    <tr>
    <th>nom</th>
    <th>prenom</th>
    <th>age</th>
    <th>sexe</th>
    <th>poids</th>
    <th>groupe_sangain</th>
    <th>telephone</th>
    <th>domicile</th>
    <th>email</th>
    <th>Actions</th>
    </tr>";
    ?>
<?while ($row = mysqli_fetch_assoc($resultat)) ?>
        <td><?=$row['nom']?></td>
        <td><?=$row['prenom']?></td>
        <td><?=$row['age']?></td>
        <td><?=$row['sexe']?></td>
        <td><?=$row['poids']?></td>
        <td><?=$row['groupe_sangain']?></td>
        <td><?=$row['telephone']?></td>
        <td><?=$row['domicile']?></td>
        <td><?=$row['email']?></td>
        <td class="icones"><a href="modifier_dossier.php?id=<?=$row['id']?>"><img src="icones/icons8-modifier-la-propriété-48.png" alt="" title="modifier"></a></td>
        <td class="icones"><a href="supprimer_dossier.php?id=<?=$row['id']?>"><img src="icones/icons8-supprimer-pour-toujours-48.png" alt="" title="supprimer"></a></td><br>
    
    <?php
    
}
}
    
echo "</table>";
mysqli_close($connexion);
    
}

?>

</body>
</html>