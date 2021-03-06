<?php
class object
{
	//<TODO>
}

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

class trigger
{
	//<TODO>
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

public $users=[];
public $objects=[];
public $attributes=[];
public $actions=[];
public $triggers=[];
public $features=[];
public $views=[];

public $is_debug_mode=true;
public $resources=[];
public $database_credentials=[];
public $db;

function _compiler($attr) {switch ($attr){case 'name': return "aftermath";}}
function _resources($attr) {$n="resources";	switch($attr){	
	case 'folder': 	return "./$n";	
	case 'file': 	return _resources('folder')."/$n.json";	}}

function _connect() {return "connect";}
function _create() {return "define";}
function _user() {return "user";}
function _object() {return "object";}
function _attribute($attr) {$n='attribute'; 	switch($attr){	
	case 'name': 		return $n;	
	case 'plural': 		return $n.'s';	
	case 'path': 		return $_resources('folder')."/"._attribute('plural'); 
	case 'filename': 	return "$n.php";} }
function _action($attr=null,$type=null) { if($attr==null && $type==null) return 'action';
	$a=['create'=>'create','delete'=>'delete','edit'=>'edit','read'=>'read','mark'=>'mark','unmark'=>'unmark'];
	switch ($attr){ 
		case 'type': return $a[$type];
		case 'all_types': return $a; }} 	//create, delete, edit, read, mark, unmark
function _trigger() {return "trigger";}
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
	global $is_debug_mode;
	if($is_debug_mode)
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