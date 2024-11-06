<?php
$id = $_GET['id'];

if (isset($_POST['modifier'])) {
    // Vérifiez si toutes les variables $_POST nécessaires existent et ne sont pas vides
    if (
        isset($_POST['id']) &&
        isset($_POST['nom']) &&
        isset($_POST['prenom']) &&
        isset($_POST['age']) &&
        isset($_POST['sexe']) &&
        isset($_POST['poids']) &&
        isset($_POST['telephone']) &&
        isset($_POST['domicile']) &&
        isset($_POST['email']) &&
        !empty($_POST['id']) &&
        !empty($_POST['nom']) &&
        !empty($_POST['prenom']) &&
        !empty($_POST['age']) &&
        !empty($_POST['sexe']) &&
        !empty($_POST['poids']) &&
        !empty($_POST['telephone']) &&
        !empty($_POST['domicile']) &&
        !empty($_POST['email'])
    ) {
        // Incluez le fichier nécessaire
        include_once "affichage_dossiers_All.php";

        // Utilisez `htmlspecialchars()` pour sécuriser les données contre les attaques XSS
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $age = intval($_POST['age']); // Assurez-vous que l'âge est un entier
        $sexe = htmlspecialchars($_POST['sexe']);
        $poids = floatval($_POST['poids']); // Convertissez le poids en nombre flottant si nécessaire
        $telephone = htmlspecialchars($_POST['telephone']);
        $domicile = htmlspecialchars($_POST['domicile']);
        $email = htmlspecialchars($_POST['email']);

        // Sécurisez l'ID contre les injections SQL
        $id = intval($id);

        // Préparez la requête SQL
        $sql = "UPDATE patients 
                SET nom = '$nom', prenom = '$prenom', age = '$age', sexe = '$sexe', 
                    poids = '$poids', telephone = '$telephone', domicile = '$domicile', email = '$email' 
                WHERE id = $id";

        // Exécutez la requête SQL
        if (mysqli_query($connexion, $sql)) {
            header("Location: affichage_dossiers_All.php");
            exit();
        } else {
            header("Location: affichage_dossiers_All.php?message=Modification échouée");
            exit();
        }
    } else {
        // Redirection en cas de champs vides
        header("Location: affichage_dossiers_All.php?message=Champs vides");
        exit();
    }
}
?>   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gestion clinique</title>
</head>
<body background>
    
    <?php
    include_once 'affichage_dossiers_All.php';
    $sql = "SELECT * FROM patients WHERE id = $id";
    $resultat = mysqli_query($connexion, $sql);
    while ($row = mysqli_fetch_assoc($resultat)) { ?>
        <form class="formajoutpatient" action="" method="post">
            <h1>Modifier le dossier d'un patient</h1>
            Nom : <input type="text" name="nom" value="<?php echo $row['nom']; ?>"><br><br>
            Prénom : <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>"><br><br>
            Age : <input type="number" name="age" value="<?php echo $row['age']; ?>"><br><br>
            sexe : <input type="text" name="sexe" value="<?php echo $row['sexe']; ?>"><br><br>
            poids : <input type="text" name="poids" value="<?php echo $row['poids']; ?>"><br><br>
            groupe_sangain : <input type="text" name="groupe_sangain" value="<?php echo $row['groupe_sangain']; ?>"><br><br>
            telephone : <input type="number" name="telephone" value="<?php echo $row['telephone']; ?>"><br><br>
            Domicile : <input type="text" name="domicile" value="<?php echo $row['domicile']; ?>"><br><br>
            email : <input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>
            <input type="submit" value="modifier" name="modifier">
            <button><a href="affichage_dossiers_All.php">Annuler</a></button>


        </form>
<?php }
    ?>
</body>
</html>