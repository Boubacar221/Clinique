<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="Traitement_connexion_docteur.php">
        <h1>Connexion </h1>
        <input type="text" name="identifiant" placeholder="identifiant" required><br>
        <input type="password" name="Mot_de_passe" placeholder="mot de passe" required>
        <input name="connexion" type="submit" value="connexion">
    </form>
    <img class="doctorimageconnect" src="images/docteur4.jpg" alt="">
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        margin-right: 10rem;
    }
    
    form {
        width: 400px;
        padding: 30px;
        background: rgba(0, 0, 0, 0.457);
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        margin-left: 15rem;
        text-align: center;
    }
    
    form:hover {
        transform: scale(1.05);
    }
    
    input[type="text"],
    input[type="email"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-top: 8px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>



</body>
</html>