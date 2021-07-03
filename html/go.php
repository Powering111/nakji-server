<?php
session_start();

if((empty($_SESSION['loggedin']) &&empty($_POST['name'])) || empty($_POST['comment'])){
    echo "<script>alert('입력을 해 주세요!');window.location=document.referrer;</script>";
    exit();
}
$link = mysqli_connect("localhost","guest","imguest","troll");
if(!empty($_SESSION['loggedin'])){
    $a=mysqli_real_escape_string($link, $_SESSION['name']);
    $b=mysqli_real_escape_string($link, $_POST['comment']);

    $query = "INSERT INTO chat(name, comment, register_date, user_id, login) VALUES ('".$a."', '".$b."', NOW(), ".$_SESSION['id'].", 1);";


}else {
$a=mysqli_real_escape_string($link, $_POST['name']);
$b=mysqli_real_escape_string($link, $_POST['comment']);
$query = "INSERT INTO chat(name, comment, register_date, login) VALUES ('".$a."', '".$b."', NOW(), 0);";

}
mysqli_query($link, $query);
$link->close();
echo "<script>window.location=document.referrer;</script>";
?>

