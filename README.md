## Установка:
```
git clone https://github.com/dev2winners/ali-post-product-schema.git prod-test

cd prod-test

composer install

php artisan key:generate
```
переименовать *.env.example* в *.env*, далее в файле *.env* 

поменять значение *APP_URL* или оставить, если у вас такое же

добавить в любое место *.env* переменные, заменить значения xxxxx на свои (БЕЗ кавычек)
```
ALI_APP_KEY=xxxxx
ALI_SECRET_KEY=xxxxx
ALI_SESSION_KEY=xxxxx
```
## Что делает обрабочик на данный момент.

1. Принимает по адресу *https://YOUR_URL/api/v1/ali/product/post-schema* POST-запрос, содержащий в теле три значения в формате JSON, рабочий пример:
```
{
    "category_id": 200004218,
    "title": "Заголовок",
    "description": "Описание"
}
```
2. Подставляет эти значения в заранее подготовленную JSON-строку запроса.

3. Отправляет эту строку на сервер Aliexpress в виде запроса к их API.

4. Получает ответ от Aliexpress и возвращает его вам в Postman.

Сейчас ответ выглядит примерно так:
```
{"code":"15","msg":"Remote service error","sub_code":"F00-00-10020-002","sub_msg":"#\/shipping_template_id: #: 0
subschemas matched instead of one","request_id":"lptiptvfdric"}
```
Это, скорее всего, потому, что не настроены шаблоны доставки в самом маркете. А у меня доступа туда нет.

Еще надо обсудить нюансы нашего API, ибо есть вопросы к потребностям проекта в целом, под которые придется все это подгонять.
