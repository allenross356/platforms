<?php
	
function _get_url(){ return "<TODO>";}

$connection = ssh2_connect("localhost", 8080);
if(ssh2_auth_password($connection, "root", "")){
echo "connection is authenticated";
}
else{
echo "failed!";
}


	function sign_in_and_fetch()
	{

	}

	function check_for_updates()
	{

	}

	function update_package()
	{
		//check for updates
		//if updates are available, 
			//download
			//unzip
			//execute
	}

?>