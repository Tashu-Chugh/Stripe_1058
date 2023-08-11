<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<section>
		<div class="login-container">
			<div class="login-box">
				<h2>Login to your account</h2>
				<form>
					<label for="email">Email:</label>
					<input type="email" id="email" name="email" required>
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" required>
					<label class="remember-label">
						<input type="checkbox" name="remember" class="input">Remember me
					</label>
					<button type="submit" class="login-button" onclick=login()>Login</button>
				</form>
				<p class="signup-link">Don't have an account? <a href="signup.php">Sign Up</a></p>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
		<script type="text/javascript">
			function login()
			{
				var email=document.getElementById('email').value;
				var pass=document.getElementById('password').value;
				if(email!="" && pass!="")
				{
					if (ValidateEmail(email)) {

						$.ajax(
						{
							type:'POST',
							url:"../ajax/login.php",
							data:{email:email,pass:pass,login:'login'},
							success:function(data)
							{
								if(data=='0')
								{
									window.location.href = "pricing.php";
								}
								else if(data=='1')
								{
									alert('invalid credentials');
								}
								else
								{
									alert("something went wrong!");
								}
							}
						});
					}
				}

			}
			function ValidateEmail(mail){     
				var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				if(reg.test(mail)){
					return true;
				}
				else{
						alert("You have entered an invalid email address!");   
						return false;
					}
			}
		</script>
	</section>

<script type="text/javascript">
    $('form').submit(function(e) {
    	e.preventDefault();
	});
</script>

</body>
</html>