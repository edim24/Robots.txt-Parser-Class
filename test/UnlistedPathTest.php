<?php

use PHPUnit\Framework\TestCase;
use t1gor\RobotsTxtParser\RobotsTxtParser;

/**
 * @group unlisted-path
 */
class UnlistedPathTest extends TestCase
{
    /**
     * @link https://github.com/t1gor/Robots.txt-Parser-Class/issues/22
     */
    public function testAllowUnlistedPath()
    {
        // init parser
        $parser = new RobotsTxtParser("
			User-Agent: *
			Disallow: /admin/
		");

        // asserts
        $this->assertTrue($parser->isAllowed("/"));
        $this->assertFalse($parser->isDisallowed("/"));
    }
}
