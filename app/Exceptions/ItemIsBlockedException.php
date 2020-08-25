<?php

namespace App\Exceptions;

class ItemIsBlockedException extends BaseException
{
    private $class;
    private $id;

    public function __construct(string $class, int $id)
    {
        parent::__construct(__CLASS__);

        $this->class = $class;
        $this->id = $id;

        $path = explode('\\', $class);
        $this->entity = end($path);
    }

    public function getDetails()
    {
        return [
            'entity' => $this->entity,
            'id' => $this->id
        ];
    }
}
