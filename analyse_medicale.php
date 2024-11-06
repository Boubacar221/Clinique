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
        <li><a class="liendashboard" href="modifier_analyse.php" class="nav-link scrollto active"><img src="icones/icons8-traitement-48" alt=""><i class="bx bx-home"></i> <span>Prescrire ou modifier un traitement</span></a></li>
        <li><a class="liendashboard" href="modifier_rv.php" class="nav-link scrollto"><i class="bx bx-user"><img src="icones/icons8-calendrier-détachable-48.png" alt=""></i> <span> Prochain rendez-vous</span></a></li>
        <li><a class="liendashboard" href="analyse_medicale.php" class="nav-link scrollto"><i class="bx bx-file-blank"><img src="icones/icons8-plan-de-traitement-48.png" alt=""></i> <span>Ajout d'analyse médicale</span></a></li>
        
        </ul>
    </nav><!-- .nav-menu -->
    <h2>Ajout d'alnalyse médicale</h2>
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
            document.getElementById('selectedDate').value = getToday();getToday 
        </script>
        <label for="date analyse">Date d'analyse</label>
        <input type="date" id="date_analyse"name="date_analyse" required><br>
        <label for="analyses médicale">analyse médicale prescrite</label>
        <input class="champs_analyse" type="text" id="analyse médicale" name="analyse_prescrite"required ><br>
        <input type="submit" name="enregistrer" value="enregistrer">
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
    $date_analyse = $_POST['date_analyse'];
    $analyse_prescrite = $_POST['analyse_prescrite'];

    // Requête SQL pour vérifier l'existence de l'utilisateur
    $sql = "INSERT INTO  analyse_medicale (nom,prenom,date_day,date_analyse,analyse_prescrite) VALUES ('$nom', '$prenom','$date_day','$date_analyse','$analyse_prescrite')";
    mysqli_query($connexion, $sql);
    echo " Prescription d'analyse enregistré avec succès! '<br>";
} elseif (isset($_POST['afficher'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_day = $_POST['date_day'];
    $date_analyse = $_POST['date_analyse'];
    $analyse_prescrite = $_POST['analyse_prescrite'];
    // Requête SQL pour vérifier l'existence de l'utilisateur
    $sql = "SELECT * FROM analyse_medicale";
    $resultat = $connexion->query($sql);
    // Vérification du résultat de la requête
    if ($resultat->num_rows > 0) {
        // echo "<h3> Liste de toutes nos voitures </h3>";
        while ($row = $resultat->fetch_assoc()) {
            echo "<table border='5'>
    <tr>
        <th>nom</th>
        <th>prenom</th>
        <th>date_day</th>
        <th>date_analyse</th>
        <th>analyse_prescrite</th>
    </tr>";
            while ($row = mysqli_fetch_assoc($resultat)) {
                echo "<tr>
        <td>{$row['nom']}</td>
        <td>{$row['prenom']}</td>
        <td>{$row['date_day']}</td>
        <td>{$row['date_analyse']}</td>
        <td>{$row['analyse_prescrite']}</td>
    </tr>";
            }
        }
        echo "</table>";
        mysqli_close($connexion);
    }
}
?>
</body>
</html>