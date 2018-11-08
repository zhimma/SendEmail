<?php
/**
 * Description of this file
 *
 * @author  maxiongfei <maxiongfei@vchangyi.com>
 * @date    2018/11/7 5:31 PM
 */

namespace Zhimma\SendEmail;


use Pimple\Container;
use Zhimma\SendEmail\SendCloud\ServiceProvider;

class Application extends Container
{
    protected $providers = [
        ServiceProvider::class
    ];

    protected $config;

    public function __construct(array $config = [])
    {
        parent::__construct();
        $this->registerProviders($this->providers);
        $this['config']     = $config;

    }

    public function addProvider($provider)
    {
        array_push($this->providers, $provider);

        return $this;
    }

    public function setProviders($providers)
    {
        $this->providers = [];

        foreach ($providers as $provider) {
            $this->addProvider($provider);
        }
    }

    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * Magic get access.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * Magic set access.
     *
     * @param string $id
     * @param mixed  $value
     */
    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }


    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }
}