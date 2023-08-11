<?php
	include('connection.php');
	if(isset($_POST["signup"]))
	{
		
		$name=test_input($_POST['name']);
		$email=test_input($_POST['email']);
		$pass=test_input($_POST['pass']);
		$cpass=test_input($_POST['cpass']);
		$flag=0;
		if(validiate_input($name,0) && validiate_input($email,1) && validiate_input($pass,2))
		{
			$check=$db->prepare('SELECT * from signup_info WHERE  email = ?');
			$data=array($email);
			$check->execute($data);
			if($check->rowCount() == 1)
			{
				$flag=1;
				echo 3;
			}
			if($flag==0)
			{
				$password1_hash=password_hash($pass,PASSWORD_DEFAULT);
				$query=$db->prepare("INSERT INTO signup_info(Name,Email,Password) VALUES (?, ?, ?)");
				$data=array($name,$email,$password1_hash);
				$execute=$query->execute($data);
				if($execute)
				{
					$_SESSION['username'] = $name;
					echo 0;
				}
				else
				{
					echo 7;
				}
			}
		}
	}




	function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function validiate_input($data, $type){

    if($type==0){
        //echo "0";
        if(preg_match('/[^a-zA-Z0-9 ._-]+/i', $data)) {
            //echo "injection";
            return false;
        }else{
            //echo "match";
            return true;
        }
    }
    if($type==1){
        //echo "1";
        if (preg_match("/^[a-zA-Z0-9 ._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $data)) {
            //echo "match";
            return true;
        }else{
            //echo "injection";
            return false;
        }

    }
    if($type==2){
        //echo "2";
        if (preg_match('/[^a-zA-Z0-9@&_-]+/i', $data)) {
            //echo "injection";
            return false;
        }else{
            //echo "match";
            return true;
        }

    }
    if($type==3){
        //echo "2";
        if (preg_match('/[^a-zA-Z0-9 _,]+/i', $data)) {
            //echo "injection";
            return false;
        }else{
            //echo "match";
            return true;
        }

    }

}
?>