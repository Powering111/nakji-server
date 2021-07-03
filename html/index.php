<DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<title>Juntae Web Site</title>
<link rel='stylesheet' type='text/css' href="style.css" />
<script type="text/javascript">
document.addEventListener("DOMContentLoaded",function(){
var savedname = getSavedValue("chatname");
if(savedname)
document.getElementById("chatname").value = savedname;});
function saveValue(e){localStorage.setItem(e.id, e.value);}
function getSavedValue(v){if(!localStorage.getItem(v)){return "";}return localStorage.getItem(v);}
</script>
</head>
<body>
<h1 id="title"></h1>
<div id="menudiv">
<span id="title">Nakji Server</span>
<a href="info.php">공지사항</a>
<?php
session_start();
if(!isset($_SESSION['loggedin'])){
echo "<a href='login.php'>로그인</a><a href='register.php'>회원가입</a>";
}else{
echo "<a href='profile.php'>".$_SESSION['name']."</a>";
echo "<a href='logout.php'>로그아웃</a>";
}
if(isset($_SESSION['class'])&&$_SESSION['class']==3){
echo "<a href='cloud.php'>CLOUD</a>";
}
?>
</div>
<div id="chatdiv">
<form id="chatform"  method="POST" action="go.php">

<h2 style="margin:0px">채팅하기</h2>

<div id="inputfield">
<?php
if(empty($_SESSION['loggedin'])){
echo '<div id="namediv"><input type="text" name="name" placeholder="이름" id="chatname" onchange = "saveValue(this);"/><br /></div>';
}

?>
<div id="commentdiv"><textarea name="comment" placeholder="내용" cols="50" rows="4" id="chatval"></textarea></div>
</div>
<input id="send" type="submit" value="전송"/>
</form>

<?php
$link = mysqli_connect("localhost","guest","imguest","troll");
$countquery="SELECT COUNT(*) FROM chat;";
$count = mysqli_query($link,$countquery);
$num = mysqli_fetch_array($count)['COUNT(*)'];
//sets
$set=50;
if(!empty($_GET['set'])){$set=$_GET['set'];}
$pagenumber = ($num+($set-1)) / $set;
$nowpage=1;
$start=0;
if(!empty($_GET['page'])){$start = ($_GET['page']-1)*$set;$nowpage=$_GET['page'];}

//pagediv
echo "<div class='pagediv'>";
for($i=1;$i<=$pagenumber;$i=$i+1){
    echo "<a class='pagebtn' href='./index.php?page=".$i."' ";
    if($i==$nowpage){
          echo "style='background-color:#44FFFF'";
}
echo ">".$i."</a> ";
}
echo "</div>";

//start

//run query
$query="SELECT * FROM chat ORDER BY id DESC LIMIT ".$start.",".$set.";";
$result = mysqli_query($link, $query);
while($row = mysqli_fetch_array($result)){
    echo "<div class='chat'>";
    if($row['login']==1){
        echo '<a href="./profile.php?id='.$row['user_id'].'">';}
    echo "<span class='name ";
    if($row['login']==0) echo 'guest';
    else echo 'user';
    echo "'>".htmlspecialchars($row['name'])."</span>";
    if($row['login']==1){
        echo "</a>";
    }
    echo "<span class='date'>".htmlspecialchars($row['register_date'])."</span>";
    if(isset($_SESSION['class']) && $_SESSION['class'] >=2){
        echo "<a href='delete.php?id=".$row['id']."'>삭제</a>";
    };
    echo "<br /><span class='comment'>".htmlspecialchars($row['comment'])."</span></div>\n";
}

//page
echo "<div class='pagediv'>";
for($i=1;$i<=$pagenumber;$i=$i+1){
    echo "<a class='pagebtn' href='./index.php?page=".$i."' ";
    if($i==$nowpage){
          echo "style='background-color:#44FFFF'";
}
echo ">".$i."</a> ";
}
echo "</div>";

?>
</div>
</body>
</head>
</html>
