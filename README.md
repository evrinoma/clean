#console command
php bin/console app:e:p --handler=dummy --description=fixer

#debug
ssh -R 9003:172.20.8.178:9003 root@php80.clean

export XDEBUG_CONFIG="mode=debug client_host=172.28.1.243 client_port=9003 start_with_request=yes"

cd /opt/WWW/container.ite-ng.ru/projects/nginx/clean.php80/

#test
/usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap tests/bootstrap.php --configuration phpunit.xml.dist tests/Functional/Controller/
