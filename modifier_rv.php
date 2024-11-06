<?php
// Paramètres de connexion à la base de données
$host = 'localhost'; // ou l'adresse de votre serveur de base de données
$username = 'root';  // Nom d'utilisateur de votre base de données
$password = '';      // Mot de passe de votre base de données
$dbname = 'clinique'; // Nom de la base de données

// Connexion à la base de données
$connexion = mysqli_connect($host, $username, $password, $dbname);

// Vérifiez si la connexion a échoué
if (!$connexion) {
    die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

// Vérifiez que l'ID est passé via l'URL et qu'il est valide
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convertir l'ID en entier
} else {
    header("Location: affichage_rendez_vous_All.php?message=ID invalide");
    exit();
}

// Vérifiez si le bouton "modifier" a été cliqué
if (isset($_POST['modifier'])) {
    // Vérifiez si tous les champs sont bien remplis
    if (
        !empty($_POST['nom']) &&
        !empty($_POST['prenom']) &&
        !empty($_POST['date_day']) &&
        !empty($_POST['date_rendez_vous']) &&
        !empty($_POST['lieu']) &&
        !empty($_POST['date_prochain_rendez_vous'])
    ) {
        // Sécurisez les données entrantes
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $date_day = htmlspecialchars($_POST['date_day']);
        $date_rendez_vous = htmlspecialchars($_POST['date_rendez_vous']);
        $lieu = htmlspecialchars($_POST['lieu']);
        $date_prochain_rendez_vous = htmlspecialchars($_POST['date_prochain_rendez_vous']);

        // Préparez la requête SQL
        $sql = "UPDATE rendez_vous 
                SET nom = '$nom', prenom = '$prenom', date_day = '$date_day', 
                    date_rendez_vous = '$date_rendez_vous', lieu = '$lieu',
                    date_prochain_rendez_vous = '$date_prochain_rendez_vous'
                WHERE id = $id";

        // Exécutez la requête SQL
        if (mysqli_query($connexion, $sql)) {
            // Si la mise à jour est réussie, rediriger avec un message de succès
            header("Location: affichage_rendez_vous_All.php?message=Modification réussie");
            exit();
        } else {
            // Si la mise à jour échoue, rediriger avec un message d'erreur
            header("Location: affichage_rendez_vous_All.php?message=Modification échouée");
            exit();
        }
    } else {
        // Si des champs sont vides, rediriger avec un message d'erreur
        header("Location: affichage_rendez_vous_All.php?message=Champs vides");
        exit();
    }
} 

// Vérifiez si le bouton "ajouter" a été cliqué pour un prochain rendez-vous
elseif (isset($_POST['ajouter'])) {
    // Vérifiez si le champ "date_prochain_rendez_vous" est non vide
    if (!empty($_POST['date_prochain_rendez_vous'])) {
        $date_prochain_rendez_vous = htmlspecialchars($_POST['date_prochain_rendez_vous']);

        // Préparez la requête SQL pour mettre à jour la date du prochain rendez-vous
        $sql = "UPDATE rendez_vous 
                SET date_prochain_rendez_vous = '$date_prochain_rendez_vous' 
                WHERE id = $id";

        // Exécutez la requête SQL
        if (mysqli_query($connexion, $sql)) {
            // Affichez un message de succès
            echo "Prochain rendez-vous enregistré avec succès!<br>";
        } else {
            // Affichez un message d'erreur en cas d'échec
            echo "Erreur lors de l'enregistrement du prochain rendez-vous.";
        }
    } else {
        // Si le champ est vide, redirigez avec un message d'erreur
        header("Location: affichage_rendez_vous_All.php?message=Champ date prochain rendez-vous vide");
        exit();
    }
}

// Récupérer les données existantes pour les afficher dans le formulaire
$sql = "SELECT * FROM rendez_vous WHERE id = $id";
$resultat = mysqli_query($connexion, $sql);

// Si la requête retourne des données, afficher le formulaire de modification
if ($row = mysqli_fetch_assoc($resultat)) {
    ?>
    <form action="" method="post">
        <h1>Modifier le rendez-vous d'un patient</h1>
        Nom : <input type="text" name="nom" value="<?php echo $row['nom']; ?>"><br><br>
        Prénom : <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>"><br><br>
        Date du rendez-vous : <input type="date" name="date_day" value="<?php echo $row['date_day']; ?>"><br><br>
        Date du prochain rendez-vous : <input type="date" name="date_rendez_vous" value="<?php echo $row['date_rendez_vous']; ?>"><br><br>
        Lieu : <input type="text" name="lieu" value="<?php echo $row['lieu']; ?>"><br><br>
        Prochain rendez-vous : <input type="date" name="date_prochain_rendez_vous" value="<?php echo $row['date_prochain_rendez_vous']; ?>"><br><br>
        <input type="submit" value="Modifier" name="modifier">
        <a href="affichage_rendez_vous_All.php">Annuler</a>
    </form>
    <?php
} else {
    // Si aucun rendez-vous n'a été trouvé avec l'ID, afficher un message
    echo "Aucun rendez-vous trouvé pour cet ID.";
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
    include_once 'affichage_rendez_vous_All.php';
    $sql = "SELECT * FROM rendez_vous WHERE id = $id";
    $resultat = mysqli_query($connexion, $sql);
    while ($row = mysqli_fetch_assoc($resultat)) { ?>
        <form class="formajoutpatient" action="" method="post">
            <h1>Modifier le rendez_vous d'un patient</h1>
            Nom : <input type="text" name="nom" value="<?php echo $row['nom']; ?>"><br><br>
            Prénom : <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>"><br><br>
            date_day : <input type="date" name="date_day" value="<?php echo $row['date_day']; ?>"><br><br>
            date_rendez_vous : <input type="date" name="date_rendez_vous" value="<?php echo $row['date_rendez_vous']; ?>"><br><br>
            date_prochain_rendez_vous : <input type="date" name="date_prochain_rendez_vous" value="<?php echo $row['date_prochain_rendez_vous']; ?>"><br><br>
            lieu : <input type="text" name="lieu" value="<?php echo $row['lieu']; ?>"><br><br>
            <input type="submit" value="modifier" name="modifier">
            <input type="submit" value="ajouter" name="ajouter">
            <a href="affichage_rendez_vous_All.php">Annuler</a>
            <!-- <a href="date_prochain_rendez_vous">Ajouter date prochain rendez-vous</a> -->

        </form>
<?php }
    ?>
</body>
</html>