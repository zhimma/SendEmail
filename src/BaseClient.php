<?php
/**
 * Description of this file
 *
 * @author  maxiongfei <maxiongfei@vchangyi.com>
 * @date    2018/11/8 10:39 AM
 */

namespace Zhimma\SendEmail;


use GuzzleHttp\Exception\RequestException;
use Zhimma\SendEmail\Traits\Http;

class BaseClient
{
    use Http;
    const BASE_URI = 'http://api.sendcloud.net/apiv2/';

    public function request(string $url, array $params = [], string $method = 'POST', array $configs = [], string $contentType = 'form_params')
    {
        $params = strtoupper($method) == 'GET' ? ['query' => $params] : [$contentType => $params];

        try {
            $request = $this->http->request($method, $url, $params);
        } catch (RequestException $e) {
            $errorCode    = $e->getCode();
            $errorMessage = $e->getMessage();

            return $this->error($errorCode, $errorMessage);
        }

        $httpCode = $request->getStatusCode();
        $return   = $request->getBody()->getContents();
        $response = json_decode($return, true);
        $httpCode == 200 ? 'success' : 'error';


        if ($httpCode != 200) {
            $this->error($httpCode);
        }

        return $this->success($response);
    }

    function dd($data, $break = 1, $type = 0)
    {
        echo '<pre>';
        !empty($type) ? var_dump($data) : print_r($data);
        !empty($break) && exit();
    }

    function success($response)
    {
        return [
            'success' => true,
            'data'    => $response
        ];
    }

    function error($httpCode = 500, $errorMessage = '')
    {
        return [
            'success'      => false,
            'errorCode'    => $httpCode,
            'errorMessage' => $errorMessage,
        ];
    }
}