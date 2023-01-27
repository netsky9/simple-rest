### Аннотация
В данном сервисе пришлось сделать некоторые упущения, в целях экономии времени.
Например, реализация авторизации пользователя, проверки прав доступа для каждой группы пользователей, 
а также реализация dev, prod конфигов и т д. Библиотеки, использованные в данном сервисе не являются идеальными, это скорее то, что первое попалось 
под руку, т к в основном, при разработке, я отдаю предпочтение фреймворкам и их стандартным пакетам.

### Инструкция по запуску
* Настроить docker-compose.yml под свою машину
* make build
* make up
* make bash
* composer install
* получить Api key (Пример запроса в прикрепленном фале для Postman)