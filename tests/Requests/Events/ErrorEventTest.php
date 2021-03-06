<?php

namespace Rebing\Timber\Tests\Requests\Events;

use ErrorException;
use Rebing\Timber\Requests\Events\ErrorEvent;
use Rebing\Timber\Tests\TestCase;

class ErrorEventTest extends TestCase
{
    /**
     * @test
     */
    public function testCreatesANewErrorEventAndGetsTheData()
    {
        try {
            $arr = [];
            $arr[0];
        } catch (ErrorException $e) {
            $event = new ErrorEvent($e);
            $data = $event->getEvent();

            $this->assertEquals('Undefined offset: 0', $data['error']['name']);
            $this->assertEquals('Exception: "Undefined offset: 0" @ Illuminate\Foundation\Bootstrap\HandleExceptions->handleError',
                $data['error']['message']);
            $this->assertTrue(isset($data['error']['backtrace']));
        }
    }
}