<?php
/**
 * Created by PhpStorm.
 * User: Maxowar
 * Date: 21/07/2017
 * Time: 20:05
 */

namespace Ssh;

use PHPUnit\Framework\TestCase;
use Ssh\Configuration\InteractiveConfiguration;

class SessionTest extends TestCase
{
    /**
     * @test
     */
    public function openSession()
    {
        $session = new Session(InteractiveConfiguration::run());
        $session->start();

        $this->assertTrue($session->isStarted());
    }
}