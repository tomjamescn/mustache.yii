<?php
/**
 * Implementation of the `mustache.tests.CMustacheFormatHelperTest` class.
 * @module test.helpers.CMustacheFormatHelperTest
 */
Yii::import('mustache.helpers.CMustacheFormatHelper');

/**
 * Tests the features of the `mustache.helpers.CMustacheFormatHelper` class.
 * @class mustache.tests.helpers.CMustacheFormatHelperTest
 * @extends system.test.CTestCase
 * @constructor
 */
class CMustacheFormatHelperTest extends CTestCase {

  /**
   * The engine used to render strings.
   * @property helper
   * @type Mustache_LambdaHelper
   * @private
   */
  private $helper;

  /**
   * Tests the `currency` property.
   * @method testCurrency
   */
  public function testCurrency() {
    $closure=(new CMustacheFormatHelper())->currency;
    $this->assertEquals('$100.00', $closure('100', $this->helper));
    $this->assertEquals('€1,234.56', $closure('{ "value": 1234.56, "currency": "EUR" }', $this->helper));
  }

  /**
   * Tests the `decimal` property.
   * @method testDecimal
   */
  public function testDecimal() {
    $closure=(new CMustacheFormatHelper())->decimal;
    $this->assertEquals('100.00', $closure('100', $this->helper));
    $this->assertEquals('1,234.56', $closure('1234.56', $this->helper));
  }

  /**
   * Tests the `percentage` property.
   * @method testPercentage
   */
  public function testPercentage() {
    $closure=(new CMustacheFormatHelper())->percentage;
    $this->assertEquals('10%', $closure('0.1', $this->helper));
    $this->assertEquals('123%', $closure('1.23', $this->helper));
  }

  /**
   * Performs a common set of tasks just before each test method is called.
   * @method setUp
   * @protected
   */
  protected function setUp() {
    $this->helper=new Mustache_LambdaHelper(new Mustache_Engine(), new Mustache_Context());
  }
}
