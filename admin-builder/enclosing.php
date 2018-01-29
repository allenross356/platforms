<?php

require_once("helpers.php");

function undo_execution()
{
	$res=get_json_file(_file_resources());
	if(isset(res->files))
		foreach(res->files as $file)
			if(!unlink($file)) 
				print_warning("Cannot delete file: $file");
	if(isset($res->db_cred) && $res->db_cred)
	{
		$host=$res->db_cred->host;
		$user=$res->db_cred->user;
		$pass=$res->db_cred->pass;
		$dbname=$res->db_cred->dbname;
		open_database($host,$user,$pass,$dbname);
	}
	if(isset(res->tables))
		foreach(res->tables as $table)
			if(query_database("drop table $table")!==true) 
				print_warning("Cannot delete table: $table");
	close_database();

}

function start_execution()
{
	undo_execution();
	//<TODO>
	//create resources/attribute.php

	//<TODO>
}

function finish_execution()
{
	//store data in resources/resources.txt
	//
	global $resources,$attributes,$database_credentials;

	$resources['db_cred']=$database_credentials;

	foreach($attributes as $name=>$attribute)
	{
		$file=_attribute('path')."/$name."._attribute('name').'.json';
		file_put_contents($file, json_encode($attribute));
		$resources['files'][]=$file;
	}

	//add tables to $resources
	//add all other data such as $users, $actions, $views, $features, etc to $resources

	file_put_contents(_resources('file'), json_encode($resources));
	close_database();
}



?>