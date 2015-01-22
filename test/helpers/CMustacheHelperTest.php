<?php
/**
 * Implementation of the `mustache.tests.CMustacheHelperTest` class.
 * @module test.helpers.CMustacheHelperTest
 */
Yii::import('mustache.helpers.CMustacheHelper');

/**
 * Publicly exposes the features of the `CMustacheHelper` class.
 * @class tests.CMustacheHelperStub
 * @extends CMustacheHelper
 * @constructor
 */
class CMustacheHelperStub extends CMustacheHelper {
  public function parseArguments($text, $defaultArgument, array $defaultValues=[]) {
    return parent::parseArguments($text, $defaultArgument, $defaultValues);
  }
}

/**
 * Tests the features of the `mustache.helpers.CMustacheHelper` class.
 * @class mustache.tests.helpers.CMustacheHelperTest
 * @extends system.test.CTestCase
 * @constructor
 */
class CMustacheHelperTest extends CTestCase {

  /**
   * Tests the `parseArguments` method.
   * @method testParseArguments
   */
  public function testParseArguments() {
    $model=new CMustacheHelperStub();
  }
}
