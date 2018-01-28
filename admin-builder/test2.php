<?php

//$a=1;
$r=<<<code
\$a=[1,2,10];
return \$a;
code;
var_dump(eval($r));
//var_dump($a);
?>