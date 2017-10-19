<?php
/**
 * Created by PhpStorm.
 * User: Maxowar
 * Date: 17/07/2017
 * Time: 23:02
 */

namespace Ssh;


use Ssh\Authentication\AuthenticationMethod;

class Configuration
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     * @var array
     */
    private $methods;

    /**
     * @var array
     */
    private $callbacks;

    /**
     * @var AuthenticationMethod
     */
    private $authentication;

    public function __construct(string $host , int $port = 22, array $methods = [], array $callbacks = [])
    {
        $this->host = $host;
        $this->port = $port;
        $this->methods = $methods;
        $this->callbacks = $callbacks;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host)
    {
        $this->host = $host;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port)
    {
        $this->port = $port;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     */
    public function setMethods(array $methods)
    {
        $this->methods = $methods;
    }

    /**
     * @return array
     */
    public function getCallbacks(): array
    {
        return $this->callbacks;
    }

    /**
     * @param array $callbacks
     */
    public function setCallbacks(array $callbacks)
    {
        $this->callbacks = $callbacks;
    }

    public function setAuthentication(AuthenticationMethod $authenticationMethod)
    {
        $this->authentication = $authenticationMethod;
    }

    public function getAuthentication()
    {
        return $this->authentication;
    }

}