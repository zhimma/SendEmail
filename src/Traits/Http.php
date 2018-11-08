<?php
/**
 * Description of this file
 *
 * @author  maxiongfei <maxiongfei@vchangyi.com>
 * @date    2018/11/8 10:22 AM
 */

namespace Zhimma\SendEmail\Traits;


use GuzzleHttp\Client;

trait Http
{
    protected $http;

    public function __construct()
    {
        $this->http = new Client(['base_uri' => self::BASE_URI]);
    }


}