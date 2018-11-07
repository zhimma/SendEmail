<?php
/**
 * Description of this file
 *
 * @author  maxiongfei <maxiongfei@vchangyi.com>
 * @date    2018/11/7 5:33 PM
 */

namespace Zhimma\SendEmail\SendCloud;

use Pimple\Container;

class Client
{
    protected $config;

    public function __construct(Container $app)
    {
        $this->config = $app['config'];
    }

    public function send()
    {
        var_dump($this->config);
    }
}