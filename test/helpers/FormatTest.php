<?php
/**
 * Implementation of the `yii\test\mustache\FormatTest` class.
 * @module test.helpers.FormatTest
 */
namespace yii\test\mustache\helpers;

// Module dependencies.
use yii\mustache\helpers\Format;

/**
 * Tests the features of the `yii\mustache\helpers\Format` class.
 * @class yii.test.mustache.helpers.FormatTest
 * @extends PHPUnit_Framework_TestCase
 * @constructor
 */
class FormatTest extends \PHPUnit_Framework_TestCase {

  /**
   * The engine used to render strings.
   * @property helper
   * @type mustache.Mustache_LambdaHelper
   * @private
   */
  private $helper;

  /**
   * Tests the `currency` property.
   * @method testCurrency
   */
  public function testCurrency() {
    $closure=(new Format())->currency;
    $this->assertEquals('$100.00', $closure('100', $this->helper));
    $this->assertEquals('€1,234.56', $closure('{ "value": 1234.56, "currency": "EUR" }', $this->helper));
  }

  /**
   * Tests the `decimal` property.
   * @method testDecimal
   */
  public function testDecimal() {
    $closure=(new Format())->decimal;
    $this->assertEquals('100.00', $closure('100', $this->helper));
    $this->assertEquals('1,234.56', $closure('1234.56', $this->helper));
  }

  /**
   * Tests the `ntext` property.
   * @method testNtext
   */
  public function testNtext() {
    $closure=(new Format())->ntext;
    $this->assertEquals('Foo<br>Bar', $closure("Foo\nBar", $this->helper));
    $this->assertEquals('Foo<br>Baz', $closure("Foo\r\nBaz", $this->helper));
  }

  /**
   * Tests the `percent` property.
   * @method testPercent
   */
  public function testPercent() {
    $closure=(new Format())->percent;
    $this->assertEquals('10%', $closure('0.1', $this->helper));
    $this->assertEquals('123%', $closure('1.23', $this->helper));
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
