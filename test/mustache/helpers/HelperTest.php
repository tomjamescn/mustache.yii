<?php
/**
 * Implementation of the `belin\test\mustache\HelperTest` class.
 * @module mustache.test.helpers.HelperTest
 */
namespace belin\test\mustache\helpers;
use belin\mustache\helpers\Helper;

/**
 * Publicly exposes the features of the `Helper` class.
 * @class belin.test.mustache.helpers.HelperStub
 * @extends belin.mustache.helpers.Helper
 * @constructor
 */
class HelperStub extends Helper {
  public function parseArguments($text, $defaultArgument, array $defaultValues=[]) {
    return parent::parseArguments($text, $defaultArgument, $defaultValues);
  }
}

/**
 * Tests the features of the `belin\mustache\helpers\Helper` class.
 * @class belin.test.mustache.helpers.HelperTest
 * @extends system.test.CTestCase
 * @constructor
 */
class HelperTest extends \CTestCase {

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
