<?php


function pass_by_reference(&$x)
{
	$x = str_replace("-", "_", $x); 
}

function pass_by_value($x)
{
	return str_replace("-", "_", $x); 
}

function run()
{
	$t1=microtime(true);
	$x="ds-fsd-fds-fs";
	for($i=0;$i<100000;$i++)
	{
		$x="ds-fsd-fds-fs";
		pass_by_reference($x);
	}
	$t2=microtime(true);

	$t3=microtime(true);
	$y="ds-fsd-fds-fs";
	for($i=0;$i<100000;$i++)
	{
		$y="ds-fsd-fds-fs";
		$y=pass_by_value($y);
	}
	$t4=microtime(true);

	$tx=$t2-$t1;
	$ty=$t4-$t3;
	echo "x=$x took $tx time<br>y=$y took $ty time<br>";
	echo "$t2 and $t1<br>$t4 and $t3<br>";
}

run();

?>