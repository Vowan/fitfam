# SETUP
##1. Create your development environment
1. copy the file named "wp-config.php.org" into "wp-config.development.php"
2. setup the correct database in that new file (your local database)

##2. Create your own domain
1. go to your hosts file (normally under /etc/hosts) and add the entry "127.0.0.1	fitfam.dev" to it
2. make a new vhost entry into your XAMPP folder (or whatever you use) that points to the above domain