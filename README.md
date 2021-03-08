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

1. Принимает по адресу 

*https://YOUR_URL/api/v1/ali/product/post-schema* 

POST-запрос, содержащий в теле строку - объект JSON, описывающий продукт в формате product schema из документации к Ali API: *https://developers.aliexpress.com/en/doc.htm?docId=109760&docType=1*

Образец:

```
{
    "category_id": 200004218,
    "title_multi_language_list": [
        {
            "locale": "ru_RU",
            "title": "Тестовый продукт 1"
        }
    ],
    "description_multi_language_list": [
        {
            "locale": "ru_RU",
            "module_list": [
                {
                    "type": "html",
                    "html": {
                        "content": "Описание тестового продукта 1"
                    }
                }
            ]
        }
    ],
    "locale": "ru_RU",
    "product_units_type": "100000015",
    "image_url_list": [
        "https://upload.wikimedia.org/wikipedia/commons/b/ba/E-SENS_architecture.jpg"
    ],
    "category_attributes": {
        "BrandName": {
            "value": "200010868"
        },
        "ShirtsType": {
            "value": "200001208"
        },
        "Material": {
            "value": [
                "567"
            ]
        },
        "SleeveLength(cm)": {
            "value": "200001500"
        }
    },
    "sku_info_list": [
        {
            "sku_code": "WEO19293829123",
            "inventory": 3,
            "price": 9900,
            "discount_price": 9800,
            "sku_attributes": {
                "Size": {
                    "alias": "Uni",
                    "value": "200003528"
                }
            }
        }
    ],
    "inventory_deduction_strategy": "payment_success_deduct",
    "package_weight": 1.5,
    "package_length": 10,
    "package_height": 20,
    "package_width": 30,
    "shipping_preparation_time": 3,
    "shipping_template_id": 1000,
    "service_template_id": "0"
}
```

2. Используя SDK от Ali, отправляет эту JSON-строку, вместе с авторизационными данными, на сервер Aliexpress в виде запроса к API, для размещения товара в маркете.

3. Получает ответ от Aliexpress и возвращает его клиенту.

Сейчас ответ выглядит примерно так:
```
{"code":"15","msg":"Remote service error","sub_code":"F00-00-10020-002","sub_msg":"#\/shipping_template_id: #: 0
subschemas matched instead of one","request_id":"lptiptvfdric"}
```
Это, скорее всего, потому, что не настроены шаблоны доставки в самом маркете. А у меня доступа туда нет. 
