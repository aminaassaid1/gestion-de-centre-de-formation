<?php
    
    if (isset($_POST['submit'])) {
      $first_name = $_POST['Firstname'];
      $last_name = $_POST['lastname'];
      $email = $_POST['email'];
      $password = $_POST['password']; 
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);   
      // validate form data
      if (empty($first_name) ||  empty($last_name) ||  empty($email) ||  empty($password)) {
        echo "Please fill in all fields)";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.";
      } else {
        // connect to the database
    
        $conn = mysqli_connect('localhost', 'root', '', 'centre_formation');
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
    
    
    
    
    
        // insert data into database
        $sql = "INSERT INTO `apprenant`(`nom`, `prenom`, `email`, `mot_de_passe`)  VALUES ('$first_name','$last_name','$email','$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            header("location:home.php");
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
      }
    }
    

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign up</title>

    <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="site-wrap d-md-flex align-items-stretch">
        <div class="bg-img" style="background-image: url('img/Hard_Working_Characters_PNG_Transparent__Cartoon_Cute_Vector_Free_Hard_Working_Character__Work_Hard__Cheer__Work_PNG_Image_For_Free_Download-removebg-preview\ \(1\).png')"></div>
        <div class="form-wrap">
            <div class="form-inner">
                <h1 class="title">Sign up</h1>
                <p class="caption mb-4">Create your account in seconds.</p>

                <form action="" method="post" class="pt-3">

                    <div class="form-floating">
                        <input type="text" class="form-control" name="Firstname" id="Fname" placeholder="First Name">
                        <label for="Fname">First Name</label>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="lastname" id="Lname" placeholder="Last Name">
                        <label for="Lname">Last Name</label>
                    </div>

                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="info@example.com">
                        <label for="email">Email Address</label>
                    </div>

                    <div class="form-floating">
                        <span class="password-show-toggle js-password-show-toggle"><span class="uil"></span></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <label for="password">Password</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label for="remember" class="form-check-label">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" name="submit" class="btn btn-primary">Create an account</button>
                    </div>

                    <div class="mb-2">Already a member? <a href="index.php">Log in</a></div>

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
