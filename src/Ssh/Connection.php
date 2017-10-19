<?php
/**
 * Created by PhpStorm.
 * User: Maxowar
 * Date: 17/07/2017
 * Time: 23:11
 */

namespace Ssh;


class Connection
{
    /**
     * @var resource
     */
    private $resource;

    public function connect(Configuration $configuration)
    {
        echo $configuration->getHost();
        if(!$this->resource = \ssh2_connect($configuration->getHost(), $configuration->getPort(), $configuration->getMethods(), $configuration->getCallbacks())) {
            throw new \RuntimeException("Cant connect");
        }
    }

    public function close()
    {
        \ssh2_exec($this->resource, "exit");
        unset($this->resource);
    }

    /**
     * @return resource
     */
    public function getResource()
    {
        return $this->resource;
    }
}