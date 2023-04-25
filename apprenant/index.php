<?php
session_start();
$msgs="";
if (isset($_POST['login'])){
     $email = $_POST['email'];
     $password = $_POST['password'];

   // Connect to database
$connection = mysqli_connect("localhost", "root", "", "centre_formation");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if record exists
$sql = "SELECT * FROM apprenant WHERE email = '$email'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);

    if($password == $row["mot_de_passe"]){
        $_SESSION["email"] = $row["email"];
        $_SESSION["password"] = $row["mot_de_passe"];
        $_SESSION["ID_apprenant"]=$row["ID_apprenant"];
        $_SESSION["fname"]=$row["nom"];
        $_SESSION["lname"]=$row["prenom"];
        header("location:home.php");
    }
} else {
    echo "Record does not exist.";
}

mysqli_close($connection);


}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title> Login </title>

    <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="site-wrap d-md-flex align-items-stretch">
        <div class="bg-img" style="background-image: url('img/Hard_Working_Characters_PNG_Transparent__Cartoon_Cute_Vector_Free_Hard_Working_Character__Work_Hard__Cheer__Work_PNG_Image_For_Free_Download-removebg-preview (1).png"></div>
        <div class="form-wrap">
            <div class="form-inner">
                <h1 class="title">Login</h1>
                <p class="caption mb-4">Please enter your login details to sign in.</p>

                <form action="#" class="pt-3" method="post">
                    <div class="form-floating">
                        <input type="email" class="form-control" name="email" id="email" placeholder="info@example.com">
                        <label for="email">Email Address</label>
                    </div>

                    <div class="form-floating">
                        <span class="password-show-toggle js-password-show-toggle"><span class="uil"></span></span>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <label for="password">Password</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label for="remember" class="form-check-label">Keep me logged in</label>
                        </div>
                        <div><a href="#">Forgot password?</a></div>
                    </div>
                    
                    <div class="d-grid mb-4">
                        <button type="submit" name="login" class="btn btn-primary">Log in</button>
                    </div>

                    <div class="mb-2">Don’t have an account? <a href="signup.php">Sign up</a></div>

                </form>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

    </body>
</html>
