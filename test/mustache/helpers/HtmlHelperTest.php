<?php
/**
 * Implementation of the `belin\test\mustache\HtmlHelperTest` class.
 * @module mustache.test.helpers.HtmlHelperTest
 */
namespace belin\test\mustache\helpers;
use \belin\mustache\helpers\HtmlHelper;

/**
 * Tests the features of the `belin\mustache\helpers\HtmlHelper` class.
 * @class belin.test.mustache.helpers.HtmlHelperTest
 * @extends system.test.CTestCase
 * @constructor
 */
class HtmlHelperTest extends \CTestCase {

  /**
   * The engine used to render strings.
   * @property helper
   * @type Mustache_LambdaHelper
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

    \CHtml::$closeSingleTags=false;
    $this->assertEquals('Foo<br>Bar', $closure("Foo\r\nBar", $this->helper));

    \CHtml::$closeSingleTags=true;
    $this->assertEquals('Foo<br />Bar', $closure("Foo\r\nBar", $this->helper));
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
