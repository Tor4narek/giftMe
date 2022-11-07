<?php session_start();
 if(isset($_SESSION['admin_token'])){
     header('location:admin.php');
    }
if(isset($_SESSION['user_token'])){
        header('location:index.php');
       }
     ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BDay</title>
    <link href="css/login.css" rel="stylesheet">
    <!--Import Animate.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!--Import Bootstrap5 CSS, JS and JQuery-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!--Import fonts, including Font Awesome and Kumbh Sans-->
    <script src="https://kit.fontawesome.com/8668b1b101.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <script src="js/confetti.js"></script>


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>

</head>
<link href="css/login.css" rel="stylesheet">
</head>
<body class="text-center">
<canvas class="animate__animated animate__fadeIn" height='1' id='confetti' width='1'></canvas>
    <main class="form-signin w-100 m-auto animate__animated animate__fadeInUp">
    
     <form method="POST">
      <?php  $email_mess="";
        if(isset($_POST['name']) && isset($_POST['email']) & isset($_POST['password'])){
            $name = md5(htmlspecialchars($_POST['name']));
            $email = md5(htmlspecialchars($_POST['email']));
            $password = md5(htmlspecialchars($_POST['password']));
            $user_token = bin2hex(random_bytes(10));
            include("db.php");
            $db = new Database;
            $email_db = $db->query("SELECT `email` FROM `admins` WHERE `email`='$email' LIMIT 1");
          
            if(empty($email_db)){
                 $db->execute("INSERT INTO `admins` SET `name`='$name', `email`='$email', `user_token`='$user_token', `password`='$password'"); 
                 $email_mess="";
                 $_SESSION['admin_token'] = $user_token;
                header("location:bday.php");
         }
            else{
                
                $email_mess='Этот e-mail уже занят..'; 
            }
        }
       
    ?>
   
        <img class="mb-4 animate__animated animate__fadeInUp" src="img/logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal intro animate__animated animate__fadeInUp"><b>Добро пожаловать!</b><br>

       

       <a href="admin.php"><button class="w-100 btn btn-lg btn-primary animate__animated animate__fadeInUp" type="button">Именинник</button></a> 
        
       <a href="login.php"><button class="w-100 btn btn-lg btn-primary animate__animated animate__fadeInUp" type="button">Гость</button></a> 
        <div><?=$email_mess;?></div>
     
        <p class="mt-5 mb-3 text-muted animate__animated animate__fadeInUp">©Ян и Егор 2022</p>
    </form>

</main>
</body>
</html>