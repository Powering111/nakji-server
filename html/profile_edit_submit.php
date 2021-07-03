<?php
session_start();
if(!isset($_SESSION['loggedin'])){
header('Location:index.php');
exit;
}

$conn = mysqli_connect('localhost','guest','imguest','troll');
if(!isset($_POST['old_password'], $_POST['password']) || empty($_POST['old_password'])||empty($_POST['password'])){
exit('<script>alert("올바른 입력을 해 주세요!");window.location=document.referrer;</script>');
}
if($stmt = $conn->prepare('SELECT password FROM user where username=?')){
    $stmt->bind_param('s',$_SESSION['username']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($password);
    $stmt->fetch();
    if(!password_verify($_POST['old_password'],$password)){
	exit("<script>alert('이전 비밀번호가 다름');location.replace('profile_edit.php');</script>");
    }else{
        if($stmt2 = $conn->prepare('UPDATE user SET password=?,comment=? where username=?')){
             $newpassword=password_hash($_POST['password'], PASSWORD_DEFAULT);
             $stmt2->bind_param('sss',$newpassword,$_POST['comment'],$_SESSION['username']);
             $stmt2->execute();
             echo "<script>alert('수정 완료.');location.replace('profile.php');</script>";
        }
        else{
exit($conn->error);
		exit("<script>alert('something wrong!');window.location=document.referrer;</script>");
	}
    }
    $stmt->close();
}
$conn->close();
?>
