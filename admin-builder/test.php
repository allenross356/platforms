<?php

	//types of attributes int,float,string,user-defined,mix.. array keyword can be appended after any attribute type
		//if type of attribute is not defined 
	//difference between mark and insert-action .. is same as mutex and semaphore.. mark action can hold only 1,unique record of its kind while insert-action can hold only multiple record.
	//'on' and 'to' are interchangeable.. these keywords also act as separator.. any words that are not defined in the compiler act as separators
	//create attribute/user/action type
	//create user 	- create single user
	//create view
	//any name of type or attribute can hold alphabets, numbers, -, _ and start can start with alphabet or - or _.. on compilation, all '-' characters will converted to "_" with default compiler setting.. however compiler setting can changed to treat '-' to mark capitalization in which case case a variable name/type/attribute insert-record will change insertRecord on compilation.. compiler setting can set to treat the starting '-' character and middle '-' for example insert-record will convert to insertRecord but -record will convert to _record.. 
	//: denotes begin of multi line command.. each : must be followed by ; in subsequent line.. ; denotes end of multi line command
	//'define as' denotes begin pointer to function
	//start and end keywords
	//view 

	//database
	connect to database my-database on host localhost with user root and pass null
	connect database freelancer-project host ftp.wantro.com user wantro pass wantro123

	//attribute sample:
	create attribute state(string) with possible values(running,pause,stop) with current value(stop)
	create attribute skills(string) with some possible values(js,php,c++,android,ios)
	create attribute name(string) with value(Allen)		//current is added by default before 'value' or 'values'
	create attribute currency(string) with some possible values(usd,cad,gbp,aud,inr)
	create attribute balance with attributes(int,currency) amount,currency
		//Later add:
		//- subset
		//- superset
		//- extends
			//- handling of multiple of subset/superset/extends

	//user sample:
	create user user with attributes(string,string,password) name,email,pass
	create user admin with attribute(string,password) email,pass with values(allenross653@gmail.com,mypass)	//possible is added by default before 'value' or 'values'
	create user client extends user with attributes(datetime) dob
	create user freelancer extends user
		//Later add:
		//- handling of multiple extends



	//project sample:
	create attribute currency(string) possible values(USD,INR,CAD,GBP,AUD)
	create attribute budget-range with attributes(int,int) min,max
	create attribute balance with attributes(int,currency) amount,currency	
	create attribute skills(string array) possible values(c++,js,php,python,android,ios)
	create attribute usd-budget-range with attributes(int,int) min,max possible values((5,30),(30,60),(60,100),(100,200),(200,400),(400,800),(800,1500),(1500,2500),(2500,5000),(5000,10000),(10000,20000))
	
	create user user with attributes(string,string,string,balance) name,email,pass,balance
	create user client extends user
	create user freelancer extends user
	create single user admin with attributes(string,string) email,pass
	
	
	create action register by user define as usual register
		//OR create action type register by user define usual register
		//OR create action type register by user usual register
	create action login by user define as usual login
	
	//optional
	start feature projects-and-bidding(client,freelancer) 
	//end optional
	create object project with attributes(string,string,budget-range,currency,skills,string) title,description,budget-range,currency,skills,attachments,additional-info
	
	create action create-project by client on project define as usual insert-record
	create action destroy-project by client on own project define as usual delete-record
	create action view-project by client on own project define as select-record
	
	create action view-project by freelancer on project define as usual select-record
	create action bid by freelancer on project define as usual mark(string,int,int) proposal,amount,days
	create action revoke-bid by own freelancer on project define as usual unmark
	
	create action award by client on own project to owner of bid define as usual mark
		//OR create action award by client on own project on owner of bid definition usual mark
	create action revoke-award by client on own award define as usual unmark
		//OR create action revoke-award by client on own award usual delete-action
	
	create action accept by freelancer on own bid on award define as usual mark
	create action reject by freelancer on own bid on award define as usual unmark award
	//optional
	feature end
	//end optional
	
	//<TODO>
	activate feature usual send-message between client and freelancer with conditions:
		//OR create action send-message between user and user on conditions:
	(
		if from user is client and to user is freelancer and (to user place bid on from user project)
			//OR if from user is client and to user is freelancer and (to user bid on from user project)
		or
		if 
	)
	define as usual send-message;
	create action fetch-messages by user 
	//end <TODO>
	
	
	
	
	
	
	
	start init view
	logo=../images/logo.png
	title=Better Than Freelancer
	init end
	
	create view register with url ~/register with function usual register(user, url ~/,load view choose-type)
	create view login with url ~/login with function usual login(user, url ~/, load view choose-type)
	create view logut with url ~/logout with function usual logout
	
	create view choose-type with url ./select-type with function set 		//<TODO>

	create view client-register with url ~/register/client with function usual register(client, user ~/client, load view client-panel)
	create view client-login with url ~/login/client with function usual login(client, user ~/client, load view client-panel)

	create view freelancer-register with url ~/register/freelancer with function usual register(freelancer /*<TODO>*/)
	create view freelancer-login with url ~/login/freelancer with function usual login(freelancer /*<TODO>*/)
	
	create view home with url ./home with function load file home.html
	create view about with url ./about with function load file about.html
	create view contact with url ./contact with function load file contact.html
	create view legal with url ./legal with function load file legal.html
	
	create view client-panel for client with url ./panel/ with function:
	(	
		for large laptop:
		broad horizontal header header on top with full width with logo and title
		fixed narrow horizontal navigation top-navigation under header with full width with:
			Home(load view home in main)
			About Us(load view about in main)
			Contact Us(load view contact in main)
			Legal(load view legal in main);
		fixed narrow vertical navigation side-nav under horizontal navigation on left with full height with:
			Projects(load view client-projects in main)
			Messages(load view client-messages in main)
			Freelancers(load view search-freelancers in main)
			Balance(load view client-balance in main)
			History(load view client-history in main)
			Log Out(load view logout);
		fixed narrow vertical panel side-bar under horizontal navigation on right with full height with:
			;
		big panel main under horizontal navigation in center
		;
		
		for small laptop:;
		
		for tablet:;
		
		for phone:;
	)
	;
	create view client-projects
	create view client-messages
	create view search-freelancers
	create view client-balance
	create view client-history


	create web-app for php/laravel
	create web-app for php
	create web-app for python/django
	create mobile-app for android with web-app
	create mobile-app for ios with mobile-app android
	create software-app for windows with web-app
	create software-app for linux with web-app
	create software-app for mac with web-app

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//syntax
	create <create 

	//create
	create attribute type
	create object type
	create user type
	create action type
	create view type

	create attribute 
	create object 
	create user 
	create action 
	create view 

	
	
	start
	
	namespace
	
	activate
	
?>