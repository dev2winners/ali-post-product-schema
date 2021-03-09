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

Рабочий образец (успешно добавлен на Ali):

```
{
    "category_id": 348,
    "title_multi_language_list": [
        {
            "locale": "es_ES",
            "title": "a test product test test 001"
        }
    ],
    "description_multi_language_list": [
        {
            "locale": "es_ES",
            "module_list": [
                {
                    "type": "html",
                    "html": {
                        "content": "uno test test description 002"
                    }
                }
            ]
        }
    ],
    "locale": "es_ES",
    "product_units_type": "100000015",
    "image_url_list": [
        "https://upload.wikimedia.org/wikipedia/commons/b/ba/E-SENS_architecture.jpg"
    ],
    "category_attributes": {
        "Shirts Type": {
            "value": "200001208"
        },
        "Material": {
            "value": [
                "567"
            ]
        },
        "Sleeve Length(cm)": {
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
    "shipping_template_id": "729874672",
    "service_template_id": "0",
    "brand_name": "200010868"
}
```

2. Используя SDK от Ali, отправляет эту JSON-строку, вместе с авторизационными данными, на сервер Aliexpress в виде запроса к API, для размещения товара в маркете.

3. Получает ответ от Aliexpress и возвращает его клиенту.

Ответ выглядит так:
```
{"result":{"product_id":"1005002278016309"},"request_id":"5170wb545uuj"}
```
зная id продукта, мы дальше можем с ним делать что-то еще.

