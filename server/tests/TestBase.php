<?php

namespace Tests;
require 'bootstrap.php';

use ADelf\LeaderServer\App;
use PHPUnit\Framework\TestCase;

class TestBase  extends TestCase
{
    /**
     * @var App
     */
    protected $app;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app = App::instance();
        $this->app->start();
    }
}