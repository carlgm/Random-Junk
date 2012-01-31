<?php
/*
   Copyright 2011 Carl Goodwin-Morgan

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
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
HTML;
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
echo <<< HTML
<html>
<head>
<title>Generatated .htpasswd user/pass logins</title>
<style type="text/css">
</style>
</head>
<body>
HTML;
 echo "Here is the .htpasswd line:<br />";
 echo $_POST[username].":".$encrypted_password."<br />"; 
echo <<< HTML
</body>
</html>
HTML;
}
?>