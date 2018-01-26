<?php

	function compile($file)
	{
		$code=file_get_contents($file);
		var_dump(explode(" ",$code));
	}
	
	compile($file);

>?