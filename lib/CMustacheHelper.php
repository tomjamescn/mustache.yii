<?php
/**
 * Implementation of the `CMustacheHelper` class.
 * @module CMustacheHelper
 */

/**
 * Provides the abstract base class for a view helper.
 * @class CMustacheHelper
 * @extends CComponent
 * @constructor
 */
abstract class CMustacheHelper extends CComponent {

  /**
   * Parses the helper arguments.
   * Arguments can be specified as a single value, or as a string in JSON format.
	 * @method parseArguments
	 * @param {string} $text The section content specifying the helper arguments.
	 * @param {string} $defaultArgument The name of the default argument. This is used when the section content provides a plain string instead of a JSON object.
	 * @param {array} [$defaultValues] The default values of arguments. These are used when the section content does not specify all arguments.
	 * @return {array} The parsed arguments as an associative array.
	 */
  protected function parseArguments($text, $defaultArgument, array $defaultValues=[]) {
    $args=$defaultValues;

    $json=CJSON::decode($text);
    if(!is_array($json)) $args[$defaultArgument]=$text;
    else $args=CMap::mergeArray($args, $json);

    return $args;
  }
}
