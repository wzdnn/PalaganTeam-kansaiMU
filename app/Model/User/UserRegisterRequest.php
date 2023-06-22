<?php

namespace PalaganTeam\MuhKansai\Model\User;
class UserRegisterRequest{
    public ?string $fullname = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?string $rePassword = null;
}