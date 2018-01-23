<?php

	/*
	var declaration		//type		//sample value		//possible values
	Example:
	public $currency	//string	//"USD"				//USD, INR, GBP, AUD, CAD, ...
	*/
	
	class money
	{
		public amount;	//numeric	//145
		public currency;	//string	//"USD"		//USD, CAD, INR, GBP, AUD,	...
	}
		
	class user
	{
		public $email;	//string		//"asd@asd.com"
		public $password;	//string	//"asdbc"
		public $name;	//string		//"Ben Allen"
		public $date_time;	//date-time
		public $balance=array();	//class money array
		public $msg_order=array();	//class message array
			
		public function __construct($email,$pass,$name)
		{
			$this->email=$email;
			$this->pass=$pass;
			$this->name=$name;
			//$date_time <TODO>
		}
		
		
		//add money
		
		//request withdraw money
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
		//place bid

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
		public $bids=array();	//class bid array	
		public $date_time;	//date-time
		
		//FUNCTIONS:
		
		//CLIENT:
		//delete project
	}
	
	class bid
	{
		public $project;		//class project
		public $freelancer		//class freelancer
		public $description;	//string		//"I can do this project easily."
		public $amount;			//class money
		public $days;			//numeric		//25
		public $msgs=array();	//class message array
		public $date_time;	//date-time
		public $msg_blocked_by_project_owner=true;	//boolean	//true	//true, false
		public $msg_blocked_by_bid_placer=false;	//boolean	//false	//true, false
		
		
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
		
		

		//CLIENT:
		//send msg		//project owner can send msg to bid placer if he is not blocked by bid placer.. if bid placer is blocked by project owner, the block is removed as soon as he send the msg.
		
		//block		//project owner can block from block bid placer from sending any msg to him
		
		//reward project to bid placer

		//create milestone	//project owner can create milestone				
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
	}
	
	class dispute
	{
		public $milestone;
		public $user;
		public $msgs=array();
		public $date_time;
		public $willing
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
	
	

?>








