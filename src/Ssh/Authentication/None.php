<?php
/**
 * Created by PhpStorm.
 * User: Maxowar
 * Date: 17/07/2017
 * Time: 23:22
 */

namespace Ssh\Authentication;


use Ssh\Connection;

class None implements AuthenticationMethod
{
    private $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function authenticate(Connection $connection)
    {
        ssh2_auth_none($connection->getResource(), $this->username);
    }
}