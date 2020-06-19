<?php

namespace App\Service;

use Exception;

abstract class ServiceProxy
{
    public function __call(string $method, array $arguments)
    {
        if (! method_exists($this, $method)) {
            throw new Exception('Call to undefined method ' . get_class($this) . ':' . $method. '()');
        }
        try {
            return call_user_func_array(array($this, $method), $arguments);
        } catch (\Exception $exception) {
            $reporter = $this->reporter();
            if (is_string($reporter)) {
                $reporter = new $reporter();
            }
            $reporter->$method($exception);
        }
    }

    /**
     * @return string|Reporter
     */
    abstract protected function reporter();
}
