<?php
/**
 * Implementation of the `yii\mustache\helpers\Helper` class.
 * @module helpers.Helper
 */
namespace yii\mustache\helpers;

// Module dependencies.
use yii\base\InvalidParamException;
use yii\base\Object;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Provides the abstract base class for a view helper.
 * @class yii.mustache.helpers.Helper
 * @extends yii.base.Object
 * @constructor
 */
abstract class Helper extends Object {

  /**
   * String used to separate the arguments for helpers supporting the "two arguments" syntax.
   * @property argumentSeparator
   * @type string
   * @default ":"
   */
  public $argumentSeparator=':';

  /**
   * Parses the arguments of a parametized helper.
   * Arguments can be specified as a single value, or as a string in JSON format.
   * @method parseArguments
   * @param {string} $text The section content specifying the helper arguments.
   * @param {string} $defaultArgument The name of the default argument. This is used when the section content provides a plain string instead of a JSON object.
   * @param {array} [$defaultValues] The default values of arguments. These are used when the section content does not specify all arguments.
   * @return {array} The parsed arguments as an associative array.
   */
  protected function parseArguments($text, $defaultArgument, array $defaultValues=[]) {
    try { if(is_array($json=Json::decode($text))) return ArrayHelper::merge($defaultValues, $json); }
    catch(InvalidParamException $e) {}

    $defaultValues[$defaultArgument]=$text;
    return $defaultValues;
  }
}
