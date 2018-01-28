<?php
class attribute
{
	public $name;
	public $single=false;	
	public $param_types;	//int, float, string, mix, <user-defined> 
	public $param_names;	
	public $possible_values;
}

class user
{
	public $name;
	public $single=false;
	public $param_types;
	public $param_names;
	public $extends;
}

class action
{
	public $name;
	public $by;
	public $dependencies;
	public $functions;	
}

class dependency
{
	public $name;	//name of action or object user
	public $type;	//any, own, owner
	public $not=false;
}

class _function
{
	public $name;	//insert-record, delect-record, select-record, mark, unmark
	public $params;
}

public $attributes=[];
public $users=[];
public $actions=[];
public $views=[];
public $features=[];

public $is_debug_mode=true;
public $resources=[];
public $database_credentials=[];
public $db;

function _folder_resources() {return "./resources";}
function _file_resources() {return _folder_resources()."/resources.txt";}

function _create() {return "define";}
function _attribute($attr) {$name='attribute'; $r=['name'=>$name,'path'=>_folder_resources()."/$name.php",'comment'=>'//Auto-generated attributes end here. DO NOT touch this or above lines!', 'specific-comment'=>'/*Auto-generated attribute name: ___*/']; return $r[$attr];}
function _user() {return "user"};
function _action() {return "action";}
function _view() {return "view";}

function open_database()
{
	close_database();
	global $db;
	$dbc=(object)$database_credentials;
	if(!isset($dbc->host)) return "Error: host is not set";
	if(!isset($dbc->user)) return "Error: user is not set";
	if(!isset($dbc->pass)) $dbc->pass='';
	if(!isset($dbc->dbname)) return "Error: database is not set";
	$db=new mysqli($dbc->host,$dbc->user,$dbc->pass,$dbc->dbname);
	if ($db->connect_error) return "Connection failed: " . $conn->connect_error;
	return true;
}

function open_database($host,$user,$pass,$dbname)
{
	close_database();
	global $db;
	$db=new mysqli($dbc->host,$dbc->user,$dbc->pass,$dbc->dbname);
	if ($db->connect_error) return "Connection failed: " . $conn->connect_error;
	return true;
}

function close_database()
{
	global $db;
	$db->close();
}

function query_database($sql)
{
	global $db;
	return $db->query($sql);
}

function print_warning($msg)
{
	echo $msg."<br>";
}

function get_json_file($file)
{
	if(!file_exists($file)) file_put_contents($file, "{}");
	return json_decode(file_get_contents($file),true);
}

function _change_database_credentials($host,$user,$pass,$dbname)
{
	global $database_credentials;
	global $resources;
	$database_credentials['host']=$host;
	$database_credentials['user']=$user;
	$database_credentials['pass']=$pass;
	$database_credentials['dbname']=$dbname;

	$resources['db_cred']=$database_credentials;
}

function set_database_credentials($host,$user,$pass,$dbname)
{
	close_database();
	_change_database_credentials($host,$user,$pass,$dbname)
	return open_database();
}

function clear_database_credentials()
{
	close_database();
	_change_database_credentials(null,null,null,null);
}

?>