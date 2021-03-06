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

function _add_value($type,$name,$value)		//add value in attribute if value is not found through _find_object
{	//<TODO>
}

function _find_object($type,$name,$haystack,$needle,$add_value=false)
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

function _create_object($name,$pt,$pn,$extends) 	//<TODO> implement $extends
{
	$r=[];
	$r['type']=$pt;
	$r['field']=$pn;
	$r=_create_attribute_table($r,$name,$pt,$pn,[]);
	return $r;	
}

function _create_attribute($name,$single,$pt,$pn,$pv,$cv,$ext,$def,$extends)	//<TODO> implement $extends
{
	$r=[];
	$r['type']=$pt;
	$r['field']=$pn;
	$r['extensible']=_identify_object_type($ext);
	if($r['extensible'])
		$r=_create_attribute_table($r,$name,$pt,$pn,$pv);		
	else
		$r=_create_attribute_object($r,$pt,$pv);	
	if($single)
	{
		if($def)
			$r['current_val']=_identify_object_type($cv);
		else
			$r['current_val']=_find_object($type,$name,$r,$cv,true);
	}
	return $r;	
}

function _create_user($name,$pt,$pn,$pv,$ext,$extends)
{
	$r=_create_attribute($name,false,$pt,$pn,$pv,null,$ext,null,$extends);
}

function _create_action($name,$by,$freq_user,$freq_subject,$relation,$duplicate,$subject,$define);	//<TODO> implement 'respectively', 'each', 'all'/'both' for multiple $by and $subject
{
	/*<TODO> implement in syntax reader
	global $_action;
	if($define==null)
	{
		$d=explode('-',$name)[0];
		foreach($_action('all_types') as $a)
			if($d==$a)
			{
				$define=['usual'=>$d];
				break;
			}
	}*/

	$r=[];
	$r['by']=$by;
	$r['frequency_user']=$freq_user;
	$r['frequency_subject']=$freq_subject;
	$r['relation']=$relation;
	$r['duplicate']=$duplicate;
	$r['subject']=$subject;
	$r['define']=$define;

	/*
	if object/user/attribute/action not specified ('on' parameter is null)
		assumed that the object/user/attribute/action already exists
		if action is usual
			if action is create
				create table <action name>(object id, user id)
				create API for user to take action to insert the record
			elseif action is delete
				create API for user to take action to delete the record from both tables (object table, related user table)
			elseif action is edit
				create API for user to take action to update the record
			elseif action is read
				create API for user to take action to select the record
			endif
		endif
	elseif the object/action/attribute/user doesn't exists
		create the table 
	else if object/action/attribute/user exists
		if object is usual
		if action is usual
			if action is create
				create API for user to take action to insert the record
			elseif action is delete
				create API for user to take action to delete the record
			elseif action is edit
				create API for user to take action to update the record
			elseif action is read
				create API for user to take action to select the record
			endif
		elseif action is not usual

		endif
	endif
	*/

	$pn=_create_action_get_types_and_names($by,$subject);	//<START HERE> implement the create, mark, etc.
	foreach($pn as $p)
		$r=_create_attribute_table($r,$name,$p,$p,null);

}

?>