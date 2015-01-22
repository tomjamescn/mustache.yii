<?php
/**
 * Implementation of the `mustache.tests.CMustacheViewRendererTest` class.
 * @module test.CMustacheViewRendererTest
 */
Yii::import('mustache.CMustacheViewRenderer');

/**
 * Tests the features of the `mustache.CMustacheViewRenderer` class.
 * @class mustache.tests.CMustacheViewRendererTest
 * @extends system.test.CTestCase
 * @constructor
 */
class CMustacheViewRendererTest extends CTestCase {

  /**
   * The data context of the tests.
   * @property model
   * @type mustache.CMustacheViewRenderer
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
    $this->model=new CMustacheViewRenderer();
    $this->model->enableCaching=false;
    $this->model->init();
  }
}
