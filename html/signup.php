<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
    <link rel="stylesheet" href="../css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <section>
        <div class="login-container">
            <div class="login-box">
                <h2>Create Account</h2>
                <form>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <label for="cpassword">Confirm Password:</label>
                    <input type="password" id="cpassword" name="cpassword" required>
                    <label class="remember-label">
                        <input type="checkbox" name="remember" class="input"> Remember me
                    </label>
                    <button type="submit" class="signup-button" onclick=save()>
                        Sign Up
                    </button>
                </form>
                <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        <script type="text/javascript">
            function save()
            {
                var name=document.getElementById('name').value;
                var email=document.getElementById('email').value;
                var pass=document.getElementById('password').value;		
                var cpass=document.getElementById('cpassword').value;	
                if(name!="" && email!="" && pass!="" && cpass!="")
                {
                    var a = ValidateEmail(email);
                    var b = passmatch(pass,cpass);
                        
                    if( a== true && b== true){
                        $.ajax({
                            type: "POST",                            
                            url: "../ajax/signup.php",
                            data: {name:name,pass:pass,email:email,signup:'signup',cpass:cpass},
                            success: function(data){
                                if(data == 3){
                                    alert('You are already registered. kindly Login.');
                                }
                                else if(data == 0){
                                    alert('registered sucessfully !. ');

                                    window.location.href="login.php";
                                }
                                else if(data==7)
                                {
                                    alert("something went wrong");}
                                else{
                                    alert(data);}
                                            
                                                
                            }                  
                        });
                    }
                }
                else
                {
                    alert("INPUT ALL THE DATA");
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
            function passmatch(a,b){
                if(a == b){ return (true);}
                else{ alert("You have entered an invalid Password!"); 
                    return(false); }            
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