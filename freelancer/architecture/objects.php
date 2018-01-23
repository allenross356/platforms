<?php

	/*
	var declaration		//type		//sample value		//possible values
	Example:
	public $currency	//string	//"USD"				//USD, INR, GBP, AUD, CAD, ...
	*/
	
	/*
	FUNCTIONS:
	- user can add, withdraw money								[covered]
	- client can post or delete project							[covered]
	- client can create milestone on project and/or bid			[covered]
	- freelancer can place bid or revoke his bid on project		[covered]
	- client can msg freelancer									[]
	- freelancer can msg client									[]
	- client and freelancer can block each other				[]
	- client and freelancer can dispute milestone 				[]
	- client can search freelancer and contact them				[]
	- freelancer can search projects and place bids on them		[]
	*/
	
	
	
	
		
	
	
	
	
	
	function get_table_prefix()
	{
		return "freelancer_";
	}
	
	class money
	{
		public $amount;	//numeric	//145
		public $currency;	//string	//"USD"		//USD, CAD, INR, GBP, AUD,	...
	}
		
	class user
	{
		public $email;	//string		//"asd@asd.com"
		public $email_verified=false;		//boolean	//false
		public $password;	//string	//"asdbc"
		public $name;	//string		//"Ben Allen"
		public $date_time;	//date-time
		public $balance=array();	//class money array
		public $msg_order=array();	//class message array
				
		public function get_table_name()
		{
			return get_table_prefix()."user";
		}
		
		private function sql_destroy()
		{
			$tablename=get_table_name();
			$sql="DROP TABLE $tablename;";
			//<TODO> execute query
			//<TODO> error handling
			//<TODO> return true or false depending on success or failure
		}
		
		public function sql_init()
		{
			sql_destroy();
			$tablename=get_table_name();
			$sql="CREATE TABLE $tablename(
				id bigint(9) UNSIGNED NOT NULL AUTO_INCREMENT,
				parent_id bigint(9),
				array_id bigint(9),
				email text not null unique,
				email_verified bool,
				pass text,
				name text,
				balance bigint(9),
				msg_order bigint(9),
				date_time datetime,
				PRIMARY KEY (id)
				) $charset_collate;";
			//<TODO> execute query
			//<TODO> error handling
			//<TODO> return true or false depending on success or failure
		}
		
		public function does_object_exist($email)
		{
			$tablename=get_table_name();
			$sql="SELECT id from $tablename where email='$email';";
			//<TODO> execute query
			//<TODO> error handling
			//<TODO> if record found then return true else return false;
		}
		
		public function get_object($email)
		{
			$tablename=get_table_name();
			$sql="select * from $tablename where email='$email'";
			//<TODO> execute query
			//<TODO> error handling
			//<TODO> if record found, then create object and return, else return false
		}
		
		public function new_object($email,$pass,$name)
		{
			$tablename=get_table_name();
			$sql="insert into $tablename() values('$email','$pass','$name')";
			//<TODO> execute query
			//<TODO> handle error 
			//<TODO> return id on success and false on failure
		}
		
		public function __construct($email,$pass,$name)
		{
			$this->email=$email;
			$this->pass=$pass;
			$this->name=$name;
			//$date_time <TODO>
		}
		
		//FUNCTIONS:
		//add money 
		//request withdraw money
		
		public function add_money()
		{
			
		}
		
		public function withdraw_money_request()
		{
			
		}
	}

	class client extends user
	{
		public $projects=array();	//class project	array	
		
		//FUNCTIONS:
		//create project 
		//search freelancers
	}
	
	class freelancer extends user
	{
		public $skills=array();	//string array		//array("php","javascript","c#")	//php, javascript, c#, ...
		public $bids=array();	//class bid array
		
		//FUNCTIONS: 
		//search projects
	}
	
	class project
	{
		public $client;	//class client
		public $title;	//string				//"Uber App"
		public $description;	//string		//"Need an uber type app"
		public $skills=array();	//string array	//array("php","javascript","c#")		//php, javascript, c#, ...
		public $budget_range;	//string		//"5-30"	//"Custom Budget", "5-30", "30-100", "100-200", "200-500", "500-1000", "1000-2000", "2000-5000", "5000-10000", "10000-20000", "20000-50000", "50000-100000".
		public $budget_min;		//numeric		//100
		public $budget_max;		//numeric		//200
		public $milestones=array();	//class milestone array
		public $bids=array();	//class bid array	
		public $date_time;	//date-time
		
		//FUNCTIONS:
		
		//CLIENT:
		//delete project	//project owner can choose to delete the project if the project is not accepted by any freelancer
		//edit project		//project <TODO>
		//create milestone	//project owner can create milestone for a project
		//cancel milestone	//project owner can cancel if no freelancer has already accepted the project

		//FREELANCER:
		//place bid		//freelancer can place a bid on the project

		
	}
	
	class bid
	{
		public $project;		//class project
		public $freelancer;		//class freelancer
		public $description;	//string		//"I can do this project easily."
		public $amount;			//class money
		public $days;			//numeric		//25
		public $msgs=array();	//class message array
		public $milestones=array();	//class milestone array
		public $msg_blocked_by_project_owner=true;	//boolean	//true	//true, false
		public $msg_blocked_by_bid_placer=false;	//boolean	//false	//true, false
		public $date_time;	//date-time
		
		
		//FUNCTIONS:
		
		//FREELANCER:
		//send msg	//bid placer can send msg to project owner if he is not blocked by project owner.. if he has blocked project owner, then block will be removed as soon as he sends msg to him. 
		//block		//bid placer can block the project owner from sending any msgs 
		//revoke bid 
		//accept award	 
		//reject award 
		//request creation milestone 
		//request release of milestone 
		//dispute milestone
		//cancel milestone	//freelancer can choose to cancel the milestone created by project owner
		
		

		//CLIENT:
		//send msg		//project owner can send msg to bid placer if he is not blocked by bid placer.. if bid placer is blocked by project owner, the block is removed as soon as he send the msg.
		//block		//project owner can block from block bid placer from sending any msg to him		
		//reward project to bid placer
		//create milestone	//project owner can create milestone
		//request to cancel milestone		//project owner can request to cancel the milestone with the permission of freelancer
	}
	
	class message
	{
		public $type;	//string	//"text", "attachment"
		public $content;	//string data
		public $unread=true;	//boolean	//true	//true, false
		public $date_time;	//date-time
	}
	
	class milestone
	{
		public $project;	//class project
		public $bid;	//class bid
		public $amount;	//numeric	//145
		public $description;	//string	//"milestone to initiate"
		public $date_time;	//date-time
		
		//FUNCTIONS:
		
		//CLIENT:		 
		//release milestone
		
		//dispute milestone
		
		//FREELANCER:
		//dispute milestone
	}
	
	class dispute
	{
		public $milestone;	//class milestone
		public $is_dispute_creator_client;	//boolean
		public $is_winner_client;	//boolean
		public $status;	//string	//"resolved"	//resolved, in progress, cancelled
		public $msgs=array();	//class message array
		public $date_time;	//date-time
		public $client_negotiate_amount;	//numeric		//20
		public $freelancer_negotiate_amount;	//numeric	//100
		public $client_paid_dispute_fee=false;	//boolean
		public $freelancer_paid_dispute_fee=false;	//boolean
		
		//FUNCTIONS:
		
		//CLIENT:
		//
	}

	$clients=array();	//class client array
	$freelancers=array();	//class freelancer array
	$projects=array();	//class project array
	$bids=array();	//class bid array
	$msgs=array();	//class message array
	$milestones=array();	//class milestone array
	
	
	
	
	//FUNCTIONS:
	//create client
	//create freelancer
	
	
	function app_init()
	{
		//call sql_init of all classes
	}
	
	
	function get_user($email)		//return class user or false
	{	
		//<TODO> SQL query
	}

	function authentication($email, $pass)	//return class user or false
	{
		//<TODO> check for email format, empty password
		//<TODO> password encryption
		//<TODO> check for SQL injection
		$user=get_user($email);
		if($user===false) return false;
		if($user->pass==$pass) return $user;
		return false;
	}
	
	function register($email,$pass,$name)
	{
		//<TODO> check for email format, empty password and empty name
		//<TODO> password encryption
		//<TODO> check for SQL injection
		//<TODO> implement email verification
		$new_client=new client($email,$pass,$email);
		return login($email,$pass);
	}
	
	function login($email,$pass)
	{
		//<TODO> check for email format, empty password
		//<TODO> password encryption
		//<TODO> check for SQL injection
		$user=authentication($email,$pass);
		if(!$i) return false;
		session_start();
		$_SESSION["email"]=$email;
		$_SESSION["user_id"]=$user->id;
		return true;
	}	
	
	function logout()
	{
		session_destroy();
	}

	
?>








