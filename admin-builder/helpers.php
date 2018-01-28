<?php
require_once("names.php");
require_once("_helpers.php");

function _find_object(&$haystack,&$needle)
{
	$i=0;
	foreach($haystack as $h)
	{
		if($h==$needle) return $i;
		$i++;
	}
	if($haystack['extensible'])
	return false;
}

function _create_key_value_string(&$type,&$name,&$single,&$pt,&$pn,&$pv,&$cv,&$ext)
{
	if(is_array($pt) && count($pt)===1) $pt=$pt[0];
	$c['string']="'";
	$c['float']="'";
	$c['int']="";
	$s="";
	if(is_string($pt))	//single field
	{	
		$r="'type'=>'$pt'"._key_value_any_array_concat($pt,$pv);
		if($single)
			$s=ltrim(_key_value_single_concat($pt,$cv);	//$r.=",'cur_val'=>".ltrim(_key_value_single_concat($pt,$cv),",").'';
	}
	else 	//multiple fields
	{	
		$type="'type'=>['".implode("','",$pt)."']";
		$field="'field'=>['".implode("','",$pn)."']";
		$extensible="'extensible'=>$ext";
		$r=_key_value_multi_complex_array_concat($pt,$pv);
		$r="$type,$field,$extensible".$r;
		if($single)
			$s="[".ltrim(_key_value_complex_array_concat($pt,$cv)."]"; //$r.=",'cur_val'=>[".ltrim(_key_value_complex_array_concat($pt,$cv),",").']';
	}
	if($s=='') $s='null';
	return [$r,$s];
}

?>