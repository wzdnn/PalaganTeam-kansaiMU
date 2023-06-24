<?php

namespace PalaganTeam\MuhKansai\Model\User;
class UserLoginRequest{
    public ?string $email = null;
    public ?string $password = null;
    public bool $remember = false;
}