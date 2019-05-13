Basic Needs :

Your system should contains following packages installed on your system

1. PHP : 5.x version
2. MYSQL database : 14.x or above 
3. Phpunit : 3.7.x version
4. Enable sendmail library in PHP
5. Also confirm that your server reads .htaccess file. Then only our routing will work.
6. Project will run on both Apache/Nginx server

Steps to setup project

1. Unzip the package 
2. Copy the directory named "source" to the root folder of your server and if you like you can rename this directory. lets say you renamed folder to "newsportal"
3. Another directory "DB_Backup" contains sql file which is dump of our db.
4. Create new database into your mysql. Lets say we named it as "newsportal"
5. Dump the above sql file into this database
6. To set your database configuration, open the config file from /newportal/application/config/database.php and do the needfull

This is all you can run project on your server/local machine with following url : http://DOMAIN-URL/newsportal

There are few more things that I can cover like :
1. For now, I had just created a common model because it is just a small project. But for huge project we can have individual as per each DB table
2. We can also add migration scripts but for now I didn't add it.
3. Can also introduced user types like admin & registered user.
4. Can improve front-end validations
5. We can also have "Comment" section below each news on description page.
6. There are lot we can improve at security level while flowing the data.
7. Move inline-css to a css file

Because of lake of time, I just tried to make this test app in working conditions. Thanks
