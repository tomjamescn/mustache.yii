<?php
/**
 * Implementation of the `yii\test\mustache\HtmlTest` class.
 * @module test.helpers.HtmlTest
 */
namespace yii\test\mustache\helpers;

// Module dependencies.
use yii\mustache\helpers\Html;

/**
 * Tests the features of the `yii\mustache\helpers\Html` class.
 * @class yii.test.mustache.helpers.HtmlTest
 * @extends PHPUnit_Framework_TestCase
 * @constructor
 */
class HtmlTest extends \PHPUnit_Framework_TestCase {

  /**
   * The engine used to render strings.
   * @property helper
   * @type mustache.Mustache_LambdaHelper
   * @private
   */
  private $helper;

  /**
   * Tests the `markdown` property.
   * @method testMarkdown
   */
  public function testMarkdown() {
    $closure=(new Html())->markdown;
    /* TODO
    $this->assertEquals('<h1>title</h1>', $closure("title\n-----\n", $this->helper));
    $this->assertEquals('<em>label</em> <strong>label</strong>', $closure('*label* **label**', $this->helper));
    */
  }

  /**
   * Tests the `spaceless` property.
   * @method testSpaceless
   */
  public function testSpaceless() {
    $closure=(new Html())->spaceless;
    $this->assertEquals('<strong>label</strong><em>label</em>', $closure("<strong>label</strong>  \r\n  <em>label</em>", $this->helper));
    $this->assertEquals('<strong> label </strong><em> label </em>', $closure('<strong> label </strong> <em> label </em>', $this->helper));
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
