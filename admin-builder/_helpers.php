<?php

require_once("names.php");

public _c1['string'=>"'",'float'=>"'",'datetime'=>"'",'int'=>"",'bool'=>""];
public _c2['mix'=>"'",''=>"'"];


function _key_value_format(&$v,&$c)		//<TODO> test performance for passing by reference and compare with passing by value
{
	return ",$c".$v."$c";
}

function _key_value_array_format(&$v,&$c)
{
	return ",$c".implode("$c,$c", $v).$c;
}

function _key_value_single_concat(&$t,&$V)
{
	global $_c1,$_c2;
	if(isset($_c1[$t]))	//$t is 'string' or 'float' or 'int' or 'datetime' or 'bool'
		return _key_value_format($v,$_c1[$t]);
	elseif(isset($_c2[$t]))	//$t is 'mix' or ''
	{
		if(is_array($v))
			return _key_value_single_concat($v['type'],$v['value']);
		elseif(is_int($v) || is_bool($v))
			return _key_value_format($v,$_c1['int']);
		return _key_value_format($v,$_c2[$t]);
	}
	else 	//$t is user-defined
	{
		//<TODO>
	}
}

function _key_value_mix_array_concat(&$v)
{
	global $_c1,$_c2;
	$r="";
	foreach($v as $x)
		$r.=_key_value_single_concat($x['type'],$x['value']);
	return $r;
}

function _key_value_any_array_concat(&$t,&$v)
{
	global $_c1,$_c2;
	if(isset($_c1[$t]))	//$t is 'string' or 'float' or 'int' or 'datetime' or 'bool'
		return _key_value_array_format($v,$_c1[$t]);
	elseif(isset($_c2[$t]))	//$t is 'mix' or ''
	{
		return _key_value_mix_array_concat($v);
	}
	else 	//$t is user-defined
	{
		//<TODO>
	}
}

function _key_value_complex_array_concat(&$t,&$v)
{
	$r="";
	$i=0;
	foreach($v as $x)
	{
		$r.=_key_value_single_concat($t[$i],$x);
		$i++;
	}
	return $r;
}

function _key_value_mutli_complex_array_concat(&$t,&$pv)
{
	$r=[];
	foreach($pv as $v)
		$r[]=",[".ltrim(_key_value_complex_array_concat($t,$v),",")."]";
	return implode(",", $r);
}


?>