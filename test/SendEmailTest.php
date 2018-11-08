<?php
/**
 * Description of this file
 *
 * @author  maxiongfei <maxiongfei@vchangyi.com>
 * @date    2018/11/8 9:36 AM
 */

require_once "../vendor/autoload.php";

use Zhimma\SendEmail;
use Zhimma\SendEmail\Application;

class SendEmailTest
{
    protected $app;

    public function __construct(Application $application)
    {
        $this->app = $application['send_cloud'];
    }

    public function send()
    {
        $params = [
            'to'      => "maxiongfei@vchangyi.com",
            'subject' => '这是标题',
            'html'    => '这是一段正文'
        ];
        $this->app->send($params);
    }

    public function sendWithTemplate()
    {
        $xsmtpapi = [
            'to'  =>
                ['maxiongfei@vchangyi.com'],
            'sub' =>
                [
                    '%date%'    =>
                        ['20181111'],
                    '%status%'  =>
                        ['success'],
                    '%content%' =>
                        ['this is content'],
                ],
        ];

        $params = [
            'xsmtpapi'           => json_encode($xsmtpapi),
            'subject'            => '这是标题',
            'contentSummary'     => '正文摘要',
            'templateInvokeName' => 'sftp_process_result',
        ];
        print_r($this->app->sendWithTemplate($params));
    }

}

$config = [
    'apiUser' => "xxxx",
    'apiKey'  => "xxxx",
    'from'    => "admin@zhimma.com",
    'to'      => ""
];

(new SendEmailTest(new SendEmail\Application($config)))->sendWithTemplate();