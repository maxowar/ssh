<?php
/**
 * Created by PhpStorm.
 * User: Maxowar
 * Date: 17/07/2017
 * Time: 23:54
 */

namespace Ssh\Exception;


use Throwable;

class RemoteExecutionFailed extends SshException
{
    public function __construct(string $command = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("Failed to execute command: $command", $code, $previous);
    }
}