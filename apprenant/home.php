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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
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
            <a class="nav-link " href="profile.php">Profil </a>
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

<!-- landing -->
<div
    class="bg-image p-5 text-center shadow-1-strong mb-3 text-white"
    style="background-image: url('img/Grow_Your_Skills_Your_Career_with_GrowthZone.png');
    height: 80vh;  ">
</div>

<!-- Filter  -->

<div class="albumPrds album py-5">

<div class="row">
    <h2 class="text-center">Our Formations</h2>
</div>

<div class="filterSearch pt-5 row  text-center" style="width: 70%; margin: auto;"> 

    <div class="filterdiv col-md-6 mb-3">

        <form action = "" method = "GET" class="" >

            <select class="btn btn-outline-dark" name="categories" id = "categories">
        
                <option value="" name = "allCategories" >All Categories</option>
        
                <option value="informatique" name = "informatique" >Informatique</option>
                <option value="Commerce" name = "gaming">Commerce</option>
                <option value="desing" name = "">desing</option>
                
            </select>
        
        
            <input class="btn btn-success" type="submit" value = "Filter" name = "filterbtn" id = "">
        
            </form>

    </div>

    <!-- Search -->

    <div class="searchdiv col-md-4">

        <form method = "GET" action = "search_formation.php" class="input-group">
            
            <input type="search" name="searchFormation" id="" class="form-control" placeholder="Search" required/>

            <!-- <select name="searchFormation" id="sujet">
                <option value="hh">hh</option>
                <option value="hhhhh">hhhh</option>

            </select> -->
        </form>

    </div>



</div>
</div>


<!-- Filter & Search -->

<div class="albumPrds album">


    <div class="latestsProducts container">

<?php


$formationssql = 
"SELECT * FROM formation";

if(isset($_GET['filterbtn'])){

    $categories = $_GET['categories'];

    if ($categories != ""){

        $formationssql = "SELECT * FROM formation WHERE categorie = '$categories'";
}
}


$result = mysqli_query($connection, $formationssql);



if( mysqli_num_rows ( $result ) > 0 ){

    echo ' <div class="latestsProductsdiv row">';

   $sujet = array();

    while($row = mysqli_fetch_assoc($result)) {
    
        $ID_formation = $row["ID_formation"];
        $sujet[]=$row['sujet'];
       
        
        echo '
        <div class="col-md-4 mb-4">
        <form method = "GET" action = "session.php" class=" card "  style=" background-color: #BBA8FF;">
        <div class="card-body">
            <h4 class="card-title">' .$row['sujet']. '</h4>
            <div d-flex flex-row >
                <div class="p-2"><p class="card-text"><strong>Category :</strong> '  .$row['categorie']. '</p></div>
                <div class="p-2"><p class="card-text"><strong>duration :</strong> '  .$row['duree']. 'h</p></div>
            </div>
            <p class="card-text">'  .$row['description']. '</p>
    
            <input type="hidden" name="ID_formation" type = "submit" value ="'.$ID_formation.'">
            <input class="btn" type="submit" value = "Details" style = "width : 50% ; background-color: #7754F6; ">
    
        </div>
        
        </form>
        </div>';
    
    }


echo '</div>';

}






else{

    echo '<div class="row latestsProductsdiv">';
            echo '<h1 class ="text-center">There is no Formation available :)</h1>';
    echo '</div>';
}

$response = array('sujet'=> $sujet);

echo json_encode($response);


?>
</div>
</div>


<!-- About US -->
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>