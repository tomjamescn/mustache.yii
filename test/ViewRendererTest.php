<?php
/**
 * Implementation of the `yii\test\mustache\ViewRendererTest` class.
 * @module test.ViewRendererTest
 */
namespace yii\test\mustache;

// Module dependencies.
use yii\mustache\ViewRenderer;
use yii\web\View;

/**
 * Tests the features of the `yii\mustache\ViewRenderer` class.
 * @class yii.mustache.test.ViewRendererTest
 * @extends PHPUnit_Framework_TestCase
 * @constructor
 */
class ViewRendererTest extends \PHPUnit_Framework_TestCase {

  /**
   * Tests the `render` method.
   * @method testRender
   */
  public function testRender() {
    $file=__DIR__.'/data.mustache';
    $model=new ViewRenderer([ 'cacheId'=>false ]);

    $data=null;
    $output=preg_split('/\r?\n/', $model->render(new View(), $file, $data));
    $this->assertEquals('<test></test>', $output[0]);
    $this->assertEquals('<test></test>', $output[1]);
    $this->assertEquals('<test></test>', $output[2]);
    $this->assertEquals('<test>hidden</test>', $output[3]);

    $data=[ 'label'=>'"Mustache"', 'show'=>true ];
    $output=preg_split('/\r?\n/', $model->render(new View(), $file, $data));
    $this->assertEquals('<test>&quot;Mustache&quot;</test>', $output[0]);
    $this->assertEquals('<test>"Mustache"</test>', $output[1]);
    $this->assertEquals('<test>visible</test>', $output[2]);
    $this->assertEquals('<test></test>', $output[3]);
  }
}
