<?php
session_start();
if(empty($_SESSION['admin_token'])){
  header('location:choise.php');
}
include('db.php');
$db = new Database;
$admin_token = $_SESSION['admin_token'];
$admins = $db->query("SELECT * FROM `admins` WHERE `user_token`='$admin_token'");
function age($bday_day)
{
    // выделяем день, месяц, год из даты рождения
    $bDay = substr($bday_day, 8, 2);
    $bMonth = substr($bday_day, 5, 2);
    $bYear = substr($bday_day, 0, 4);
    // текущие день, месяц, год
    $cDay = date('j');
    $cMonth = date('n');
    $cYear = date('Y');
    
    if(($cMonth > $bMonth) || ($cMonth == $bMonth && $cDay >= $bDay)) {
        return ((int)$cYear - (int)$bYear);
    } else {
        return ((int)$cYear - (int)$bYear);
    }
}
foreach($admins as $admin):
$_SESSION['name']=$admin['name'];
$party_id = $admin['party_id'];
$party_link = "http://tor4narek.ru/giftMe/giftlink.php?partyID=".$party_id;
$_SESSION['link']=$party_link;
if(isset($_GET['delete'])){
  $del_token = $_GET['delete'];
  $db->execute("DELETE FROM `presents` WHERE `present_token`='$del_token'"); 
  header("location:admin.php"); 
             }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
        <!-- Open Graph Generated: a.pr-cy.ru -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="приглашает на свой день рождения!">
    <meta property="og:description" content="Заходи в Giftme и выбирай тот подарок, который хочет именинник! ">
    <meta property="og:url" content="http://tor4narek.ru/giftMe/index.php">
    <meta property="og:image" content="http://tor4narek.ru/giftMe/logoGiftme.png">
    <meta property="og:site_name" content="Giftme-сервис желаний ">
    <meta property="og:locale" content="ru_RU">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Панель именинника</title>
    <script src="https://kit.fontawesome.com/8668b1b101.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  </head>
  <body>
      <style>
          .hidden_block{
              overflow:hidden;
              width:180px;
          }
      </style>
    <div class="container-scroller">
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="assets/images/faces/face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="?exit">
                  <?php 
                  if(isset($_GET['exit'])){
                    session_destroy();
                    header("location:choise.php");
                    exit;
                  }
                  ?>
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="?exit">
                <i class="mdi mdi-power"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="assets/images/faces/face1.jpg" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?=base64_decode($admin['name']);?></span>
                  <span class="text-secondary text-small"><?=base64_decode($admin['email']);?></span>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin.php">
                <span class="menu-title">Дашборд</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="menu-title">Настройки</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom">
                  <h6 class="font-weight-normal mb-2">Подарки</h6>
                </div>
              <a href="add.php"><button class="btn btn-block btn-gradient-primary mt-4">+ Добавить новый</button></a>  
              </span>
            </li>
         
          <li class="nav-item sidebar-actions">
          <span class="nav-link">
            
            <?php
            
            $presents = $db->query("SELECT * FROM `presents`  WHERE `party_id`='$party_id'");
            foreach($presents as $present):
          
            ?>  
            <div class="flex mb-4">
              <a href="present.php?present_token=<?=$present['present_token'];?>"> <button class="btn btn-block btn-success hidden_block " ><?=$present['title'];?></button></a>
              <a href="?delete=<?=$present['present_token'];?>"> <button class="btn btn-block btn-sm"><img src="img/Vector.svg" alt="" srcset="" width="18px"></button></a>
            </div>
         <?php  endforeach; ?>
            </span>
            </li> 
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Ваш дашборд
              </h3>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Вам исполнится <?=age($admin['date']);?> через
                    </h4>
                    <?php
                      $birthday = $admin['date'];

                      $cd = new \DateTime('today'); // Сегодня, время 00:00:00
                      $bd = new \DateTime($birthday); // Объект Дата дня рождения
                      $bd->setDate($cd->format('Y'), $bd->format('m'), $bd->format('d')); // Устанавливаем текущий год, оставляем месяц и день
                      $tmp = $cd->diff($bd); // Разница дат
                      if($tmp->invert){ // Если в этом году уже был (разница "отрицательная")
                          $bd->modify('+1 year'); // Добавляем год
                          $tmp = $cd->diff($bd); // Снова вычисляем разницу
                      }
                      
                       // Результат в днях ?>
                    <h2 class="mb-5"><?php echo $tmp->days; ?> дня</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Ваш PartyID:
                    </h4>
                    <h2 class="mb-3"><?=$admin['party_id']?></h2>
                    <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Ссылка" value="<?=$_SESSION['link']?>" aria-label="Ссылка" id="myInput" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="copyPartyId()"  type="button">Скопировать</button>
                </div>
                </div>
                   
                    <script type="text/javascript">
                        function copyPartyId(){
                            var copytext = document.getElementById("myInput");
                            copytext.select();
                            document.execCommand("copy");
                        }
                    </script>
                    <h5 class="font-weight-normal mb-3"> Отправьте ссылку или PartyID друзьям и они смогут выбрать подарок!</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<?php endforeach; ?>