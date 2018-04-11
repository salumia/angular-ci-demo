System Requirements
===================
-> NPM latest version
-> angular 4 environment

Guidelines to run this project demo
===================================
Step-1 : - Take a clone on local
Step-2 : - import database (blog.sql) on localhost
Step-3 : - Change base url in backend/application/config/config.php
Step-4 : - Change database connection settings in backend/application/config/database.php
Step-5 : - Change BASE_URL for rest apis in /front/src/app/services/common.service
	for eq.    BASE_URL = 'http://localhost/angular-ci-demo/backend/index.php/';
	
Now 
->Open CMD
->Go to project folder	
	for eq. cd http://localhost/angular-ci-demo/front
->Run command
	ng serve --o

now, you can test demo at http://localhost:4200/	
	
Thats It

Thanks
