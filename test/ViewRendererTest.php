<?php
/**
 * Implementation of the `yii\test\mustache\ViewRendererTest` class.
 * @module test.ViewRendererTest
 */
namespace yii\test\mustache;

// Module dependencies.
use yii\mustache\ViewRenderer;

/**
 * Tests the features of the `yii\mustache\ViewRenderer` class.
 * @class yii.mustache.test.ViewRendererTest
 * @extends phpunit.PHPUnit_Framework_TestCase
 * @constructor
 */
class ViewRendererTest extends \PHPUnit_Framework_TestCase {

  /**
   * Tests the `render` method.
   * @method testRender
   */
  public function testRender() {
    $model=new ViewRenderer();
    $file=__DIR__.'/data.mustache';

    $data=null;
    $output=preg_split('/\r?\n/', $model->render($this, $file, $data));
    $this->assertEquals('<test></test>', $output[0]);
    $this->assertEquals('<test></test>', $output[1]);
    $this->assertEquals('<test></test>', $output[2]);
    $this->assertEquals('<test>hidden</test>', $output[3]);

    $data=[ 'label'=>'"Mustache"', 'show'=>true ];
    $output=preg_split('/\r?\n/', $model->render($this, $file, $data));
    $this->assertEquals('<test>&quot;Mustache&quot;</test>', $output[0]);
    $this->assertEquals('<test>"Mustache"</test>', $output[1]);
    $this->assertEquals('<test>visible</test>', $output[2]);
    $this->assertEquals('<test></test>', $output[3]);
  }
}
