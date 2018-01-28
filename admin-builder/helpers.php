<?php

require_once("_helpers.php");

function _move_dash_under($obj)
{
	if(is_array($obj))
	{
		$n=count($obj);
		for($i=0;$i<$n;$i++)
		{		
			if(is_array($obj[$i]))
				$obj[$i]=_move_dash_under($obj[$i]);
			else
				$obj[$i]=_single_move_dash_under($obj[$i]);
		}
	}
	else
		$obj=_single_move_dash_under($obj);
	return $obj;
}

function _add_value(&$type,&$name,&$value)
{	//<TODO>
}

function _find_object(&$type,&$name,&$haystack,&$needle)
{
	$i=0;
	foreach($haystack as $h)
	{
		if($h==$needle) return $i;
		$i++;
	}
	if($haystack['extensible']) 
	{
		_add_value($type,$name,$needle);
		return $i;
	}
	return false;
}

function _create_attribute_object(&$type,&$name,&$single,&$pt,&$pn,&$pv,&$cv,&$ext,&$def)
{
	if(is_array($pt) && count($pt)===1) $pt=$pt[0];
	if(is_string($pt))	//single field
	{
		$r['type']=$pt;
		foreach(_object_any_array_concat($pt,$pv) as $x)
			$r[]=$x;
	}
	else 	//multiple fields
	{
		$r['type']=$pt;
		$r['field']=$pn;
		$r['extensible']=_identify_object_type($ext);
		foreach(_object_multi_complex_array_concat($pt,$pv) as $x)
			$r[]=$x;
	}
	if($single)
	{
		if($def)
			$r['current_val']=_identify_object_type($cv);
		else
			$r['current_val']=_find_object($type,$name,$r,$cv);
	}
	return $r;
}

/*
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
}*/

?>