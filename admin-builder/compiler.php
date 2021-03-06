<?php

require_once("enclosing.php");

//<TODO> test performance for passing by reference and compare with passing by value
//<TODO> add type password in addition string and int


//<TODO> add following features 
//adding blog: 
	//automate link building
	//automate content generation
		//automate hidden original content rephrasing
		//visible original content 
//web scraping and web simulation
	//social media simulation
	//email scraping
	//content scraping
		//english rephrasing
		//image modifying
		//video modifying
		//audio modifying
	//link building
	//own forum simulation (reply to threads by posting on another forum and copying replies from there)
//providing support on generic topics: automation of replying by posting the question on another forum and then posting the replies back on own forum.
//forum and automation multiple replies to threads
//social media accounts
	//automatic posting (hunting high quality posts and reposting)
	//automatic liking/sharing/retweeting
	//automatic replies to people (try but not sure)
	//all major platforms
		//FB (add friends, wall post, messaging, FB groups - own groups and others' groups)
		//twitter (tweets, retweets, like/love, messaging, groups)
		//linkedin
		//tumblr (posts, follow, messaging)
		//instagram (posts, follow, messaging)
		//pinterest (posts, follow, messaging)
		//whatsapp
		//reddit
		//craigslist
		//etc
//notification marketing
	//email capturing, pop ups, opt-ins
	//sending marketing
	//social media
//location track (like uber)
//payment gateway
//version control similar to github and svn (merging, compressing and submitting the files on the server)
//automatic download and set up of files when features require them.. until the features are not called in the code, the heavy libraries are not downloaded/installed
//automatic injection of upgrades and assignment of tasks
//game development
	//game rules and AI for playing the game
	//types of games
		//board game
		//puzzles
		//car game
		//shooting game
//algorithms
	//photo editing and restructure algorithms
	//video editing and restructure algorithms
	//AI algorithms
		//image recognition
		//text recognition
		//face recognition
		//voice recognition
		//logical, geometrical problem solving
	

function connect_database($obj)
{
	$obj=_move_dash_under($obj);
	$host=$obj['host'];
	$user=$obj['user'];
	$pass=$obj['pass'];
	$db=$obj['db'];
	set_database_credentials($host,$user,$pass,$db);
}

function create_object($obj)	//<TODO> implement nested/recursive object handling
{
	global $objects;
	$obj=_move_dash_under($obj);
	$name=$obj['name'];	//my-attribute
	$pt=$obj['param_types'];	//attributes types 
	$pn=$obj['param_names'];	//attributes
	$extends=$obj['extends'];	//<TODO> implement	//string or list of attributes

	$objects[$name]=_create_object($name,$pt,$pn,$extends);	//type, field <optional>, current_val, extensible
}

//create <single> attribute my-attribute 
function create_attribute($obj)
{
	global $attributes;
	$obj=_move_dash_under($obj);
	$name=$obj['name'];	//my-attribute
	$single=$obj['single'];	//boolean
	$pt=$obj['param_types'];	//attributes types 
	$pn=$obj['param_names'];	//attributes
	$pv=$obj['possible_values'];
	$cv=$obj['current_values'];
	$ext=$obj['extensible'];	//boolean			if cmd contains 'some' before 'possible values' (some possible values) then the attribute is extensible 
	$def=$obj['default'];	//boolean
	$extends=$obj['extends'];	//<TODO> implement	//string or list of attributes

	if($pv=="" || count($pv)==0) $ext=true;

	$attributes[$name]=_create_attribute($name,$single,$pt,$pn,$pv,$cv,$ext,$def,$extends);	//type, field <optional>, current_val, extensible
}

function create_user($obj)
{
	global $users;
	$obj=_move_dash_under($obj);
	$name=$obj['name'];	//my-attribute
	$pt=$obj['param_types'];	//attributes types 
	$pn=$obj['param_names'];	//attributes
	$pv=$obj['possible_values'];
	$ext=$obj['extensible'];	//boolean			if cmd contains 'some' before 'possible values' (some possible values) then the attribute is extensible 
	$extends=$obj['extends'];	//string or list of attributes

	if($pv=="" || count($pv)==0) $ext=true;

	$users[$name]=_create_user($name,$pt,$pn,$pv,$ext,$def,$extends);	//type, field <optional>, current_val, extensible
}

