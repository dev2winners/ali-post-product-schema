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
        $request_body_decoded = json_decode($request_body);
        $response_decoded = json_decode(file_get_contents(base_path() . '\misc\json\forPostSchema.json'));

        $response_decoded->category_id = $request_body_decoded->category_id;
        $response_decoded->title_multi_language_list[0]->title = $request_body_decoded->title;
        $response_decoded->description_multi_language_list[0]->module_list[0]->html->content = $request_body_decoded->description;

        return json_encode($response_decoded, JSON_UNESCAPED_UNICODE);
    }
}
