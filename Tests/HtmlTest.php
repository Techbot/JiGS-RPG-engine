<?php

namespace EMC23\test;


class HtmlTest extends \PHPUnit_Framework_TestCase
{
    const SIGNATURE_PCRE = '`^[a-zA-Z0-9+_/-]+={0,2}$`';

    public function setUp() {
        parent::setUp();

    }

    public function tearDown() {


        parent::tearDown();
    }

    public function testGetFunctions()
    {
      //
    }

    protected function getFunction($functionName)
    {
        return;
    }
}
