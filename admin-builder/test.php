<?php

	//types of attributes int,float,string,user-defined,mix.. array keyword can be appended after any attribute type
		//if type of attribute is not defined 
	//difference between mark and insert-action .. is same as mutex and semaphore.. mark action can hold only 1,unique record of its kind while insert-action can hold only multiple record.
	//'on' and 'to' are interchangeable.. these keywords also act as separator.. any words that are not defined in the compiler act as separators
	//create attribute/user/action type
	//create view
	//any name of type or attribute can hold alphabets, numbers, -, _ and start can start with alphabet or - or _.. on compilation, all '-' characters will converted to "_" with default compiler setting.. however compiler setting can changed to treat '-' to mark capitalization in which case case a variable name/type/attribute insert-record will change insertRecord on compilation.. compiler setting can set to treat the starting '-' character and middle '-' for example insert-record will convert to insertRecord but -record will convert to _record.. 
	//: denotes begin of multi line command.. each : must be followed by ; in subsequent line.. ; denotes end of multi line command
	//'define as' denotes begin pointer to function
	//start and end keywords
	//view 

	
	
	create attribute type currency(string) possible values(USD,INR,CAD,GBP,AUD)
	create attribute type budget-range with attributes(int,int) min,max
	create attribute type balance with attributes(int,currency) amount,currency	
	create attribute type skills(string array) possible values(c++,js,php,python,android,ios)
	create attribute type usd-budget-range with attributes(int,int) min,max possible values((5,30),(30,60),(60,100),(100,200),(200,400),(400,800),(800,1500),(1500,2500),(2500,5000),(5000,10000),(10000,20000))
	
	create user type user with attributes(string,string,string,balance) name,email,pass,balance
	create user type client extends user
	create user type freelancer extends user
	create user admin with attributes(string,string) email,pass
	
	create object type project with attributes(string,string,budget-range,currency,skills,string) title,description,budget-range,currency,skills,attachments,additional-info
	
	create action type register by user define as usual register
		//OR create action type register by user define usual register
		//OR create action type register by user usual register
	create action type login by user define as usual login
	
	//optional
	start feature freelancer
	//end optional
	create action type create-project by client on project define as usual insert-record
	create action type destroy-project by client on own project define as usual delete-record
	create action type view-project by client on own project define as select-record
	
	create action type view-project by freelancer on project define as usual select-record
	create action type bid by freelancer on project define as usual mark(string,int,int) proposal,amount,days
	create action type revoke-bid by own freelance on project define as usual unmark
	
	create action type award by client on own project to owner of bid define as usual mark
		//OR create action type award by client on own project on owner of bid definition usual mark
	create action type revoke-award by client on own award define as usual unmark
		//OR create action type revoke-award by client on own award usual delete-action
	
	create action type accept by freelancer on own bid on award define as usual mark
	create action type reject by freelancer on own bid on award define as usual unmark award
	
	//optional
	feature end
	//end optional
	
	//<TODO>
	activate feature usual send-message between client and freelancer with conditions:
		//OR create action type send-message between user and user on conditions:
	(
		if from user is client and to user is freelancer and (to user place bid on from user project)
			//OR if from user is client and to user is freelancer and (to user bid on from user project)
		or
		if 
	)
	define as usual send-message;
	create action type fetch-messages by user 
	//end <TODO>
	
	
	
	start init view
	logo=../images/logo.png
	title=Better Than Freelancer
	init end
	
	create view register function usual register
	create view login function usual login
	create view search-projects
	
	
?>