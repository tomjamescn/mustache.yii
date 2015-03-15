<?php
/**
 * Implementation of the `yii\test\mustache\helpers\HelperTest` class.
 * @module test.helpers.HelperTest
 */
namespace yii\test\mustache\helpers;

// Module dependencies.
use yii\mustache\helpers\Helper;

/**
 * Publicly exposes the features of the `yii\mustache\helpers\Helper` class.
 * @class yii.test.mustache.helpers.HelperStub
 * @extends yii.mustache.helpers.Helper
 * @constructor
 */
class HelperStub extends Helper {
  public function parseArguments($text, $defaultArgument, array $defaultValues=[]) {
    return parent::parseArguments($text, $defaultArgument, $defaultValues);
  }
}

/**
 * Tests the features of the `yii\mustache\helpers\Helper` class.
 * @class yii.test.mustache.helpers.HelperTest
 * @extends PHPUnit_Framework_TestCase
 * @constructor
 */
class HelperTest extends \PHPUnit_Framework_TestCase {

  /**
   * Tests the `parseArguments` method.
   * @method testParseArguments
   */
  public function testParseArguments() {
    $model=new HelperStub();

    $expected=[ 'foo'=>'FooBar' ];
    $this->assertEquals($expected, $model->parseArguments('FooBar', 'foo'));

    $expected=[ 'foo'=>'FooBar', 'bar'=>[ 'baz'=>false ] ];
    $this->assertEquals($expected, $model->parseArguments('FooBar', 'foo', [ 'bar'=>[ 'baz'=>false ] ]));

    $data='{
      "foo": "FooBar",
      "bar": { "baz": true }
    }';

    $expected=[ 'foo'=>'FooBar', 'bar'=>[ 'baz'=>true ], 'BarFoo'=>[ 123, 456 ] ];
    $this->assertEquals($expected, $model->parseArguments($data, 'foo', [ 'BarFoo'=>[ 123, 456 ] ]));

    $data='{
      "foo": [ 123, 456 ]
    }';

    $expected=[ 'foo'=>[ 123, 456 ], 'bar'=>[ 'baz'=>false ] ];
    $this->assertEquals($expected, $model->parseArguments($data, 'foo', [ 'bar'=>[ 'baz'=>false ] ]));
  }
}
