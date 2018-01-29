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

function _add_value($type,$name,$value)
{	//<TODO>
}

function _find_object($type,$name,$haystack,$needle)
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

function _create_object($name,$pt,$pn,$extends)
{
	$r=[];
	$r['type']=$pt;
	$r['field']=$pn;
	$r=_create_attribute_table($r,$name,$single,$pt,$pn,$pv,$cv,$ext,$def);		
	return $r;	
}

function _create_attribute($name,$single,$pt,$pn,$pv,$cv,$ext,$def,$extends)
{
	$r=[];
	$r['type']=$pt;
	$r['field']=$pn;
	$r['extensible']=_identify_object_type($ext);
	if($r['extensible'])
		$r=_create_attribute_table($r,$name,$single,$pt,$pn,$pv,$cv,$ext,$def);		
	else
		$r=_create_attribute_object($r,$name,$single,$pt,$pn,$pv,$cv,$ext,$def);	
	if($single)
	{
		if($def)
			$r['current_val']=_identify_object_type($cv);
		else
			$r['current_val']=_find_object($type,$name,$r,$cv);
	}
	return $r;	
}

function _create_user($name,$pt,$pn,$pv,$ext,$extends)
{
	$r=_create_attribute($name,false,$pt,$pn,$pv,null,$ext,null,$extends);
}

function _create_action($name,$single,$pt,$pn,$pv,$cv,$ext,$def,$extends)
{

}

?>