# phpContestLogger - Ohio State Parks on the Air (OSPOTA)
PHP based Logging Software for the Ohio State Parks on the Air (OSPOTA) Amatuer Radio Contest

---

The Ohio State Parks on the Air (OSPOTA) Amatuer Radio contest was conceived with three main goals in mind:

- To promote public awareness of amateur radio and Ohio’s beautiful state parks system;
- To contribute to the recognition that Ohio has a very diverse and wonderful ecology;
- To promote camaraderie within the ranks of Ohio’s Amateur Radio Operators

(From the OSPOTA website at [http://ospota.org/](http://ospota.org/))

This is an annual contest held every year on the first Saturday after Labor Day in September.

---

## Features 
* No Frills, lightweight, simple text based logging system.
* Shows park name, WWFF ID and POTA ID on screen
* Dashboard for use on another screen to allow others to see progress.
* Shows band limits based on license class to make staying in band easier.
* Shows Exchange right on the screen.
* Exports log to Cabrillo format for easy submission.

---

## Description
While there are a number of logging options out there, this program was concieved as 
- an OS agnostic software solution. 
- lightweight and portable server based system

Many people like to bring thier own computer or tablet to log on during a contest like this and many Amatuer Radio groups don't have the means to provide computers for everyone to log on. 

Since there are many different OS's for computers and tablets, creating a php/browser based application eliminates the "Oh I don't have Windows/Mac/Linux" problem. By accessing the application in a webbrowser, any OS can be used. Windows, Mac, Linux, Android, iOS.... as long as you have a web browser installed on the device, you can use the logging program. 

The application was designed with portability in mind. It was designed as a no frills, lightweight system to facilitate use in the field with no access to the internet.

It was also designed to be installed on a central webserver for the site so that multiple stations can use the same software for the group and see all the logging. But it can also be run on one computer in a local webserver if there is just one computer doing logging.

### Use Cases
* If you are lucky enough to have a full server for centralized logging in the park, this can be installed there. If you are even more lucky to have internet access, you could install this in the cloud and run from there.
* Install on your laptop and run right from there. No need for another server install if you are not doing multiple logging stations.
* Install on a Raspberry Pi for use as a logging computer or even a site logging server. With it's small foot print and economic power consumption, the Raspberry Pi makes a great field computer.

---

## Getting Started

This application can be run either on a regular webserver/databse server setup or it can be run in Docker. To run in Docker, please visit [https://hub.docker.com/r/n8acl/ospotalog](https://hub.docker.com/r/n8acl/ospotalog)

To run on a regular webserver, follow these directions:

First make sure you have a webserver like Apache, nginx or IIS installed, install PHP and install MySQL. When installing PHP, make sure you also enable the mysqli library.

The directions included here are for Linux. If you are running this on a different OS, you will need to install applications based on the OS.

You will need to install git to clone the repo for all the files.

```bash
sudo apt-get install git
```

Now clone the application right into the web document root for your webserver, or into a folder if on an existing webserver. The example below is for Apache. Change it to your web root folder.

Example:
```bash
git clone https://github.com/n8acl/ospotalog.git /var/www/html
```

Once the repo has been cloned or copied into the web root folder, you are ready to setup the application and run it.

---

## Starting the Program

First you will need to navigate to the database create script omn the first run of the software. If you do not do this first, the application will error out till the database is created. Once this process has been run the first time, there is no need to run it again unless you are moving the program or something. 

your-web-address/create.php

Once that page comes up, it is asking for the root password you setup for MySQL database and the user you would like the program to create for the logging program to work. You do not need to create this user before running this, you just need a user that can create databases on your MySQL server.

Once the database has been created, the page will be redirected to the main logging page. Also from this point forward, you can access the program by going to the URL you have setup for the application in a webrowser. Some examples:
* http://contest.log/ospota
* http://192.168.0.1
* http://localhost (on your local computer)

If you try to go to the main logging page before running the create script, you will get an error. So make sure to run the create first.

After the database is setup, enjoy logging in the contest.

For more details about installation and running the application, please see the docs folder.

---

## Contact Me
If you have questions, please feel free to reach out to me. You can reach me in one of the following ways:

- Twitter: @n8acl
- Telegram: @ravendos
- E-mail: n8acl@protonmail.com

If you reach out to me and have an error, please include what error you are getting and what you were doing. I may also ask you to send me certain files or screenshots to look at. Otherwise just reach out to me :).

---

## Change Log

* 08/30/2020 - Initial Release
* 09/21/2020 - Fixes for some glaring errors
    - Added ability ot edit contact after logging in case of a mistake.
    - Fixed the frequency privledges to show properly for band, mode and license class
    - Re-added the ability to select entry class on the settings page.

