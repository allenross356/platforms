<?php

	class client
	{
		public static $debug_mode_on=true;
		public static $conn;
		
		public static function debug_print($obj)
		{
			if(client::$debug_mode_on===false) return;
			if(is_object($obj)) var_dump($obj);	else echo "$obj<br>";
		}
		
		public static function get_sql_connection()
		{
			$conn = new mysqli("localhost", "root", "", "freelancer");
			if($conn->connect_error)
			{
				echo "Connection failed: " . $conn->connect_error . "<br>";
				die("Connection failed: " . $conn->connect_error);			
			}
			return $conn;
		}
		
		public static function close_sql_connection($conn)
		{
			$conn->close();
		}
				
		public static function create_user_table()
		{
			$sql="CREATE TABLE client(
						id bigint UNSIGNED NOT NULL AUTO_INCREMENT,
						email varchar(64) not null unique,
						pass text,
						name text,
						PRIMARY KEY (id)
						);";
			$f=client::$conn->query($sql);
			if($f===true) return true;
			return $conn->error;
		}
		
		public static function delete_user_table()
		{ 
			$sql="drop table client";
			$f=client::$conn->query($sql);
			if($f===true) return true;
			return $conn->error;
		}
		
		public static function init()
		{
			client::debug_print(client::delete_user_table());
			client::debug_print(client::create_user_table());
		}
		
		public static function add_client($name,$email,$pass)
		{
			if(filter_var($email,FILTER_VALIDATE_EMAIL)===false) return "Invalid Email Format";
			$sql="insert into client(name,email,pass) values('$name','$email','$pass')";
			$r=client::$conn->query($sql);
			if($r===true) return true;
			client::debug_print(client::$conn->error);
			return client::$conn->error;
		}
		
		public static function authenticate_client($email,$pass)
		{
			$sql="select id from client where email='$email' and pass='$pass'";
			$r=client::$conn->query($sql);
			if($r===false) return $conn->error;
			if($r->num_rows) return true;
			return false;
		}
		
		public static function register_client($name,$email,$pass)
		{
			$r=add_client($name,$email,$pass);
			if($r!==true) return $r;
			$_SESSION['email']=$email;
			return $r;
		}
		
		public static function login_client($email,$pass)
		{
			if(!client::authenticate_client($email,$pass)) return false;
			$_SESSION['email']=$email;
		}
		
		public static function logout_client()
		{
			session_destroy();
		}
		
		public static function current_client()
		{
			if(isset($_SESSION['email'])) return $_SESSION['email'];
			return false;
		}
		
		public function __invoke()
		{
			client::$debug_mode_on=true;
			client::$conn=client::get_sql_connection();
			session_start();
			//client::init();
			//client::add_client("allen","allenross653@gmail.com","allenpass");
			//client::add_client("joseph","joseph@gmail.com","joseph");
			//client::login_client("joseph@gmail.com","joseph");
			//var_dump(client::current_client());
			//client::logout_client();
			client::close_sql_connection(client::$conn);
		}	
	}
	
	//$a=new client;
	//$a();


	class a
	{
		public $r=6;
	}
	
	class b
	{
		public $s=["s","d"];
		public $n=23;
		public $c;
		
		public function __construct()
		{
			$this->c=new a;
		}
	}
	
	class d
	{
		public $t;
		
		public function __construct()
		{
			$this->t=[new b, new a];
		}
	}
	
	class sql_oop
	{
		public function __invoke()
		{
			$g=new d;
			var_dump($g);
		}
	}
	
	$b=new sql_oop;
	$b();
	
	$sql="CREATE TABLE string(
						id mediumint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
						parent_id mediumint,
						name varchar(64) not null,
						index mediumint,
						value text;
						);";

	$sql="CREATE TABLE int(
						id mediumint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
						parent_id mediumint,
						name varchar(64) not null,
						index mediumint,
						value bigint;
						);";

	
	$sql="CREATE TABLE a(
						id mediumint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
						parent_id mediumint,
						name varchar(64) not null,
						index mediumint,
						r bigint;
						);";
	
	$sql="CREATE TABLE b(
						id mediumint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
						parent_id mediumint,
						name varchar(64) not null,
						index mediumint,
						s mediumint;
						n bigint;
						c mediumint;
						);";

	$sql="CREATE TABLE b(
						id mediumint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
						parent_type text,
						parent_id mediumint,
						name varchar(64) not null,
						index mediumint,
						s mediumint;
						n bigint;
						c mediumint;
						);";
						
	$sql="CREATE TABLE d(
						id mediumint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
						parent_id mediumint,
						name varchar(64) not null,
						index mediumint,
						t bigint;
						);";
	
	
	
	

?>