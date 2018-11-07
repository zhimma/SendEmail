<?php
/**
 * Description of this file
 *
 * @author  maxiongfei <maxiongfei@vchangyi.com>
 * @date    2018/11/7 5:34 PM
 */

namespace Zhimma\SendEmail\SendCloud;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['send_cloud'] = function ($app) {
            return new Client($app);
        };
    }
}