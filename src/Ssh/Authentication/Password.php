<?php
/**
 * Created by PhpStorm.
 * User: Maxowar
 * Date: 17/07/2017
 * Time: 23:26
 */

namespace Ssh\Authentication;


use Ssh\Connection;

class Password implements AuthenticationMethod
{
    private $username;

    private $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticate(Connection $connection)
    {
        ssh2_auth_password($connection->getResource(), $this->username, $this->password);
    }
}