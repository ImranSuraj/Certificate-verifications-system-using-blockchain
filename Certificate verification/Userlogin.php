<?php require('connection.php'); 
?>
<?php
if(isset($_POST['login']))
{
   
     # get email from Data base
    $query="SELECT * FROM `user` where  `email`='$_POST[email]'";
    $result=mysqli_query($con,$query);
    if($result)
    {  
      if(mysqli_num_rows($result)==1) 
      {
        $result_fetch=mysqli_fetch_assoc($result);
        if (password_verify($_POST['password'],$result_fetch['password']))
        {
           header('location:otp.html');
        }
        else 
        { 
          echo "<script>alert('Incorrect password');
          window.location.href='Userlogin.php';
          </script>";
        }            
                      
      }
      else
      {
                            
        echo "<script>alert('Email not Registered');
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
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">

    <style>
        .container1 {
            opacity: 0;
            transform: scale(0.5);
            transition: opacity 0.5s, transform 0.5s;
        }

        .container1.show {
            opacity: 1;
            transform: scale(1);
        }
    </style>
    <script>
        window.onload = function() {
            var container = document.querySelector(".container1");
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
    <div class="container1">
      <form action="Userlogin.php" method="post">
        <div class="form-group" >
            <input type="email" placeholder="Enter your email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="password" placeholder="Enter Password" name="password" class="form-control" required>
        </div>
        <div class="form-btn">
        <input style="font-family:sans-serif ; font-size:17px " type="submit" value="UserLogin" name="login" class="btn btn-primary">
        </div>
      </form>
    </div>
</body>
</html>