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
   * Tests the `getBoolean` method.
   */
  public function testGetBoolean() {
    $closure=(new Format())->getBoolean();
    $this->assertEquals('No', $closure(false, $this->helper));
    $this->assertEquals('No', $closure(0, $this->helper));
    $this->assertEquals('Yes', $closure(true, $this->helper));
    $this->assertEquals('Yes', $closure(1, $this->helper));
  }

  /**
   * Tests the `getCurrency` method.
   */
  public function testGetCurrency() {
    $closure=(new Format())->getCurrency();
    $this->assertEquals('$100.00', $closure('100', $this->helper));
    $this->assertEquals('€1,234.56', $closure('{ "value": 1234.56, "currency": "EUR" }', $this->helper));
  }

  /**
   * Tests the `getDate` method.
   */
  public function testGetDate() {
    $closure=(new Format())->getDate();
    $this->assertEquals('Jan 1, 2015', $closure('2015-01-01 12:00:00', $this->helper));
  }

  /**
   * Tests the `getDateTime` method.
   */
  public function testGetDateTime() {
    $closure=(new Format())->getDateTime();
    $this->assertEquals('Jan 1, 2015, 1:00:00 PM', $closure('2015-01-01 12:00:00', $this->helper));
  }

  /**
   * Tests the `getDecimal` method.
   */
  public function testGetDecimal() {
    $closure=(new Format())->getDecimal();
    $this->assertEquals('100.00', $closure('100', $this->helper));
    $this->assertEquals('1,234.56', $closure('1234.56', $this->helper));
  }

  /**
   * Tests the `getInteger` method.
   */
  public function testGetInteger() {
    $closure=(new Format())->getInteger();
    $this->assertEquals('100', $closure('100', $this->helper));
    $this->assertEquals('-1,234', $closure('-1234.56', $this->helper));
  }

  /**
   * Tests the `getNtext` method.
   */
  public function testGetNtext() {
    $closure=(new Format())->getNtext();
    $this->assertEquals('Foo<br>Bar', $closure("Foo\nBar", $this->helper));
    $this->assertEquals('Foo<br>Baz', $closure("Foo\r\nBaz", $this->helper));
  }

  /**
   * Tests the `getPercent` method.
   */
  public function testGetPercent() {
    $closure=(new Format())->getPercent();
    $this->assertEquals('10%', $closure('0.1', $this->helper));
    $this->assertEquals('123%', $closure('1.23', $this->helper));
  }

  /**
   * Tests the `getTime` method.
   */
  public function testGetTime() {
    $closure=(new Format())->getTime();
    $this->assertEquals('1:00:00 PM', $closure('2015-01-01 12:00:00', $this->helper));
  }

  /**
   * Performs a common set of tasks just before each test method is called.
   */
  protected function setUp() {
    $this->helper=new \Mustache_LambdaHelper(new \Mustache_Engine(), new \Mustache_Context());
  }
}
