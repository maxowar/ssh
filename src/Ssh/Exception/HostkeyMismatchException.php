<?php
/**
 * Created by PhpStorm.
 * User: Maxowar
 * Date: 17/07/2017
 * Time: 23:43
 */

namespace Ssh\Exception;

use Throwable;

class HostkeyMismatchException extends SshException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("Hostkey Mismatch", $code, $previous);
    }
}