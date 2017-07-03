Overview of the project:
This is a web service to add journals of different places you visited during your trips. It can be used only on logging into the service with a registered account. Upon logging in there will be a dashboard page where it displays your account information and also 2 links - to add journals based on markers on a map , to view the public journals available in the database for a given location.


Database And Tables used in the service:
Only one database 'weatherjournal' is used on mysql. This has 2 tables - 1)peoplelist : used for storing th info of registered students
2)journal : used for storing the data journals of different locations along with their latitudes and longitudes. These 2 tables have the following fields:

table peoplelist: 
A)FirstName - Varchar(100)
B)LastName - Varchar(100)
C)Username - Varchar(25) {Primary Key}
D)Password - Varchar(150)

table journal:
A)Location  - Varchar(100)
B)Journal - Text
c)Status - Varchar(25){default: public}
D)Date - date {primary key}
E)Latitude - Double
F)Longitude - Double

Build instructions For Setting up the Wamp server to make it work:
1)Clone the github repository to a local folder on your computer.
2)install WAMP server and set it up using instructions from the link:
https://make.wordpress.org/core/handbook/tutorials/installing-a-local-server/wampserver/
3)Make sure that before you install the WAMP server you download and install Microsoft c++ redistributable files upto year 2015,both 32 and 64 bit versions, otherwise upon installation the WAMP server will not load. Also after installing make sure Apps like Skype are closed else all the services of the server will not work as it does have a port previously occupied by ,say Skype.
4)go the installation directory/www folder/. create a new folder and name it anything.(say backendtask).Open the folder and paste the html and php files of the repository inside this.
5)Open the web browser used in installing the WAMP server, go to localhost/phpmyadmin/ and login using the username 'root' with no password.Click on the Database and create a new database called 'weatherjournal'. Inside it, create the 2 tables mentioned above.



6)Once the required sql tables have been created open the browser and go to : localhost/backendtask/reviewjournal.php and follow the links and instructions given further to register yourself and login.

Screenshots of the different pages are:

![](/screenshots/loginpage.png)
![](/screenshots/dashboard.png)
![](/screenshots/addjounal.png)
![](/screenshots/reviewjounal.png)
![](/screenshots/signuppage.png)
![](/screenshots/tablejournal.png)
![](/screenshots/tablepeoplelist.png)

