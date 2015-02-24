<?php
/**
 * Implementation of the `yii\mustache\helpers\Helper` class.
 * @module helpers.Helper
 */
namespace yii\mustache\helpers;

// Module dependencies.
use yii\base\Object;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Provides the abstract base class for a view helper.
 * @class yii.mustache.helpers.Helper
 * @extends system.base.CComponent
 * @constructor
 */
abstract class Helper extends Object {

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
    $args=$defaultValues;
    if(is_array($json=Json::decode($text))) return ArrayHelper::merge($args, $json);

    $args[$defaultArgument]=$text;
    return $args;
  }
}
