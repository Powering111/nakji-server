<DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<title>Juntae Web Site - Log in</title>
<link rel='stylesheet' type='text/css' href="style_login.css" />
</head>
<body>
<h1>로그인</h1>
<a href='index.php'>홈으로</a>
<form id="loginform" action="authenticate.php" method="POST">
<input type="text" name="username" placeholder="ID" required/>
<input type="password" name="password" placeholder="PW" required/>
<input type="submit" value="로그인" class= "submitbtn"/>
</form>
</body>
</html>
