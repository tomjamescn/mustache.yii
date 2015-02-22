<?php
/**
 * Implementation of the `belin\test\mustache\ViewRendererTest` class.
 * @module mustache.test.ViewRendererTest
 */
namespace belin\test\mustache;
use \belin\mustache\ViewRenderer;

/**
 * Tests the features of the `belin\mustache\ViewRenderer` class.
 * @class belin.mustache.test.ViewRendererTest
 * @extends system.test.CTestCase
 * @constructor
 */
class ViewRendererTest extends \CTestCase {

  /**
   * The data context of the tests.
   * @property model
   * @type mustache.ViewRenderer
   * @private
   */
  private $model;

  /**
   * Tests the `renderFile` method.
   * @method testRenderFile
   */
  public function testRenderFile() {
    $sourceFile=__DIR__.'/data.mustache';

    $data=null;
    $output=preg_split('/\r?\n/', $this->model->renderFile($this, $sourceFile, $data, true));
    $this->assertEquals('<test></test>', $output[0]);
    $this->assertEquals('<test></test>', $output[1]);
    $this->assertEquals('<test></test>', $output[2]);
    $this->assertEquals('<test>hidden</test>', $output[3]);

    $data=[ 'label'=>'"Mustache"', 'show'=>true ];
    $output=preg_split('/\r?\n/', $this->model->renderFile($this, $sourceFile, $data, true));
    $this->assertEquals('<test>&quot;Mustache&quot;</test>', $output[0]);
    $this->assertEquals('<test>"Mustache"</test>', $output[1]);
    $this->assertEquals('<test>visible</test>', $output[2]);
    $this->assertEquals('<test></test>', $output[3]);
  }

  /**
   * Performs a common set of tasks just before each test method is called.
   * @method setUp
   * @protected
   */
  protected function setUp() {
    $this->model=new ViewRenderer();
    $this->model->enableCaching=false;
    $this->model->init();
  }
}
