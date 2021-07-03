<?php
$conn = mysqli_connect('localhost','guest','imguest','troll');
if(!isset($_POST['username'],$_POST['password'],$_POST['name'],$_POST['email']) || empty($_POST['username'])||empty($_POST['password'])||empty($_POST['name'])||empty($_POST['email'])){
exit('<script>alert("올바른 입력을 해 주세요!");window.location=document.referrer;</script>');
}
if($stmt = $conn->prepare('SELECT id, password FROM user where username=?')){
    $stmt->bind_param('s',$_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows>0){
    echo '<script>alert("이미 같은 ID가 존재합니다.");window.location=document.referrer;</script>';
}else{
    if($stmt2 = $conn->prepare('INSERT INTO user (username, password, name, email, comment, register_date) values( ? , ? , ? , ? , ? , now() )')){
         $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
         $stmt2->bind_param('sssss',$_POST['username'],$password,$_POST['name'],$_POST['email'],$_POST['comment']);
         $stmt2->execute();
	 echo "<script>alert('회원가입 완료.');location.replace('login.php');</script>";
    }
else{
exit("<script>alert('something wrong!');window.location=document.referrer;</script>");
}
}
$stmt->close();
}
$conn->close();
?>
