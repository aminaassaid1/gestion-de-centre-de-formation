<?php
$connection = mysqli_connect('localhost', 'root', '', 'centre_formation');
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
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
        <div>
            <form action="signup.php" method="get">
                <input type="submit" value="Sign up" class="btn " style = "width : 200px ; background-color: #BBA8FF; " name="signup">
            </form>
        </div>
        <div>
            <form action="index.php" method="get">
                <input type="submit" value="Login" class="btn " style = "width : 200px ; background-color: #BBA8FF; " name="login" >
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

            </select>-->
        </form>

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
            <div>
                <p class="card-text"><strong>Categorie :</strong> '  .$row['categorie']. '</p>
                <p class="card-text"><strong>Masse Horaire :</strong> '  .$row['duree']. 'h</p>
            </div>
            <p class="card-text">'  .$row['description']. '</p>
    
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

<!-- About US -->
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>