<?php declare(strict_types=1);

namespace Stream\Filter;

use PHPUnit\Framework\TestCase;
use t1gor\RobotsTxtParser\Stream\Filters\SkipUnsupportedDirectivesFilter;

class SkipUnsupportedDirectivesTest extends TestCase {

	public function setUp(): void {
		parent::setUp();

		stream_filter_register(SkipUnsupportedDirectivesFilter::NAME, SkipEmptyLinesFilter::class);
	}

	public function testRegister() {
		$this->assertContains(SkipUnsupportedDirectivesFilter::NAME, stream_get_filters());
	}

	public function testFilter() {
		$stream = fopen(__DIR__ . '/../../Fixtures/with-faulty-directives.txt','r');

		// apply filter
		stream_filter_append($stream, SkipUnsupportedDirectivesFilter::NAME);

		$fstat = fstat($stream);
		$contents = fread($stream, $fstat['size']);

		$this->assertStringNotContainsString('Disallow /admin/ # prohibits links from the admin panel', $contents);
		$this->assertStringNotContainsString('dis@llow: /admin/ # prohibits links from the admin panel', $contents);
		$this->assertStringNotContainsString('cleanParam: ref /some_dir/get_book.pl', $contents);
		$this->assertStringNotContainsString('User#agent: google4 #specifies the robots that the directives are set for', $contents);
		$this->assertStringNotContainsString('Disa#low: /bin/ # prohibits links from the Shopping Cart.', $contents);
		$this->assertStringNotContainsString('Disa#low: /search/ # prohibits page links of the search embedded on the site', $contents);
		$this->assertStringNotContainsString('Disa#low: /admin/ # prohibits links from the admin panel', $contents);
		$this->assertStringNotContainsString('Site#ap: http://example.com/sitemap # specifies the path to the site\'s Sitemap file for the robot', $contents);
		$this->assertStringNotContainsString('Clean#param: ref /some_dir/get_book.pl', $contents);

		fclose($stream);
	}
}
