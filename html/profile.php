<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<title>Juntae Web Site - profile</title>
</head>
<body>
<h1>프로필</h1>
<a href='index.php'>메인 화면</a><br>

<?php
if(empty($_GET['id'])){
session_start();
if(!isset($_SESSION['loggedin'])){
	header('Location: index.html');
    	exit;
}
$conn = mysqli_connect('localhost','guest','imguest','troll');
$stmt = $conn ->prepare('SELECT * from user where id= ?');
$stmt->bind_param('i',$_SESSION['id']);
$stmt->execute();
$row = array();
$stmt->bind_result($row['id'],$row['username'],$row['password'],$row['name'],$row['email'],$row['comment'],$row['register_date'],$row['class']);
$stmt->fetch();
$stmt->close();
echo "<a href='profile_edit.php'>프로필 수정</a><br />";
echo "ID : ".$row['username']."<br>";
echo "이름 : ".$row['name']."<br>";
echo "E-mail : ".$row['email']."<br>";
echo "상태 : ".$row['comment']."<br>";
echo "가입 시각 : ".$row['register_date']."<br>";
if($row['class']==0){

}else if($row['class']==1){
echo "권한 : 높음";
}else if($row['class']==2){
echo "권한 : 지킴이";
}else if($row['class']==3){
echo "권한 :운영자";
}
}else{
    
	$conn = mysqli_connect('localhost','guest','imguest','troll');
$stmt = $conn ->prepare('SELECT * from user where id= ?');
$stmt->bind_param('i',$_GET['id']);
$stmt->execute();
$row = array();
$stmt->bind_result($row['id'],$row['username'],$row['password'],$row['name'],$row['email'],$row['comment'],$row['register_date'],$row['class']);
$stmt->fetch();
$stmt->close();
echo "이름 : ".$row['name']."<br>";
echo "상태 : ".$row['comment']."<br>";
echo "가입 시각 : ".$row['register_date']."<br>";
if($row['class']==0){

}else if($row['class']==1){
echo "권한 : 높음";
}else if($row['class']==2){
echo "권한 : 지킴이";
}else if($row['class']==3){
echo "권한 :운영자";
}
}
?>
</body>
</html>
