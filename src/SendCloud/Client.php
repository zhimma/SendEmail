<?php
/**
 * Description of this file
 *
 * @author  maxiongfei <maxiongfei@vchangyi.com>
 * @date    2018/11/7 5:33 PM
 */

namespace Zhimma\SendEmail\SendCloud;

use Pimple\Container;
use Zhimma\SendEmail\BaseClient;

class Client extends BaseClient
{
    protected $config;

    public function __construct(Container $app)
    {
        parent::__construct();
        $this->config = $app['config'];
    }

    public function send($params = [])
    {
        if (empty($params)) {
            return $this->error('10010', '参数不完整');
        }
        return $this->request('mail/send', array_merge($this->config, $params), 'POST');
    }

    public function sendWithTemplate($params = [])
    {
        if (empty($params)) {
            return $this->error('10010', '参数不完整');
        }
        return $this->request('mail/sendtemplate', array_merge($this->config, $params), 'POST');
    }
}