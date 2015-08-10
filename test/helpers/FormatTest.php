<?php
/**
 * @file
 * Implementation of the `yii\test\mustache\FormatTest` class.
 */
namespace yii\test\mustache\helpers;

// Dependencies.
use yii\mustache\helpers\Format;

/**
 * Tests the features of the `yii\mustache\helpers\Format` class.
 */
class FormatTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Mustache_LambdaHelper $helper
   * The engine used to render strings.
   */
  private $helper;

  /**
   * Tests the `currency` property.
   */
  public function testCurrency() {
    $closure=(new Format())->getCurrency();
    $this->assertEquals('$100.00', $closure('100', $this->helper));
    $this->assertEquals('€1,234.56', $closure('{ "value": 1234.56, "currency": "EUR" }', $this->helper));
  }

  /**
   * Tests the `decimal` property.
   */
  public function testDecimal() {
    $closure=(new Format())->getDecimal();
    $this->assertEquals('100.00', $closure('100', $this->helper));
    $this->assertEquals('1,234.56', $closure('1234.56', $this->helper));
  }

  /**
   * Tests the `ntext` property.
   */
  public function testNtext() {
    $closure=(new Format())->getNtext();
    $this->assertEquals('Foo<br>Bar', $closure("Foo\nBar", $this->helper));
    $this->assertEquals('Foo<br>Baz', $closure("Foo\r\nBaz", $this->helper));
  }

  /**
   * Tests the `percent` property.
   */
  public function testPercent() {
    $closure=(new Format())->getPercent();
    $this->assertEquals('10%', $closure('0.1', $this->helper));
    $this->assertEquals('123%', $closure('1.23', $this->helper));
  }

  /**
   * Performs a common set of tasks just before each test method is called.
   */
  protected function setUp() {
    $this->helper=new \Mustache_LambdaHelper(new \Mustache_Engine(), new \Mustache_Context());
  }
}
