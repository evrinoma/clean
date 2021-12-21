
## Configuration

### docker compose
```yml
version: '2'
services:
    maria_db:
        container_name: "maria.db"
        image: "evrinoma/db.maria"
        build:
            context: docker/db/maria/10.3.27/.
            dockerfile: Dockerfile
        volumes:
            - "/opt/DISK/Develop/Docker/src/db/maria/:/var/lib/mysql"
            - "/opt/DISK/Develop/Docker/src/logs/mariadb/:/var/log/mariadb"
        networks:
            virt:
                ipv4_address: 172.18.2.1

    php80_hr:
        container_name: "php80.hr"
        image: "evrinoma/php80"
        environment:
            - ENGINE=nginx
            - DEPLOY=yes
            - SYMFONY=yes
            - MODE=dev
            - web_dir=/opt/WWW/container.ite-ng.ru/projects/nginx/hr/public
            - web_server=php80.hr
            - web_alias=hr
        volumes:
            - "/etc/localtime:/etc/localtime:ro"
            - "/opt/DISK/Develop/Docker/src/:/opt/WWW/container.ite-ng.ru/"
            - "/opt/DISK/Develop/PhpStorm/PhpstormProjects/:/opt/WWW/container.ite-ng.ru/PhpstormProjects/"
        networks:
            virt:
                ipv4_address: 172.18.80.40

networks:
    virt:
        driver: bridge
        ipam:
            driver: default
            config:
                - subnet: 172.18.0.0/16
                  gateway: 172.18.0.1
```
### sql
создание пользователя root с паролем 1234
```sql
CREATE USER 'hr'@'localhost' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON `hr` . * TO 'hr'@'localhost';
CREATE USER 'hr'@'172.18.0.0/255.255.0.0' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON `hr` . * TO 'hr'@'172.18.0.0/255.255.0.0';
FLUSH PRIVILEGES; 
 ```

### Добавить имя домена
```yml
 В файле /etc/hosts добавить алиас php80.hr для IP 172.18.80.40
 sed -i -e "/^172.18.80.40/ d" /etc/hosts && echo '172.18.80.40 php80.hr' >> /etc/hosts
 ```

### Сборка бэка
```console
/usr/bin/php bin/console d:d:c
/usr/bin/php bin/console d:s:c
/usr/bin/php bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json
/usr/bin/php bin/console fos:user:create user user@my.email pass --super-admin
/usr/bin/php bin/console evrinoma:menu:create
```

### web build


### debug
отладка
```text
ssh -R 9003:172.20.8.178:9003 root@php80.clean
export XDEBUG_CONFIG="mode=debug client_host=172.28.1.243 client_port=9003 start_with_request=yes"
cd /opt/WWW/container.ite-ng.ru/projects/nginx/hr/
```
### tests
```text
/usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap tests/bootstrap.php --configuration phpunit.xml.dist tests/Functional/Controller/
```

