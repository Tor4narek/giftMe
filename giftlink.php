<?php 
session_start();
if(!empty($_GET['partyID'])){
    $pid = $_GET['partyID'];
    setcookie("partyID",$pid);
    header("location:guest.php");
}
else{
    echo("Ссылка устарела");
}