<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<title>Juntae Web Site</title>
<style>
input{
display:block;
}
</style>
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
<h1>회원가입</h1>
<form id="loginForm" onsubmit="return check(this)"  method="POST" autocomplete="off" action="register_submit.php">
<input type="text" name="username" placeholder="ID" required/>
<input type="password" id="password" name="password" placeholder="비밀번호" required/>
<input type="password" id="password_validate" placeholder="비밀번호 확인" required />
<input type="text" name="name" placeholder="닉네임" required />
<input type="email" name="email" placeholder="이메일 주소" required />
<input type="text" name="comment" placeholder="설명" />
<input id="ok" type="submit" value="가입" />
<p id="warning" style="color:red;"></p>
</form>
</body>
</html>
