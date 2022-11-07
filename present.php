<?php session_start();
    if(isset($_GET['present_token'])):
    $present_token = $_GET['present_token'];
    include("db.php");
    $db = new Database; 
    $presents = $db->query("SELECT * FROM `presents` WHERE `present_token`='$present_token'");
    foreach($presents as $present):
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
<!--Import Bootstrap5 CSS, Bootstrap JS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<!--Import fonts, including Font Awesome and Kumbh Sans-->
    <script src="https://kit.fontawesome.com/8668b1b101.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title></title>

</head>
<body>
<div class="container mt-5">
   <nav aria-label="breadcrumb " >
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admin.php">Дашборд</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=$present['title']?></li>
  </ol>
</nav> 
</div>

<div class="container d-flex justify-content-center mt-5">

  <div class="card " style="width: 18rem;">
  <img class="card-img-top" src="<?=$present['url'];?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?=$present['title'];?></h5>
    <p class="card-text"><?=$present['descr'];?></p>
    <a href="<?=$present['link'];?>" class="btn btn-primary"><?=$present['link_title'];?></a>
  </div>
</div>

</div>
</body>
</html><?php endforeach; endif;?>