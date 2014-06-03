<?php
/*
Copyright (c) 2011 Carl Goodwin-Morgan

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
if (empty($_POST['username']) || empty($_POST['password'])) {
?>
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
<form method='post'>
<div id='form' align='left'>
<span class='txtbrd'> Username: <input type='text' name='username' size='30'></span><br /><br />
<span class='txtbrd'> Password: <input type='text' name='password' size='30'></span><br /><br />
<span class='txtbrd'>Encryption type:
<select name='etype'>
<option value='sha1'>SHA1 (default)</option>
<option value='crypt'>Crypt</option>
</select>
</span>
<br /><br />
<input type='submit' name='submit' value='generate' style='bold'>
</div>
</form>
</body>
</html>
<?php
} else {
 $password = trim($_POST['password']);
  switch ($_POST['etype']) {
   case 'crypt':
    $encrypted_password = crypt($password, substr($password,0,2));
   break;
   default:
    $encrypted_password = '{SHA}'.base64_encode(sha1($password, TRUE));
   break;
  }
?>
<html>
<head>
<title>Generatated .htpasswd user/pass logins</title>
<style type="text/css">
</style>
</head>
<body>
<?php
 echo "Here is the .htpasswd line:<br />";
 echo $_POST['username'].":".$encrypted_password."<br />"; 
?>
</body>
</html>
<?php
}
?>