function create_action($obj)
{
	global $actions;
	$obj=_move_dash_under($obj);
	$name=$obj['name'];
	$by=$obj['by'];	//list or string
	$freq_user=$obj['frequency_user'];	//array with 2 elements ['single',''] OR ['',''] OR ['multi','multi']
	$freq_subject=$obj['frequency_subject'];	//array with 2 elements ['single',''] OR ['',''] OR ['multi','multi']
	$subject=$obj['subject'];	//array with key 'of'.. array of arrays with keys 'of'
	$relation=$obj['relation'];		//null (default depending on freq and subject type) or string 'many-to-one' 
	$duplicate=$obj['duplicate'];	//boolean
	$define=$obj['define'];		//null ['usual'=>[],'user-defined'=>['$name']] OR ['usual'=>[implode('-',$name)[0]],'user-defined'=>[]] // array with keys 'usual' and 'user-defined', and values as arrays ['usual'=>['create'],'user-defined'=>['myfunc']] 

	$actions[$name]=_create_action($name,$by,$freq_user,$freq_subject,$subject,$relation,$duplicate,$define);
}

function create_trigger($obj)
{
	//<TODO>
}

function execute_cmd(&$tokens)
{
	if($tokens['cmd']==_create())
	{
		if($tokens['type']==_object()) create_object($tokens['obj']);
		elseif($tokens['type']==_attribute("name")) create_attribute($tokens['obj']);
		elseif($tokens['type']==_user()) create_user($tokens['obj']);
		elseif($tokens['type']==_action()) create_action($tokens['obj']);
	}
	elseif($tokens['cmd']==_connect())
	{

	}
}













	class keyword
	{
		private $name;
		private $categories;

		public function __construct($name,$categories)
		{
			$this->name=$name;
			$this->categories=$categories;
		}

		public function get_name()
		{
			return $this->name;
		}

		public function get_categories()
		{
			return $this->categories;
		}
	}

	class keywords
	{
		private $keywords=[];

		public function __construct()
		{}

		public function add_keyword($name,$categories)
		{
			$this->keywords[$name]=new keyword($name,$categories);
		}
	}

	class rule
	{
		private $name;
		private $function;

		public function __construct($name,$function)
		{
			$this->name=$name;
			$this->function=$function;
		}
	
		public function get_name()
		{
			return $this->name;
		}

		public function get_function()
		{
			return $this->function;
		}
	}

	class rules
	{
		private $rules=[];

		public function add_rule($name,$function)
		{
			$this->rules[$name]=new rule($name,$function);
		}
	}

	class applied_rules()
	{
		private $name;
		private $rules=[];



		public function add_rule()
		{

		}
	}


	class syntax
	{
		private $rules;


		public function __construct()
		{}



		public function add_command($name,$arguments)
		{
			$c=new command($name,$arguments);
		} 

		public function next_char($c)
		{}

		public function end_of_code()
		{}
	}

	$syntax=new syntax;

	$syntax->add_command("create");
	$syntax->add_command("start");
	$syntax->add_command("namespace");
	$syntax->add_command("activate");



	






	class interpreter
	{	

		public $beautified_code;
		public $error_fl=false;
		public $error_msg="Success";
	
		public function __construct($file)
		{
			$this->compile($file);
			return $this;
		}
		
		public function __invoke($file)
		{
			$this->beautified_code=interpreter::compile($file);
		}
		
		function execute_line(&$tokens)
		{
			if()
		}
		
		function get_name_length(&$chip,$p)
		{		}

		function is_name_char(&$chip,$p)
		{

		}

		function tokenize(&$chip,$prev_token)
		{
			$r=[];
			$n=strlen($chip);
			for($i=0;$i<$n;$i++)
			{
				if(is_name_char($chip,$i))
				{
					$l=get_name_length($chip,$i);
					if
				}
			}
		}

		function parse_line(&$line)
		{
			$l=explode(" ",$line);
			if
		}
		
		function is_multiline_end(&$line)
		{}
		
		function is_single_lined(&$line)
		{}
		
		function parse_lines(&$code)
		{
			$lines=explode("\n",$code);
			$n=count($lines);
			for($i=0;$i<$n;$i++)
			{
				if(is_single_lined($lines[$i]))
					parse_line($lines[$i]);
				else
				{
					$f=false;
					$l=$lines[$i];
					for($j=$i+1;$j<$n;$j++)
					{
						$l.=$lines[$j];
						if(is_multiline_end($line[$j])
						{
							$f=true;
							$i=$j;
							break;
						}
					}
					if(!$f) 
					{
						$this->error_fl=true;
						$this->error_msg=": started at $i but never ended with ;"
						return;
					}
					parse_line($l);
				}
			}
		}
		
		function compile($file)
		{
			$code=file_get_contents($file);
			parse_lines($code);
		}		
		
	}

	$o=new interpreter("code.ab");
	var_dump($o->error_msg);
	
?>





/*
//tokenize code and throw compile errors
loop through code characters
	get next command
	define expectation

//execute code and throw runtime errors

*/









