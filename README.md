1. внутри ssyp выполнить команду composer install
2. установить docker и docker-compose
3. внутри ssyp/.docker запустить контейнеры командой docker-compose up -d --build
4. также внутри ssyp/.docker зайти в контейнер командой docker-compose exec php-fpm sh
5. внутри контейнера ./vendor/bin/doctrine-migrations migrate для запуска миграций (создаст таблицы в базе данных)
6. в /etc/hosts добавить 127.0.0.1    ssyp.local
7. зайти в браузере в https://ssyp.local готово, вы великолепны!

3 пункт придётся делать каждый раз, чтобы сервер запустился, только тогда будет работать https://ssyp.local
для завершения работы контейнеров внутри ssyp/.docker надо сделать docker-compose down 