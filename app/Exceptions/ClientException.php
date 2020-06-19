<?php

namespace App\Exceptions;

use Exception;

class ClientException extends Exception
{
    protected Exception $exception;

    protected int $status;

    protected string $type;

    protected string $title;

    protected array $details;

    public function __construct(Exception $exception, int $status, string $type, string $title, array $details = [])
    {
        parent::__construct($exception->getMessage());
        $this->exception = $exception;
        $this->status = $status;
        $this->type = $type;
        $this->title = $title;
        $this->details = $details;

        if($type == ErrorType::UNKNOWN) {
            $this->details['message'] = $exception->getMessage();
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'status' => $this->status,
            'type' => $this->type,
            'title' => $this->title,
            'details' => (object)$this->details
        ];
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->status;
    }

    /**
     * @return Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @return Exception
     */
    public function getType()
    {
        return $this->exception;
    }
}
