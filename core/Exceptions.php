<?php

class UserInterrException extends Exception
{

    private $reason;

    public function __construct($reason = "undefined", $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->reason = $reason;
    }

    public function getReason()
    {
        return $this->reason;
    }
}
