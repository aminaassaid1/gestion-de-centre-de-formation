<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "centre_formation");
if(!empty($_SESSION["ID_apprenant"])){
    $id = $_SESSION["ID_apprenant"];
    $result = mysqli_query($connection, "SELECT * FROM apprenant WHERE ID_apprenant = $id");
    $row = mysqli_fetch_assoc($result);
}
else{
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>SESSION</title>
</head>
<body>
     <!-- navbar -->
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
                            <a class="nav-link " href="Formations.php">Formations</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="profil.php">Profil </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="registration.php">My registrations</a>
                        </li>

                        </ul>
                            <div>
                                <form action="logout.php" method="get">
                                <input type="submit" value="Log out" class="btn btn-danger" name="logout">
                            </form>
                    </div>
                </div>

            </div>
        </nav>
    </div>
    
    <!-- carte détaile -->

    <div class="albumPrds album py-5" style="background-color: #BBA8FF; ">


    <div class=" container ">

    <?php

$ID_formation = $_GET["ID_formation"];

$formations = "SELECT * FROM formation WHERE ID_formation = $ID_formation";

$result = mysqli_query($connection, $formations);

if( mysqli_num_rows ( $result ) > 0 ){

echo ' <div class=" row d-flex justify-content-between " style = "width: 80%; margin: auto; " >';

while($row = mysqli_fetch_assoc($result)) {

    // $id_formation = $row["id_formation"];

    echo '
    <div class=" imgSt col-md-4" >
    <div class="OuvrageDetails"><h2><strong>' .$row['sujet']. '</strong></h2></div> 
    <div class="OuvrageDetails"> <h5><strong>Categorie :  </strong><span>' .$row['categorie']. '</span></h5></div> 
    <div class="OuvrageDetails"> <h5><strong>Masse Horaire : </strong><span>' .$row['duree']. 'h</span></h5></div> 
    </div>

    <div class="  col-md-7" > 
        

    <div> <h2>Description : </h2><span>' .$row['description']. '</span></div>  
    
    
    </div>';

}


echo '</div>';
}


?>


</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>