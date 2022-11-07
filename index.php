<?php 
// error_reporting(0);
session_start();
if(empty($_SESSION['user_token'])){
    header('location:choise.php');
}
include('db.php');
$db=new Database;
$user_token = $_SESSION['user_token'];
if(isset($_GET['exit'])){
    session_destroy();
    header('location:choise.php');
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GiftMe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/style.css">
<!--Import Bootstrap5 CSS, Bootstrap JS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<!--Import fonts, including Font Awesome and Kumbh Sans-->
    <script src="https://kit.fontawesome.com/8668b1b101.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">Мой подарок для всех</h4>
                    <p class="text-muted"> Недавно мой друг <a href="https://www.jackyfox.com/" target="_blank">Женя Павлов</a> озадачил меня вопросом: есть ли у меня вишлист для подарков ко дню рождения. Я никогда не собирал вишлисты, но в рамках изучения разработки захотелось собрать сервис, на котором друзья смогут анонимно выбрать подарок, исходя из своего бюджета, а так же видеть, какие подарки уже заняты другими.<br><br>Сделано с использованием фреймворка Bootstrap, бэкенд на PHP делает мой кент <a href="https://t.me/tor4narek" target="_blank">Егор</a> таким образом, чтобы я не знал данные участников - чтобы подарки оставались сюрпризом :)<br><br>На выходных я опубликую здесь документацию о том, как пересобрать сервис под свой праздник и запустить на своём хостинге, чтобы каждый мог его использовать. А позже мы планируем реализовать с Егором user-friendly интерфейс для администратора, чтобы не приходилось копаться в коде. Если у вас есть идеи и предложения по поводу сервиса, пожалуйста, свяжитесь со мной в <a href="https://t.me/schaferschaferschafer" target="_blank">Telegram</a><br>❤️❤️️❤️️</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Контакты</h4>
                    <ul class="list-unstyled">
                        <li><a href="https://t.me/schaferschaferschafer" target="_blank">Если нужен дизайн</a></li>
                        <li><a href="https://t.me/tor4narek" target="_blank">Если нужен бэк</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <img class="logo" src="img/logo.svg" alt="" width="26" height="26">
                <strong class="appname">GiftMe</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
         
            <a class="btn btn-outline-primary" href="?exit" role="button">Выйти</a>
        </div>
    </div>
</header>

<main>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">О подарках</h1>
                <p class="lead text-muted">Выбранный подарок будет доступен только тебе, а остальные будут видеть, что он кем-то выбран (но не будут видеть кем)</p>
                <p>
                    <!-- <label for="customRange3" class="form-label">Задать бюджет</label> -->
                    <!-- <input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3"> -->
                </p>
                <div class="container">
                <form method="POST">
              <div class="form-group">
                <label for="exampleInputEmail1">PartyID</label>
                <input type="text" class="form-control" value="<?=$_COOKIE['partyID']?>" name="party_id" id="party_id" aria-describedby="emailHelp" placeholder="PartyID">
                <small id="emailHelp" class="form-text">Введите PartyID именинника</small>
              </div>
              <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
                </div>
                <?php
              
            
           
                
                if(isset($_POST['party_id'])){
                     $party_id_new = $_POST['party_id'];
                $db->execute("UPDATE `users` SET `party_id`='$party_id_new' WHERE `user_token`='$user_token' ");
                header("Refresh:0");
                }    
               
                ?>
              
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                $users = $db->query("SELECT * FROM `users` WHERE `user_token`= '$user_token'");
           
                foreach($users as $user):
                
                $_SESSION['email'] = base64_decode($user['email']);
                $party_id = $user['party_id'];
                $SESSION['party_id']=$party_id;
                if(empty($user['present_token'])){
                    
                $presents = $db -> query("SELECT * FROM `presents` WHERE `party_id`='$party_id'");
                foreach($presents as $present):
                   
                $present_token = $present['present_token'];
                if(isset($_GET['present_id'])){
                    $present_id = $_GET['present_id'];
                    $db->execute("UPDATE `users` SET `present_token`='$present_id' WHERE `user_token`='$user_token'");
                    $db->execute("UPDATE `presents` SET `status`='1' WHERE `present_token`='$present_id'");
                    echo "<meta http-equiv='refresh' content='0'>";
                  
                }
                
                ?>
               
                <form action="" method="post">
                <div class="col">
                    <div class="card" style="width: 100%;">
                        <img src="<?=$present['url']?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?=$present['title']?></h5>
                            <p class="card-text"><?=$present['descr']?></p>
                            <div class="btn-group">
                            <?php
                            if($present['status']==0): ?>
                             <a href="index.php?present_id=<?=$present_token?>"><button onClick='document.location.reload();' type="button" class="btn btn-sm btn-outline-secondary button-take">Выбираю этот подарок!</button></a>    
                            
                            <?php endif;
                            if($present['status']==1):
                            ?>
                            <button type="button" class="btn btn-sm btn-outline-secondary button-take">Данный подарок уже занят)</button>
                            <?php   endif; ?>
                            
                             <a href="<?=$present['link']?>"><button  type="button" class="btn btn-sm btn-outline-secondary"><?=$present['link_title']?></button></a>   
                            </div>
                            
                        </div>
                    </div>
                </div>
                </form>
                
                <?php 
            endforeach; }
            else{ 
            $gifts = $db->query("SELECT presents.title, presents.link_title, presents.descr, presents.link, presents.url, presents.present_token FROM presents JOIN users ON presents.present_token = users.present_token WHERE users.user_token = '$user_token' ");
            mail($_SESSION['email'], 'Напоминание о подарке)',$gift['title'].$gift['link'], "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: 8bit");    

            foreach($gifts as $gift):
                ?>
            <div class="container flex">
        <h2 class="fw-light">Отлично подарок выбран!</h2>
             <form action="" method="post">
                <div class="col">
                    <div class="card" style="width: 286px">
                        <img src="<?=$gift['url']?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?=$gift['title']?></h5>
                            <p class="card-text"><?=$gift['descr']?></p>
                            <div class="btn-group">
                          <a href="<?=$gift['link']?>"><button href="" type="button" class="btn btn-sm btn-outline-secondary"><?=$gift['link_title']?></button></a>  
                            </div>

                        </div>
                    </div>
                </div>
                </form>
            </div>    
              

           <?php endforeach; }
            endforeach; ?>
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
</html>