<?php
/**
 * Created by PhpStorm.
 * User: Maxowar
 * Date: 17/07/2017
 * Time: 23:20
 */

namespace Ssh\Authentication;


use Ssh\Connection;

interface AuthenticationMethod
{
    public function authenticate(Connection $connection);
}