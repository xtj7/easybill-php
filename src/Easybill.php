<?php

namespace YayDigital\Easybill;

class Easybill
{
    public function __construct($apiKey = null)
    {
        $this->apiKey = $apiKey;
    }

    public static function make($apiKey = null)
    {
        return new static($apiKey);
    }

    public function __call($method, array $parameters = [])
    {
        return $this->getApiInstance($method);
    }

    protected function getApiInstance($method)
    {
        $class = "\\YayDigital\\Easybill\\Api\\" . ucwords($method);

        if (class_exists($class)) {
            return new $class($this->apiKey);
        }

        throw new \BadMethodCallException("Undefined method [{$method}] called.");
    }

}