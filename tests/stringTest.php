<?php
class StringTest extends PHPUnit_Framework_TestCase {

	public function testRot8() {
		$helper = \Helper\Security::instance();
		$result = $helper->rot8("0af");
		$this->assertEquals("827", $result);
	}

	public function testSalt() {
		$helper = \Helper\Security::instance();
		$result = $helper->salt();
		$this->assertRegexp("/[0-9a-f]{32}/", $result);
	}

	public function testSaltSha1() {
		$helper = \Helper\Security::instance();
		$result = $helper->salt_sha1();
		$this->assertRegexp("/[0-9a-f]{40}/", $result);
	}

	public function testHash() {
		$helper = \Helper\Security::instance();
		$string = "Hello world!";
		$hash = $helper->hash($string);
		$result = $helper->hash($string, $hash["salt"]);
		$this->assertEquals($result, $hash["hash"]);
	}

	public function testFormatFilesize() {
		$helper = \Helper\View::instance();
		$size = 1288490189;
		$result = $helper->formatFilesize($size);
		$this->assertContains($result, array("1.2 GB", "1.20 GB"));
	}

	public function testGravatar() {
		$helper = \Helper\View::instance();
		$email = "alan@phpizza.com";
		$result = $helper->gravatar($email);
		$this->assertContains("gravatar.com/avatar/996df14", $result);
	}

	public function testUtc2local() {
		$helper = \Helper\View::instance();
		$time = 1420498500;
		$result = $helper->utc2local($time);
		$this->assertEquals(1420473300, $result);
	}

	public function testConvertClosedDate() {
		$helper = \Helper\Update::instance();
		$time = '2016-01-01 12:34:56';
		$result = $helper->convertClosedDate($time);
		$this->assertEquals('Fri, Jan 1, 2016 5:34am', $result);
	}

}
