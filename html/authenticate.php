<?php
session_start();
if(empty($_POST['username'])||empty($_POST['password'])){
    echo "<script>alert('입력을 해 주세요!');window.location=document.referrer;</script>";
}
$conn = mysqli_connect('localhost','guest','imguest','troll');

if($stmt = $conn -> prepare("SELECT id, password, name, class from user where username = ?")){
$stmt->bind_param('s',$_POST['username']);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows>0){
    $stmt->bind_result($id,$password,$name,$clas);
    $stmt->fetch();
    if(password_verify($_POST['password'],$password)){
        session_regenerate_id();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$_POST['username'];
        $_SESSION['name']=$name;
        $_SESSION['id']=$id;
        $_SESSION['class']=$clas;
        echo 'Login ok, '.$_SESSION['username'];
        echo '<script>window.location.replace("index.php");</script>';
    }else{
        echo "<script>alert('로그인 실패');window.history.back();</script>";
    }
}
else{
    echo "<script>alert('로그인 실패');window.history.back();</script>";
}
$stmt->close();
}else{
echo $conn->error;
}
?>
