<?php

	function debug_print($obj)
	{
		global $debug_mode_on;
		if($debug_mode_on===false) return;
		if(is_object($obj)) var_dump($obj);	else echo "$obj<br>";
	}
	
	function get_sql_connection()
	{
		$conn = new mysqli("localhost", "root", "", "freelancer");
		if($conn->connect_error)
		{
			echo "Connection failed: " . $conn->connect_error . "<br>";
			die("Connection failed: " . $conn->connect_error);			
		}
		return $conn;
	}
	
	function close_sql_connection($conn)
	{
		$conn->close();
	}
	
	function create_user_table()
	{
		global $conn;
		$sql="CREATE TABLE client(
					id bigint UNSIGNED NOT NULL AUTO_INCREMENT,
					email varchar(64) not null unique,
					pass text,
					name text,
					PRIMARY KEY (id)
					);";
		$f=$conn->query($sql);
		if($f===true) return true;
		return $conn->error;
	}
	
	function delete_user_table()
	{
		global $conn;
		$sql="drop table client";
		$f=$conn->query($sql);
		if($f===true) return true;
		return $conn->error;
	}
	
	function init()
	{
		debug_print(delete_user_table());
		debug_print(create_user_table());
	}
	
	function add_client($name,$email,$pass)
	{
		global $conn;
		if(filter_var($email,FILTER_VALIDATE_EMAIL)===false) return "Invalid Email Format";
		$sql="insert into client(name,email,pass) values('$name','$email','$pass')";
		$r=$conn->query($sql);
		if($r===true) return true;
		debug_print($conn->error);
		return $conn->error;
	}
	
	function register_client($name,$email,$pass)
	{
		$r=add_client($name,$email,$pass);
		if($r!==true) return $r;
		session_start();
		$_SESSION['email']=$email;
		return $r;
	}

	function does_client_exist()
	{
		
	}
	
	function authenticate_client()
	{
		
	}
	
	function login_client()
	{
		
	}
	
	function logout_client()
	{
		session_start();
		session_destroy();
	}
	
	
	$debug_mode_on=true;
	$conn=get_sql_connection();
	//init();
	//add_client("allen","allenross653@gmail.com","allenpass");
	//add_client("joseph","joseph@gmail.com","joseph");
	close_sql_connection($conn);



?>