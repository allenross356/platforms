<?php

class attribute
{
	public $name;
	public $type;	//single, multi
	public $param_types;	//int, float, string, mix, <user-defined> 
	public $param_names;	
	public $possible_values;
}

class user
{
	public $name;
	public $type;
	public $param_types;
	public $param_names;
	public $extends;
}

class action
{
	public $name;
	public $by;
	public $
}


public $attributes=[];
public $users=[];
public $actions=[];
public $views=[];
public $features=[];


function execute_cmd(&$tokens)
{
	if($tokens['cmd']='create')
	{
		if($tokens['type']='attribute')
		{

		}
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









