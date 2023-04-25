<?php
require 'config.php';
if(!empty($_SESSION["ID_apprenant"])){
    $id = $_SESSION["ID_apprenant"];
    $result = mysqli_query($conn, "SELECT * FROM apprenant WHERE id_apprenant = $id");
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
            <a class="nav-link " href="profil.php">Profil </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="registration.php">My registrations</a>
        </li>

        </ul>
        <div>
            <form action="logout.php" method="get">
                <input type="submit" value="Log out" class="btn btn-danger" name="longout">
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

<!-- Our Formations -->
<div class="albumPrds album py-5">
    <h2 class="text-center">Our Formations</h2>
</div>
<div class="latestsProducts container">
 <?php
 
 ?>    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>