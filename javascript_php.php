<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP and Javascript</title>
	<style>.table {border:1px solid #0FF; font:normal 14px Arial, Helvetica, sans-serif; color:#444444;}</style>
	<script type="text/javascript">
		function validateUsername(user){
			if(user == ""){ return "no username was entered.\n";
			}else if(user.length < 5){
				return "Username must be at least 5 character.\n";		
			}else if(/[^a-zA-Z0-9_-]/.test(user)){
				return "Only a-z, A-Z, 0-9, - "
				"and _ allowed in 		Username.\n";
			}
			return;
		}
		
		function validate(form){
			fail =  validateUsername(form.username.value);
			fail += validatePassword(form.password.value);
			fail += validateEmail(form.email.value);
			
			if(fail == "") return true;
			else {alert(fail); return false;}
		}
		
		function validatePassword(password){
			if(password == ""){
				return "No Password was entered.\n";
			}else if(password.length){
				return "Passwords must be at least 6 character.\n";
			}else if(!/[a-z]/.test(password) || ! /[A-Z]/.test(password)|| !/[0-9]/.test(password)){ 
				return "Passwords requre on each of a-z, A-Z and 0-9.\n";
			}
			return;
		}
		
		function validateEmail(email){
			if(email == ""){
				return "No Email was entered.\n";
			}else if(!((email.indexOf(".") > 0) && (password.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(email)){
				return "The Email address is invalid.\n";
			}
			return;
		}
		
		function _confirm(){
			return confirm("Bạn có chắc không ?");
		}
    </script>
</head>
	
<body>
	<?php
		$host = "localhost";
		$user = "root";
		$pass = "2520";
		$link = mysql_connect($host,$user,$pass);
		if(!$link){
			die('cannot connect to mysql'.mysql_error());	
		}else{
			mysql_select_db("nguoidung",$link);
			mysql_query("SETNAMES 'utf8'");
		}
     ?>
     <?php
	 	if(isset($_POST['sign'])){
			$user = $_POST['username'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$sql = "select *from customer";
			$result=mysql_query($sql);
			
			$row = mysql_fetch_assoc($result);
			$username = $row['username'];
			$pass = $row['password'];
			$yourEmail = $row['email'];
			
			if($username == $user && $password == $pass && $email == $yourEmail){
				echo "login success!!";
			}else{
				echo "login fail!!";
			}
		}
	 ?>
	<form name="signup" method="post" id="signup" onSubmit="return validate(this);">
    <table class="table" align="left" style="border-collapse:collapse" border="1px">
    	<tr>
    		<td>Username:</td><td><input  type="text" id="username" name="username" size="20" onchange="validateUsername()"/></td>
    	</tr>
    	<tr>
    		<td>Password:</td><td><input  type="text" id="password" name="password" size="20" onchange="validatePassword()"/></td>
    	</tr>
    	<tr>
    		<td>Email:</td><td><input  type="text" id="email" name="email" size="20" onchange="validateEmail()"/></td>
    	</tr>
        <tr align="center">
        	<td colspan="2"><input  type="submit" value="Signup" name="sign" onclick="_confirm()"/></td>
        </tr>
    </table>
    </form>
</body>
</html>