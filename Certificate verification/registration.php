
<?php require('connection.php'); 
?>
<?php
error_reporting(E_ERROR | E_PARSE);
if(isset($_POST['submit']))
{
    $pass=$_POST['password'] ;
    $cpass=$_POST['cpassword'];
     # get email from Data base
    $user_exist_query="SELECT * FROM `user` where  `email`='$_POST[email]'";
    $result=mysqli_query($con,$user_exist_query);
    if($result)
    {  
        if($pass==$cpass )
        {
                $result_fetch=mysqli_fetch_assoc($result);
                if ($result_fetch['email']==$_POST['email'])  # email already taken
                {
                       echo "<script>alert(' $result_fetch[email] already taken');
                       </script>";
        
    
                }
                else # email not taken
                { 
                        $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
                        $query="INSERT INTO `user` (`name`,`email`,`password`)
                        VALUES ('$_POST[name]','$_POST[email]','$password')";
                        if(mysqli_query($con,$query))
                        {
                            # if data added successfully
                            echo "<script>alert('Registration Successful');
                            window.location.href='registration.php';
                            </script>";

                        }
                        else
                        {
                            # if data is not added successfully
                            echo "<script>alert('Cannot run query');
                            window.location.href='registration.php';
                            </script>";
                        }
                }
            
        }
        else
        {
            echo "<script>alert('Password not matched ');
            window.location.href='registration.php';
            </script>";

        }
    }
    else
    {
        echo "<script>alert('Cannot run query');
        window.location.href='registration.php';
        </script>"; 
    }
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
    <style>
        .container {
            opacity: 0;
            transform: scale(0.5);
            transition: opacity 0.5s, transform 0.5s;
        }

        .container.show {
            opacity: 1;
            transform: scale(1);
        }
    </style>
    <script>
        window.onload = function() {
            var container = document.querySelector(".container");
            container.classList.add("show");
        };
    </script>
</head>
<body>
    <header>
        <a href="home.html">Certificate Verification </a>
        <ul id="menu">
        </ul>  
    </header>
    <br><br><br><br><br><br>
    <div class="container" >
    
        <form action="registration.php" method="post">
            <div class="form-group ">
                <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email your email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary " value="UserRegister" name="submit">
                
            </div>
            <a href="Userlogin.php" class="btn btn-primary" style="position: absolute; top:263px; right: 120px;" role="button">UserLogin</a>
        </form>
        <div>
        
      </div>
        <br>
    </div>
</body>
</html>