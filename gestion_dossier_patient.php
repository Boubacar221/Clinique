<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gestion Patient</title>
</head>
<body>
    
    <nav id="navbar" class="nav-menu navbar">
<!-- <img class="appel" src="assets/images/icons8-appel-48.png" alt=""> -->
        <ul>
        <li><a class="liendashboard" href="tableau_bord_assistante.php" class="nav-link scrollto active"><img src="icones/icons8-nouveau-dossier-48" alt=""><i class="bx bx-home"></i> <span>Création dossier patient</span></a></li>
        <li><a class="liendashboard" href="rendez_vous.php" class="nav-link scrollto"><i class="bx bx-user"><img src="icones/icons8-calendrier-détachable-48.png" alt=""></i> <span> Programmer un Rendez-vous</span></a></li>
        <li><a class="liendashboard" href="gestion_dossier_patient.php" class="nav-link scrollto"><i class="bx bx-book-content"><img src="icones/icons8-cms-48.png" alt=""></i> <span>Gestion dossier Patient</span></a></li>
        </ul>
    </nav><!-- .nav-menu -->
    <h2>Gestion dossiers patients</h2>
    <button type="submit" name="afficher_dossiers" class="bouttondashboard"><a class="Liendashboard" href="affichage_dossiers_All.php">Afficher tous les patients<img src="icones/icons8-appeler-au-lit-48.png" alt=""></a></button>
    <button type="submit" name="afficher_rv" class="bouttondashboard"><a class="Liendashboard" href="Affichage_rendez_vous_All.php">Afficher tous les rendez_vous</a><img src="icones/icons8-calendrier-détachable-48.png" alt=""></button>
    <button class="bouttondashboard" name="modifier_dossiers"><a class="Liendashboard" href="affichage_dossiers_All.php">Modifier le dossier patient <img src="icones/icons8-modifier-la-propriété-48.png" alt=""></a></button>
    <button class="bouttondashboard" name="rechercher_dossiers"><a class="Liendashboard" href="recherche_patient.php">Rechercher un dossier patient<img src="icones/icons8-voir-le-fichier-48.png" alt=""></a> </button>
    <button class="bouttondashboard" name="inserer_analyses"><a class="Liendashboard" href="analyse_medicale.php">Inserer les analyses patient<img src="icones/icons8-traitement-48.png" alt=""></a></button>
    <button type="submit" name="afficher" class="bouttondashboard"><a class="Liendashboard"  href="Affichage_analyses.php">Afficher les analyses<img src="icones/icons8-traitement-48.png" alt=""></a></button>
    <button type="submit" name="afficher" class="bouttondashboard"><a class="Liendashboard"  href="profile_patient.php">Profile patient<img src="icones/icons8-patient-48.png" alt=""></a></button>
    <?php
    $serveur = "localhost";
    $utilisateur = "root";
    $motDePasse = "";
    $nomDeLaBase = "clinique";

    $connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $nomDeLaBase);

    if (!$connexion) {
        die("La connexion à la base de données a échoué : " . mysqli_connect_error());
    }
    //         if (isset($_POST['afficher_dossiers'])) {
    //             $nom = $_POST['nom'];
    //             $prenom = $_POST['prenom'];
    //             $age = $_POST['age'];
    //             $sexe = $_POST['sexe'];
    //             $poids = $_POST['poids'];
    //             $groupe_sangain = $_POST['groupe_sangain'];
    //             $telephone = $_POST['telephone'];
    //             $email = $_POST['email'];

    //         }
    //         // Requête SQL pour vérifier l'existence de l'utilisateur
    //         $sql = "SELECT * FROM patients";
    //         $resultat = $connexion->query($sql);
    //          // Vérification du résultat de la requête
    //     if ($resultat->num_rows > 0) {
    //         // echo "<h3> Liste de toutes nos voitures </h3>";
    //         while ($row = $resultat->fetch_assoc()) {
    //             echo "<table border='5'>
    //             <tr>
    //                 <th>nom</th>
    //                 <th>prenom</th>
    //                 <th>age</th>
    //                 <th>sexe</th>
    //                 <th>poids</th>
    //                 <th>groupe_sangain</th>
    //                 <th>telephone</th>
    //                 <th>email</th>
    //             </tr>";
    //     while ($row = mysqli_fetch_assoc($resultat)) {
    //         echo "<tr>
    //                 <td>{$row['nom']}</td>
    //                 <td>{$row['prenom']}</td>
    //                 <td>{$row['age']}</td>
    //                 <td>{$row['sexe']}</td>
    //                 <td>{$row['poids']}</td>
    //                 <td>{$row['groupe_sangain']}</td>
    //                 <td>{$row['telephone']}</td>
    //                 <td>{$row['email']}<button class='boutonaction'><img src='icones/icons8-supprimer-pour-toujours-48.png' </button> <button class='boutonaction'><img src='icones/icons8-modifier-la-propriété-48.png' </button></td>
    //             </tr>";
    //     }
    //         }
    //     echo "</table>";

    // }

    if (isset($_POST['afficher'])) {
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