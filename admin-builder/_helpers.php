<?php

require_once("names.php");

//public _c1['string'=>"'",'float'=>"",'datetime'=>"'",'int'=>"",'bool'=>""];
//public _c2['mix'=>"'",''=>"'"];
public _c1=['string'=>"string",'float'=>"float",'int'=>"int",'datetime'=>"string"];	//<TODO> add type password and email and phone number and text and blob
public _c2=['mix'=>"mix",''=>"unspecified"];	//<TODO> add type array 
public _c3=['bool'=>'bool'];

//<TODO> create_attribute
	//handle case if type is list of count 1 instead of string then convert to string
	//if type is string or list of count 1 and field is still not null
//<TODO> in create table
	//implement case when values exceed the limit of field type
//<TODO> add data types 
	//array
	//text
	//blob
	//password
	//email
	//phone number
//<TODO> for create_object, implement recursive/nested object handling


function _single_move_dash_under($o)
{
	return str_replace("-", "_", $o);
}

function _identify_object_type($v)	//and return the object with proper type casting
{
	//<TODO>
}

function _value_to_list($v)
{
	if(is_array($v)) return $v;
	return [$v];
}

function _values_to_list($v)
{
	if(is_array($v[0])) return $v;
	foreach($v as &$x)
		$x=[$x];
	return $v;
}

function _object_format($t,$v)	
{
	global $_c1,$_c2,$_c3;
	if(isset($_c1[$t]))	//$t is 'string' or 'float' or 'int' or 'datetime'
		return eval("return ($t)$v;");
	elseif(isset($_c3[$t]))	//$t is 'bool'
		return filter_var( $v, FILTER_VALIDATE_BOOLEAN);
	elseif(isset($_c2[$t]))	//$t is 'mix' or ''
	{
		if(is_array($v))
			return _object_single_concat($v['type'],$v['value']);
		else
			return _identify_object_type($v);
	}
	else 	//$t is user-defined
	{
		//<TODO>
	}	
}

function _object_array_format($t,$v)
{
	$r=[];
	foreach($v as $x)
	{
		$y=_object_format($t,$x);
		$r[]=$y;
	}
	return $r;
}

function _object_mix_array_concat($v)
{
	global $_c1,$_c2;
	$r=[];
	foreach($v as $x)
		$r[]=_object_format($x['type'],$x['value']);
	return $r;
}

function _object_any_array_concat($t,$v)	//$t=string, $v=[obj1,obj2,obj3]
{
	global $_c1,$_c2;
	if(isset($_c1[$t]))	//$t is 'string' or 'float' or 'int' or 'datetime' or 'bool'
		return _object_array_format($v,$_c1[$t]);
	elseif(isset($_c2[$t]))	//$t is 'mix' or ''
	{
		return _object_mix_array_concat($v);
	}
	else 	//$t is user-defined
	{
		//<TODO>
	}
}

function _object_complex_array_concat($t,$v)	//$t=[type1,type2,type3], $v=[obj1,obj2,obj3]
{
	$r=[];
	$i=0;
	foreach($v as $x)
	{
		$r[]=_object_format($t[$i],$x);
		$i++;
	}
	return $r;
}

function _object_mutli_complex_array_concat($t,$pv)
{
	$r=[];
	foreach($pv as $v)
		$r[]=_object_complex_array_concat($t,$v);
	return $r;
}

function _type_to_sql($type)	//<TODO>
{
	switch $type{
		case "string": return "varchar(2)";
		case "int": return "tinyint";
		case "text": return "tinytext";
		case "float": return 

	}
}

function _build_create_table_query($table_name,$field_types,$field_names,$add_id=true)
{
	$tn=$table_name."_"._compiler('name');
	$r="create table $tn(";
	$v=[];
	if($add_id) $v[]="_id tinyint unique auto_increment primary key";
	list($field_types,$field_names)=_values_to_list([$field_types,$field_names]);
	$i=0;
	foreach($field_types as $f)
	{
		$v[]=$field_names[$i]." "._type_to_sql($f);
		$i++;
	}
	$r.=implode(",",$v).")";
}

function _build_insert_values_query($table_name,$field_names,$values)	//assuming all object values are already converted to valid mysql data types
{
	list($field_names,$values)=_values_to_list([$field_names,$values]);
	$t=implode(',',$field_names);
	$v=implode(',',$values);
	$tn=$table_name."_"._compiler('name');
	return "insert into $tn($t) values($v)";
}

function _execute_insert_query($table_name,$field_names,$values)
{
	//<TODO> first check if the count of the previous rows is not overflowing. check after the query fails in order to be efficient.
	$r=query_database($sql);
	if($err) then check size of the values and check the capacity of fields and adjust field capacity accordingly//<TODO>
}

//[],			[]			[[]]			[]				bool 		bool
//param_types, param_names, possible_values, current_value, extensible, default
function _create_attribute_object($r,$pt,$pv)	
{
	if(is_string($pt))	//$pt is string.. single field
		foreach(_object_any_array_concat($pt,$pv) as $x)
			$r[]=$x;
	else 	//$pt is list of strings.. multiple fields
		foreach(_object_multi_complex_array_concat($pt,$pv) as $x)
			$r[]=$x;
	return $r;
}

function _create_attribute_table($r,$name,$pt,$pn,$pv)
{
	query_database(_build_create_table_query($name,$pt,$pn));
	$v=_create_attribute_object([],$pt,$pv);
	foreach($pv as $p)
		_build_insert_values_query($name,$pn,$pv);	//<TODO> mysql error handling
	return $r;
}









?>