<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
if(isset($_SESSION['class']) && $_SESSION['class'] >=2){
if(isset($_GET['id'])){
$conn = mysqli_connect("localhost","administrator","I_am_admin","troll");
$query = "delete from chat where id=".mysqli_real_escape_string($conn,$_GET['id']);
mysqli_query($conn, $query);
$conn->close();
echo "<script>location.href=document.referrer;</script>";
}

}
}
?>
