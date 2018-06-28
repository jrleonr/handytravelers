<?php

namespace Handytravelers\Components\Users\Exceptions;

class UserEmailNotFoundException extends \Exception
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

}
