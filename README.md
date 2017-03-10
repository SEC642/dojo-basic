Dependencies on Debian/Ubuntu:

    apt-get install apache2 mariadb-server php-mysqli git

You must also create a database in mysql:

    mysql -u root -p
    create database dojo_basic;
    create user 'dojo_basic'@'localhost' identified by 'letmein';
    grant all on dojo_basic.* to 'dojo_basic'@'localhost';
    exit

Copy/extract all the dojo-basic files into your web root

    cd /var/www/html
    rm /var/www/index.html
    git clone https://github.com/meeas/dojo-basic.git ./

Fix the permissions for the snake game:

    chmod a+w snake/*.txt

Make sure the database credentials are correct in config.inc

    nano config.inc

Open a browser and visit http://localhost/reset-db.php or the correct IP address if doing this on a remote machine.

If that is successful, then go to http://localhost

Enjoy!
