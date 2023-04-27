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

echo ' <div class=" row d-flex justify-content-between  " style = "width: 80%; margin: auto; " >';

while($row = mysqli_fetch_assoc($result)) {


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


<div class=" container mt-5 " style="background-color:white;">

<h1 class ="text-center">Les Sessions</h1>

<?php

    $sessionAfficher = 
        "SELECT * FROM session s 
        INNER JOIN formation f 
        ON f.ID_formation = s.ID_formation
        INNER JOIN formateur ff ON ff.ID_formateur = s.ID_formateur
        WHERE s.ID_formation = $ID_formation ";
            
    
    $result = mysqli_query($connection, $sessionAfficher);
    
    if( mysqli_num_rows ( $result ) > 0 ){

        echo '<div class="row ">';

        while($row = mysqli_fetch_assoc($result)) {

    $session_id = $row["ID_session"];

    $placesReserverResult  = mysqli_query($connection, "SELECT COUNT(*) FROM inscription i INNER JOIN apprenant a ON a.ID_apprenant = i.ID_apprenant WHERE ID_session = $session_id");

    $placesReserverData = mysqli_fetch_assoc($placesReserverResult);

    $placesReserver = $placesReserverData['COUNT(*)'];

    if(!empty($_SESSION["ID_apprenant"])){

        echo ' <div class="card col-md-5" style=" background-color: #BBA8FF;">

        <div class="card-body">
            <h4 class="card-title">Session ID '.$row["ID_session"].'</h4>
            <p class="card-text"><strong>Date debut :</strong> ' .$row['date_debut']. '</p>
            <p class="card-text"><strong>Date fin :</strong> ' .$row['date_fin']. '</p>
            <p class="card-text"><strong>Fomateur :</strong> ' .$row['nom']. ' ' .$row['prenom']. '</p>
            <p class="card-text"><strong>Les Places :</strong> ' .$row['nbr_places_max'].'</p>
            <p class="card-text"><strong>Les Places Disponibles :</strong> ' .$row['nbr_places_max'] - $placesReserver.'</p>
            <p class="card-text"><strong>Etat :</strong> ' .$row['etat_session']. '</p>
    
            <button type="button" id="joinSessionbtn" class="btn" data-bs-toggle="modal" style = "width : 50% ; background-color: #7754F6;" data-bs-target="#joinSession' .$row['ID_session']. '">
            Join Session
            </button>
            
        </div>
    
    
        <div class="modal fade" id="joinSession'.$row["ID_session"].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title fs-5" id="exampleModalLabel">Join Session</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
        <form action=".php" method="get" enctype="multipart/form-data">
        
            <label for="ID">Are you sure want to join this Session ?</label>
            <input type="hidden" name="id_session" id="ID"  value="'.$row["ID_session"].'">
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input class="btn btn-success"  onclick="myFunction()" type="submit" name="joinSession" value="Join">
        
        
        </form>
            
        </div>
        </div>
        </div>
        </div>
        </div>
        ';
 

}
else{

    echo ' <div class="card col-md-5" style=" background-color: #BBA8FF;">

            <div class="card-body">
            <h4 class="card-title">Session ID '.$row["id_session"].'</h4>
            <p class="card-text"><strong>Date debut :</strong> ' .$row['date_debut']. '</p>
            <p class="card-text"><strong>Date fin :</strong> ' .$row['date_fin']. '</p>
            <p class="card-text"><strong>Fomateur :</strong> ' .$row['firstname']. ' ' .$row['lastname']. '</p>
            <p class="card-text"><strong>Les Places :</strong> ' .$row['nombre_places_max'].'</p>
            <p class="card-text"><strong>Les Places Disponibles :</strong> ' .$row['nombre_places_max'] - $placesReserver.'</p>
            <p class="card-text"><strong>Etat :</strong> ' .$row['etat']. '</p>

            <a type="button" href="login.php" class="btn btn-success">
            Join Session
            </a>
            </div>
        </div>
    ';

}

}
    
    
    echo '</div>';



    }
    else{

        echo '<div class="row latestsProductsdiv">';
                echo '<h1 class ="text-center">There is no Session in this Formation :)</h1>';
        echo '</div>';
    }
    ?>




</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>