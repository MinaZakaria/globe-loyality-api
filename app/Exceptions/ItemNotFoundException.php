<?php

namespace App\Exceptions;

class ItemNotFoundException extends BaseException
{
    private $id;
    private $class;
    private $entity;

    public function __construct(string $class, int $id = null)
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

    public function getClass()
    {
        return $this->class;
    }
}
