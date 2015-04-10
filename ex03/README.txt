STEFAN's Readme:

1.) Install XAMPP and run mysql
2.) Create database

$ mysql -u root 
> create user larajade@localhost;
> create database larajade;
> grant all privileges on larajade.* to larajade@localhost;

$ mysql -u larajade larajade < we2015.adjusted.sql

3.) Create symlink to repo htdocs:

go to the htdocs directory of your xampp installation and

$ ln -s /path/to/repo/ex03/htdocs larajade

IMPORTANT: make sure that directories on /path/to/repo are at least READABLE by the webserver.

The new website should now be accessible through http://localhost/larajade


The other guys' Readme:

This WordPress database assumes the website is located in the folder we2015/ and should be accessed from the relative URL: /we2015
It also assumes your database is called we2015

Example: If you install WordPress in http://localhost, this database has been created to work with the URL:  http://localhost/we2015/

We advise you to use XAMPP for the webserver and mysql for the db (that is already included in XAMPP).

Therefore, you are advised to follow the following steps:

1) Download WordPress here: https://wordpress.org/ (it is a zip file)

2) Create a folder with the name we2015 (in your webserver directory, /htdocs if you use XAMPP).

3) Unzip WordPress inside this folder.

4) Create a database with the name we2015 

5) Import in this database our database (that it is inside the base folder we gave you)

6) Open the wp-config-sample.php file and change the DB_USER and DB_PASSWORD settings using the username and the password of the user in your database

7) Copy the folders:
	wp-content/uploads/ 
        wp-content/themes/ 
   From the "base" we gave you, in your we2015 wp installation
8) Access to the url :/we2015 

9) Complete the WordPress installation 

10) Access to your theme with the following credentials
User: admin
Pass: admin

11) Start with the exercise!
