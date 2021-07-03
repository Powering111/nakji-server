<?php
session_start();
if(isset($_SESSION['class'])&&$_SESSION['class'] == 3){
if(isset($_GET['path'])){
if(strrpos($_GET['path'],'/')) $filename=substr($_GET['path'],strrpos($_GET['path'],'/')+1,strlen($_GET['path'])-1);
else{
$filename=$_GET['path'];
}
echo strrpos($_GET['path'],'/');
$AbsolutePath = '/../../../root/ftp/'.$_GET['path'];

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma-public');
header('Content-Length: '.filesize($AbsolutePath));
readfile($AbsolutePath);
die();
}

}
?>
