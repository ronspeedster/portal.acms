<?php

if(!isset($_SESSION)) 
    { 
        session_start();
    }
    
	$production = true; 

	if($production)
	{
	 	$host 	  = 'localhost';
		$username = 'acmsorgp_admin';
		$password = 'UUd=!l,1ZZK{';
		$database = 'acmsorgp_acms';

		$siteUrl  = 'http://member.acms.org.ph/';
	}
	else 
	{
		$host     = 'localhost';
		$username = 'root';
		$password = 'root';
		$database = 'acmsorgp_acms';

		$siteUrl  = 'http://localhost/portal.acms/';
	}

	$mysqli = new mysqli($host,$username,$password,$database) or die(mysqli_error($mysqli));

?>