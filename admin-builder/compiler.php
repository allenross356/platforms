<?php

require_once("enclosing.php");

//<TODO> test performance for passing by reference and compare with passing by value
//<TODO> add type password in addition string and int

function connect_database($obj)
{
	$obj=_move_dash_under($obj);
	$host=$obj['host'];
	$user=$obj['user'];
	$pass=$obj['pass'];
	$db=$obj['db'];
	set_database_credentials($host,$user,$pass,$db);
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
	$extends=$obj['extends']	//<TODO> implement	//string or list of attributes

	if($pv=="" || count($pv)==0) $ext=true;

	$attributes[$name]=_create_attribute($name,$single,$pt,$pn,$pv,$cv,$ext,$def);	//type, field <optional>, current_val, extensible
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
	$extends=$obj['extends']	//string or list of attributes

}

function execute_cmd(&$tokens)
{
	if($tokens['cmd']==_create())
	{
		if($tokens['type']==_attribute("name")) create_attribute($tokens['obj']);
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









