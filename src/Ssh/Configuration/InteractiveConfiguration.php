<?php
/**
 * Created by PhpStorm.
 * User: Maxowar
 * Date: 21/07/2017
 * Time: 20:09
 */

namespace Ssh\Configuration;


use Ssh\Configuration;

class InteractiveConfiguration
{
    /**
     * @var
     */
    private $configuration;

    private $input;

    private $output;

    public static function run()
    {
        $self = new static();

        return $self->getConfiguration();
    }

    public function __construct($input = 'php://stdin', $output = 'php://stdout')
    {
        $this->input = fopen($input, 'r');
        $this->output = fopen($output, 'w');
    }

    public function getConfiguration()
    {
        $host = $this->ask('Host: ');
        $port = (int) $this->ask('Port: ');

        $this->configuration = new Configuration($host, $port);

        return $this->configuration;
    }

    private function ask($question)
    {
        fputs($this->output, $question);
        $answer = fgets($this->input);

        return trim($answer);
    }
}