<?php

namespace App\Exceptions;

class EmailNotVerifiedException extends BaseException
{
    private $details;

    public function __construct(array $details = [])
    {
        parent::__construct(__CLASS__);

        $this->details = $details;
    }

    public function getDetails()
    {
        return $this->details;
    }
}
