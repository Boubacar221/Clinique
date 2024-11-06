<?php
    $id = $_GET['id'];
    include_once "gestion_dossier_patient.php";
    $sql = "DELETE FROM patients where id = $id";
if(mysqli_query($connexion,$sql)){
    header("location:affichage_dossiers_All.php?message=supprimé avec succès");

}
else{
    header("location:affichage_dossiers_All.php?message=Erreur de suppression");
}


