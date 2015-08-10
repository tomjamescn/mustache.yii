<?php
/**
 * @file
 * Implementation of the `yii\test\mustache\HtmlTest` class.
 */
namespace yii\test\mustache\helpers;

// Dependencies.
use yii\mustache\helpers\Html;

/**
 * Tests the features of the `yii\mustache\helpers\Html` class.
 */
class HtmlTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Mustache_LambdaHelper $helper
   * The engine used to render strings.
   */
  private $helper;

  /**
   * Tests the `markdown` property.
   */
  public function testMarkdown() {
    $closure=(new Html())->getMarkdown();
    $this->assertEquals("<h1>title</h1>\n", $closure("# title", $this->helper));
  }

  /**
   * Tests the `spaceless` property.
   */
  public function testSpaceless() {
    $closure=(new Html())->getSpaceless();
    $this->assertEquals('<strong>label</strong><em>label</em>', $closure("<strong>label</strong>  \r\n  <em>label</em>", $this->helper));
    $this->assertEquals('<strong> label </strong><em> label </em>', $closure('<strong> label </strong>  <em> label </em>', $this->helper));
  }

  /**
   * Performs a common set of tasks just before each test method is called.
   */
  protected function setUp() {
    $this->helper=new \Mustache_LambdaHelper(new \Mustache_Engine(), new \Mustache_Context());
  }
}
