<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<title>Juntae Web Site</title>
<style>
.file a{
color:#000000;
}
.directory a{
color:#8F7731;
}
a:link, a:visited{
text-decoration:none;
}
a:hover{
text-decoration:none;
background-color:cyan;
transition: background-color 0.5s;
}

a:link.remove, a:visited.remove{
color:#FF0000;
}
a:hover.remove{
background-color:#FF0000;
}
ul{
list-style:none;
}
#uploadform{
border:1px solid black;
padding:5px;
}
#mkdirform{
text-align:right;
border:1px solid black;
}
</style>
</head>
<body>
<h1><a href='index.php'>Juntae Web Site</a></h1>
<br />
<a href="cloud.php">리로드</a>
<a href="logout.php">로그아웃</a>
<br />
FTP 서버<br />
관리자 전용
<?php
session_start();
if(isset($_SESSION['class'])&&$_SESSION['class'] == 3){
$ftp=ftp_connect("localhost",8021,90);
if($ftp){
if(ftp_login($ftp,"root","Helloworld#8")){
	ftp_chdir($ftp,"ubuntu-fs/root/ftp");
	if(isset($_GET['path']) && $_GET['path']!='')ftp_chdir($ftp,$_GET['path']);
        if(isset($_POST['type'])){
		if($_POST['type']==='upload')
			ftp_put($ftp,$_FILES['upload']['name'],$_FILES['upload']['tmp_name'],FTP_BINARY);
		if($_POST['type']==='mkdir')
			ftp_mkdir($ftp,$_POST['dir_name']);
        }
}

echo "<form method='POST' enctype='multipart/form-data' id='uploadform'>";
echo "<input type='file' id='upload' name='upload'>";
echo "<input type='submit' value='업로드'><br />";
echo "<input type='hidden'id='type' name='type' value='upload'>";
echo "</form>";
echo "<form method='POST' id='mkdirform'>";
echo "<input type='hidden' name='type' value='mkdir'>";
echo "<input name='dir_name'>";
echo "<input type='submit' value='폴더 생성'>";
echo "</form>";

$nowPos = ftp_pwd($ftp);
echo "<br />";
echo "<ul>";
$list2 = ftp_rawlist($ftp,"");
$list = ftp_nlist($ftp,"");
$Apath='';
if(isset($_GET['path'])&&$_GET['path']!=''){
$Apath = $_GET['path'].'/';
}

$nowFolderWhere = strrpos(ftp_pwd($ftp), '/');
$nowPos = substr($nowPos, 52, $nowFolderWhere+1);
$upDir = substr($nowPos, 0,strrpos($nowPos,'/'));
echo "<br />";
echo "현재 폴더 경로 : /";
echo $nowPos;
echo "<li class='directory'><a href='cloud.php?path=".$upDir."'>..</a></li>";
$countlist=count($list);
for($i=0;$i<$countlist;$i=$i+1){
	if($list2[$i+1][0]=='d'){
		echo "<li class='directory'>";
		if($nowPos!='')$nowPos=$nowPos.'/';
		echo "<a href='cloud.php?path=".($nowPos.$list[$i])."'>";
	}else{
		echo "<li class='file'>";
		echo "<a href='cloud_download.php?path=".($Apath.$list[$i])."'>";

	}
	echo $list[$i];
	echo "</a>";
	if($list2[$i+1][0]!='d')echo " <a class='remove' href='cloud_remove.php?path=".($Apath.$list[$i])."'>삭제</a>";
	echo "</li>";
}
}
echo "</ul>";
ftp_close($ftp);
}
?>

</ul>

</body>
</html>

