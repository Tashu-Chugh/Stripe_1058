<?php 

include('connection.php');
session_start();

if(isset($_POST['hash']))
{
	$check=$db->prepare('select * from plans where plan_name = ?');
    $data=array($_SESSION['package']);
    $check->execute($data);
    $finalarray=array();
	if($check->rowcount()>0)
    {
	    while($datarow = $check->fetch())
	    {
	    	 		$arr=array();
                    $arr['package']=$datarow['plan_name'];
                    if($_SESSION['plan'] == "monthly")
                    {
                    	$arr['cost']=(int)$datarow['monthly_price'];
                    }
                    else
                   	{
                   		$arr['cost']=(int)$datarow['yearly_price'];
                   	}
                    
                    $arr['duration']=$_SESSION['plan'];
                    $_SESSION['cost']=$arr['cost'];

	    }
	    echo json_encode($arr);
	}





}
?>