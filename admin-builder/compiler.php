<?php

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
		
		function line_execute(&$tokens)
		{
			
		}
		
		function parse_line(&$line)
		{
			for($line=)
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