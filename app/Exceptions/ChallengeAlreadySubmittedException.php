<?php

namespace App\Exceptions;

class ChallengeAlreadySubmittedException extends BaseException
{
    private $class;
    private $entity;

    public function __construct(string $class)
    {
        parent::__construct(__class__);

        $this->class = $class;

        $path = explode('\\', $class);
        $this->entity = end($path);
    }

    public function getDetails()
    {
        return [
            'entity' => $this->entity,
        ];
    }

    public function getClass()
    {
        return $this->class;
    }
}
