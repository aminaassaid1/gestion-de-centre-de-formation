<?php
session_start();

$connection = mysqli_connect('localhost', 'root', '', 'centre_formation');
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
if(!empty(["ID_apprenant"])){
    $id = $_SESSION["ID_apprenant"];
    $result = mysqli_query($connection, "SELECT * FROM `apprenant` WHERE `ID_apprenant` = $id");
}else{
    header("Location:index.php");
}
if (isset($_POST['update'])) {
    $fname = $_POST['Fname'];
    $lname = $_POST['Lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $id = $_SESSION["ID_apprenant"];

    
  
    $result = mysqli_query($connection,"UPDATE apprenant SET nom='$fname', prenom='$lname', email='$email', mot_de_passe='$hashed_password' WHERE ID_apprenant='$id'");
    $row = mysqli_fetch_assoc($result);
    
    header('Location: profile.php');
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>edit profile account details </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    	body{margin-top:20px;
background-color:#f2f6fc;
color:#69707a;
}
.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
    </style>
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
                            <a class="nav-link " href="Formations.php">My registrations</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="profile.php">Profil </a>
                        </li>
                        </ul>
                            <div>
                                <form action="logout.php" method="get">
                                <input type="submit" value="Log out" class="btn" style = "width : 200px ; background-color: #7754F6; " name="logout">
                            </form>
                    </div>
                </div>

            </div>
        </nav>
    </div>
<div class="">

<div class="card mb-4">
<div class="card-header">Account Details</div>
<div class="card-body">
    <?php
     $sql="SELECT * FROM `apprenant` WHERE `ID_apprenant` =$id";
     $result=mysqli_query($connection,$sql);
    while($row=mysqli_fetch_assoc($result)){
        ?>
        <form method="POST" action="">

            <div class="row gx-3 mb-3">

            <div class="col-md-6">
                <label class="small mb-1" for="inputFirstName">First name</label>
                <input class="form-control" id="inputFirstName" type="text" name="Fname" placeholder="Enter your first name" required value="<?php echo $row["nom"]?>">
            </div>

            <div class="col-md-6">
                <label class="small mb-1" for="inputLastName">Last name</label>
                <input class="form-control" id="inputLastName" name="Lname" type="text" placeholder="Enter your last name" required value="<?php echo $row["prenom"]?>">
            </div>

            </div>

            <div class="mb-3">
                <label class="small mb-1" for="inputEmailAddress">Email</label>
                <input class="form-control" id="inputEmailAddress" name="email" type="email" placeholder="Enter your email address" required value="<?php echo $row["email"]?>">
            </div>

            <div class="mb-3">
                <label class="small mb-1" for="inputPassword">Password</label>
                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Enter a new password" required>
            </div>

            <button class="btn btn-primary" type="submit" name="update">Save changes</button>

        </form>
        <?php
    }
    ?>

</div>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>