<?php

namespace App\Http\Controllers\API\Ali;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductPostSchemaController extends Controller
{
    /**
     * post - принимает объект Request, делает запрос на размещение продукта на Ali, возвращает ответ Ali
     *
     * @param  object Request
     * @return string
     */
    public function post(Request $request)
    {
        $c = new \Ali\top\TopClient();
        $c->appkey = getenv('ALI_APP_KEY');
        $c->secretKey = getenv('ALI_SECRET_KEY');
        $req = new \Ali\top\request\AliexpressSolutionSchemaProductInstancePostRequest();
        $req->setProductInstanceRequest($this->setSchema($request));
        $resp = $c->execute($req, getenv('ALI_SESSION_KEY'));

        return json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    /**
     * getSchema - принимает объект Request, формирует и возвращает строку JSON-запроса с product schema
     *
     * @param  object Request
     * @return string
     */
    public function setSchema($request)
    {
        $request_body = $request->getContent();
        return $request_body;
    }
}
