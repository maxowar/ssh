<?php
/**
 * Created by PhpStorm.
 * User: Maxowar
 * Date: 17/07/2017
 * Time: 23:00
 */

namespace Ssh;

use Ssh\Exception\HostkeyMismatchException;
use Ssh\Exception\RemoteExecutionFailed;

class Session
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var int
     */
    private $status;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->status = SessionStatus::CREATED;
    }

    public function start()
    {
        $this->initConnection();

        $this->getConnection()->connect($this->configuration);

        if(!in_array($this->getConnection()->getFingerprint(), $this->getKnownHosts())){
            throw new HostkeyMismatchException();
        }

        $this->getConfiguration()->getAuthentication()->authenticate($this);

        $this->status = SessionStatus::STARTED;
    }

    public function end()
    {
        $this->getConnection()->close();
        $this->status = SessionStatus::TERMINATED;
    }

    /**
     * @return Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }


    public function run(string $command)
    {
        $command .= ';echo -ne "[__EXIT_CODE__:$?]"';

        if(!$stdout = \ssh2_exec($this->getConnection()->getResource(), $command)) {
            throw new RemoteExecutionFailed($command);
        }

        $stderr = \ssh2_fetch_stream($stdout, SSH2_STREAM_STDERR);

        \stream_set_blocking($stdout, true);
        \stream_set_blocking($stderr, true);

        $output = \stream_get_contents($stdout);
        $error = \stream_get_contents($stderr);

        $exitCode = -1;

        \preg_match('/__EXIT_CODE__:(.*?)/', $output, $matches);
        if((int) $matches[1] !== 0) {
            $exitCode = $matches[1];
        }

        return $exitCode;
    }

    public function interactive(string $command)
    {

    }

    /**
     * @return array
     */
    public function getKnownHosts()
    {
        return [];
    }

    public function isStarted()
    {
        return $this->status === SessionStatus::STARTED;
    }

    private function initConnection()
    {
        $this->connection = new Connection();
        $this->connection->connect($this->configuration);
    }
}