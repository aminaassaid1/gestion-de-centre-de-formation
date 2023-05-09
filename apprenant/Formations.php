



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="barzone">
<nav class="navbar navbar-default navbar-trans navbar-expand-lg" >
    <div class="container">
    <a class="navbar-brand text-brand" href="home.php">GrowthZone</a>

    <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">

        <li class="nav-item">
            <a class="nav-link active" href="home.php">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="Formations.php">My registrations</a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="profile.php">Profil </a>
        </li>
        </ul>
        <div>
            <form action="logout.php" method="get">
                <input type="submit" value="Log out" class="btn" style = "width : 200px ; background-color: #3B1BB0; " name="logout">
            </form>
        </div>
    </div>

    </div>
</nav>
</div>


<div class="row">
    <h2 class="text-center">My registrations</h2>
</div>

<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "centre_formation");

if (isset($_SESSION["ID_apprenant"]) && !empty($_SESSION["ID_apprenant"])) {
    $id = $_SESSION["ID_apprenant"];
//     $historique = "SELECT * FROM inscription  ms  
// INNER JOIN session  s ON s.ID_session  = ms.ID_session 
// INNER JOIN formation f ON f.ID_formation  = s.ID_session 
// WHERE ms.ID_apprenant  = 9";

    $historique = "SELECT Session.ID_session, Formation.sujet, Session.date_debut, Session.date_fin, Inscription.resultat, Inscription.date_evaluation 
    FROM Session 
    INNER JOIN Formation ON Session.Id_formation = Formation.ID_formation
    INNER JOIN Inscription ON Session.ID_session = Inscription.ID_session
    INNER JOIN Apprenant ON Inscription.ID_apprenant = Apprenant.ID_apprenant
    WHERE Apprenant.ID_apprenant = 3
    ORDER BY Session.date_debut DESC";

    $result = mysqli_query($connection, $historique);
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="row" style="width:60%; margin:auto;">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo ' <div class="card col-md-5" style=" background-color: #BBA8FF;">
            <h3><strong>Title: </strong>' . $row['sujet'] . '</h3>
                <p><strong>Date: </strong>' . $row['date_debut'] . ' / ' . $row['date_fin'] . '</p>
                <div class=""><strong>Result: </strong><span>' . $row['resultat'] . '</span></div>
                <div class=""><strong>Date Assessment: </strong><span>' . $row['date_evaluation'] . '</span></div>
            </div>';
        }
        echo '</div>';
    } else {
        echo '<div class="row">';
        echo '<h1 class="text-center">There are no Inscription  :)</h1>';
        echo '</div>';
    }
} else {
    echo '<div class="row">';
    echo '<h1 class="text-center">Invalid session ID.</h1>';
    echo '</div>';
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>