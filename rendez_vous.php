<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="lightslider.js"></script>
    <title>Gestion Clinique</title>
</head>
<body>
<nav id="navbar" class="nav-menu navbar">
<!-- <img class="appel" src="assets/images/icons8-appel-48.png" alt=""> -->
        <ul>
        <li><a class="liendashboard" href="tableau_bord_assistante.php" class="nav-link scrollto active"><img src="icones/icons8-nouveau-dossier-48.png" alt=""><i class="bx bx-home"></i> <span>Création dossier patient</span></a></li>
        <li><a class="liendashboard" href="rendez_vous.php" class="nav-link scrollto"><i class="bx bx-user"><img src="icones/icons8-calendrier-détachable-48" alt=""></i> <span> Programmer un Rendez-vous</span></a></li>
        <li><a class="liendashboard" href="gestion_dossier_patient.php" class="nav-link scrollto"><i class="bx bx-book-content"><img src="icones/icons8-cms-48.png" alt=""></i> <span>Gestion dossier Patient</span></a></li>
        </ul>
    </nav><!-- .nav-menu -->
    <h2>Programmer un Rendez-vous</h2>
<form class="formajoutpatient" method="post" action="">
        <label for="nom">Nom du patient :</label>
        <input type="text" id="nom" name="nom" required><br>
        <label for="prenom">Prénom du patient :</label>
        <input type="text" id="prenom" name="prenom" required><br>
        <label for="date du jour">Date du jour</label>
        <input type="date" id="selectedDate" name="date_day" min="2000-01-01" max="2100-12-31"><br>
        <script>
            // Fonction pour obtenir la date d'aujourd'hui au format 'YYYY-MM-DD'
            function getToday() {
                const today = new Date();
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const day = String(today.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            // Mettre la date d'aujourd'hui dans le champ d'entrée lors du chargement de la page
            document.getElementById('selectedDate').value = getToday();
        </script>
        <label for="date_rendez_vous">Date du rendez-vous</label>
        <input type="date" id="date_rv"name="date_rendez_vous" required><br>
        <label for="lieu rendez-vous">Date prochain rendez-vous</label>
        <input type="date" id="date_prochain_rendez_vous" name="date_prochain_rendez_vous" required><br>
        <label for="lieu rendez-vous">Lieu rendez-vous</label>
        <input type="text" id="lieu rendez-vous" name="lieu" required><br>
        <input type="submit" name="enregistrer" value="enregistrer" required>
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
if (isset($_POST['enregistrer'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_day = $_POST['date_day'];
    $date_rendez_vous = $_POST['date_rendez_vous'];
    $date_prochain_rendez_vous = $_POST['date_prochain_rendez_vous'];
    $lieu = $_POST['lieu'];

// Requête SQL pour inserer les données dans la table rendez_vous
$sql = "INSERT INTO  rendez_vous (nom,prenom,date_day,date_rendez_vous, date_prochain_rendez_vous,lieu) VALUES ('$nom', '$prenom','$date_day','$date_rendez_vous', '$date_prochain_rendez_vous','$lieu')";
mysqli_query($connexion, $sql);
echo " Rendez-vous enregistré avec succès! '<br>";
}
mysqli_close($connexion);
?>
</body>
</html>