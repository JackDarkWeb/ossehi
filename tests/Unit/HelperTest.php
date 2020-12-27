<?php

namespace Tests\Unit;

use App\Helpers\Helper;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUserLocation()
    {
        $this->assertEquals('Benin', Helper::userLocation()->country);
        //$this->assertEquals('bj', Helper::userLocation()->iso_code);
    }

    public function testPrefixPhone()
    {
        $this->assertEquals('+229', Helper::prefixPhone('Benin'));

    }
}
