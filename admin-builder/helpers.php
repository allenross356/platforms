<?php

public _c1['string'=>"'",'float'=>"'",'int'=>""];
public _c2['mix'=>"'",''=>"'"];


function _key_value_concat(&$v,&$c)
{
	return ",$c".$v."$c";
}

function _key_value_single_concat(&$t,&$V)
{
	global $_c1,$_c2;
	if(isset($_c1[$t]))	//$t is 'string' or 'float' or 'int'
		return _key_value_concat($v,$_c1[$t]);
	elseif(isset($_c2[$t]))	//$t is 'mix' or ''
	{
		if(is_int($v))
			return _key_value_concat($v,$_c1['int']);
		return _key_value_concat($v,$_c2[$t]);
	}
	else 	//$t is user-defined
	{

	}
}

function _key_value_array_concat(&$t,&$v)
{
	global $_c1,$_c2;
	if(isset($_c1[$t]))	//$t is 'string' or 'float' or 'int'
		return _key_value_concat($v,$_c1[$t]);
	elseif(isset($_c2[$t]))	//$t is 'mix' or ''
	{
		if(is_int($v))
			return _key_value_concat($v,$_c1['int']);
		return _key_value_concat($v,$_c2[$t]);
	}
	else 	//$t is user-defined
	{

	}
}

function _create_key_value_string(&$name,&$single,&$pt,&$pn,&$pv)
{
	if(is_array($pt) && count($pt)===1) $pt=$pt[0];
	$c['string']="'";
	$c['float']="'";
	$c['int']="";	
	if(is_string($pt))
	{	//single field
		if(isset($c[$pt]))	//type 'string' or 'float' or 'int'
		{
			return "type=>'".$pt."',".$c[$pt].implode($c[$pt].",".$c[$pt],$pv).$c[$pt];
		}
		elseif($pt=="mix")
		{	//type 'mix'
			$c['mix']="'";
			$c['']="'";
			$r='';
			foreach($pv as $p)
			{
				if(isset($c[$p['type']]))
				{
					if(isset([''=>1,'mix'=>1][$p['type']]))
						if(is_int($p['value']))
						{
							$r.=','.$p['value'];
							continue;						
						}
					$r.=','.$c[$p['type']].$p['value'].$c[$p['type']];
				}
				else
				{	//$p['type'] is user-defined
					//<TODO>
				}
			}
			$r="type=>'$pt'".$r;
		}
		else
		{	//type user-defined

		}
	}
	else
	{	//multiple fields
		$type="type=>['".implode("','",$pt)."']";
		$field="field=>['".implode("','",$pn)."']";
		foreach($pv as $p)
		{
			$row="";
			$i=0;
			foreach($p as $v)
			{
				if(isset($c[$pt[$i]]))	//$pt[$i] is 'string' or 'int' or 'float'
					$row.=",".$c[$pt[$i]].$v.$c[$pt[$i]];
				elseif($pt[$i]=='mix')
				{
					if($v['type'])
				}
				else
				{	//$pt[$i] is user-defined

				}
				$i++; 
			}
		}
	}
}

?>