<?php
/*
 Written by Carl (cgm@sub6.com)
 This is used a web form to generate .htpasswd user/password lines with sha1(default),md5 and crypt options
*/
if (empty($_POST[username]) || empty($_POST[password])) {
echo <<< HTML
<html>
<head>
<title>Generate your .htpasswd user/pass login</title>
<style type="text/css">
.txtbrd {
border: 1px solid #000000; padding: 2px;
}
</style>
</head>
<body>
<h3>Please enter your username and password below, please note we do not log either value you enter.</h3>
<form method=post>
<div id=form align=left>
<span class=txtbrd> Username: <input type=text name=username size=30></span><br /><br />
<span class=txtbrd> Password: <input type=text name=password size=30></span><br /><br />
<span class=txtbrd>Encryption type: 
<select name=etype>
<option value=sha1>SHA1 (default)</option>
<option value=crypt>Crypt</option>
</select>
</span>
<br /><br />
<input type=submit name=submit value=generate style=bold>
</div>
</form>
</body>
</html>
HTML;
} else {
 $password = trim($_POST[password]);
  switch ($_POST[etype]) {
   case 'crypt':
    $encrypted_password = crypt($password, substr($password,0,2));
   break;
   default:
    $encrypted_password = '{SHA}'.base64_encode(sha1($password, TRUE));
   break;
  }   
 echo "Here is the .htpasswd line <br />";
 echo $_POST[username].":".$encrypted_password."<br />"; 
}
?>