<?php
/**
 * Implementation of the `yii\test\mustache\HtmlHelperTest` class.
 * @module test.helpers.HtmlHelperTest
 */
namespace yii\test\mustache\helpers;
use yii\mustache\helpers\HtmlHelper;

/**
 * Tests the features of the `yii\mustache\helpers\HtmlHelper` class.
 * @class yii.test.mustache.helpers.HtmlHelperTest
 * @extends phpunit.PHPUnit_Framework_TestCase
 * @constructor
 */
class HtmlHelperTest extends \PHPUnit_Framework_TestCase {

  /**
   * The engine used to render strings.
   * @property helper
   * @type mustache.Mustache_LambdaHelper
   * @private
   */
  private $helper;

  /**
   * Tests the `cdata` property.
   * @method testCdata
   */
  public function testCdata() {
    $closure=(new HtmlHelper())->cdata;
    $this->assertEquals('<![CDATA[FooBar]]>', $closure('FooBar', $this->helper));
  }

  /**
   * Tests the `nl2br` property.
   * @method testNl2br
   */
  public function testNl2br() {
    $closure=(new HtmlHelper())->nl2br;
    $this->assertEquals('Foo<br>Bar', $closure("Foo\r\nBar", $this->helper));
  }

  /**
   * Performs a common set of tasks just before each test method is called.
   * @method setUp
   * @protected
   */
  protected function setUp() {
    $this->helper=new \Mustache_LambdaHelper(new \Mustache_Engine(), new \Mustache_Context());
  }
}