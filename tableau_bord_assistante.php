<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>GESTION CLINIQUE</title>
</head>
<body>
<!--
    Dans cette page nous avons Ajout dossier patient par défaut
!-->
<nav id="navbar" class="nav-menu navbar">
<!-- <img class="appel" src="assets/images/icons8-appel-48.png" alt=""> -->
        <ul>
        <li><a class="liendashboard" href="tableau_bord_assistante.php" class="nav-link scrollto active"><img src="icones/icons8-nouveau-dossier-48.png" alt=""><i class="bx bx-home"></i> <span>Création dossier patient</span></a></li>
        <li><a class="liendashboard" href="rendez_vous.php" class="nav-link scrollto"><i class="bx bx-user"><img src="icones/icons8-calendrier-détachable-48.png" alt=""></i><span> Programmer un Rendez-vous</span></a></li>
        <li><a class="liendashboard" href="gestion_dossier_patient.php" class="nav-link scrollto"><i class="bx bx-book-content"><img src="icones/icons8-cms-48.png" alt=""></i> <span>Gestion dossier Patient</span></a></li>
        </ul>
    </nav><!-- .nav-menu -->
    <h2>Ajouter un nouveau patient</h2>
    <form class="formajoutpatient" method="post" action="">
        <img src="icones/icons8-examen-48.png" alt=""><br>
        <label for="nom">Nom du patient :</label>
        <input type="text" id="nom" name="nom" required><br>
        <label for="prenom">Prénom du patient :</label>
        <input type="text" id="prenom" name="prenom" required><br>
        <label for="age">Age du patient :</label>
        <input type="number" id="age" name="age" required><br>
        <label for="sexe">Sexe du patient :</label>
        <select id="sexe" name="sexe" required>
            <option value="M">M</option>
            <option value="F">F</option>
        </select>
        <br>
        <label for="poids">Poids</label>
        <input type="text" id="poids" name="poids" required><br>
        <label for="groupe_sangain">Groupe sanguin :</label>
        <select id="groupe_sangain" name="groupe_sangain"required>
            <option value="O+">0+</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="AB">AB</option>
        </select><br>
        <label for="telephone"> telephone patient:</label>
        <input type="number" id="telephone" name="telephone"required><br>
        <label for="domcile"> Domicile patient:</label>
        <input type="text" id="domicile" name="domicile"required><br> 
        <label for="email">email patient: </label>
        <input type="email" id="email" name="email" required><br>
        <input type="submit" name="ajouter" value="ajouter">

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
if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $sexe = $_POST['sexe'];
    $poids = $_POST['poids'];
    $groupe_sangain = $_POST['groupe_sangain'];
    $telephone = $_POST['telephone'];
    $domicile = $_POST['domicile'];
    $email = $_POST['email'];

// Requête SQL pour vérifier l'existence de l'utilisateur
$sql = "INSERT INTO  patients (nom,prenom,age,sexe,poids,groupe_sangain,telephone,domicile,email) VALUES ('$nom', '$prenom','$age','$sexe','$poids','$groupe_sangain','$telephone','$domicile','$email')";
mysqli_query($connexion, $sql);
echo " Enregistrement réussi! '<br>";
}
mysqli_close($connexion);


?>















</body>
</html>