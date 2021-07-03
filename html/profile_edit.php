<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<title>Juntae Web Site - profile</title>
<script>
function check(e){
var a = document.getElementById('password').value;
var b = document.getElementById('password_validate').value;
if(a != b){
    document.getElementById('warning').innerHTML='비밀번호를 다시 확인해 주세요.';
    return false;
}
return true;
}
</script>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['loggedin'])){
header('Location:index.php');
exit;
}

?>
<h1>프로필 수정</h1>
<a href='profile.php'>돌아가기</a>
<form method="POST" onsubmit="return check(this)" autocomplete="off" action="profile_edit_submit.php">
<?php
$conn = mysqli_connect('localhost','guest','imguest','troll');
$stmt = $conn ->prepare('SELECT * from user where id= ?');
$stmt->bind_param('i',$_SESSION['id']);
$stmt->execute();
$row = array();
$stmt->bind_result($row['id'],$row['username'],$row['password'],$row['name'],$row['email'],$row['comment'],$row['register_date'],$row['class']);
$stmt->fetch();
$stmt->close();
?>
<input type="password" id="old_password" name="old_password" placeholder="현재 비밀번호" required/>
<input type="password" id="password" name="password" placeholder="새로운 비밀번호" required />
<input type="password" id="password_validate" placeholder="새로운 비밀번호 확인" required />
<input type="text" name="comment" placeholder="설명" value="<?php echo $row['comment']?>"/>
<input id="ok" type="submit" value="수정" />
<p id="warning" style="color:red;"></p>

</form>
</body>
</html>
