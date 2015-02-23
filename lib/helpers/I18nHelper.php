<?php
/**
 * Implementation of the `yii\mustache\helpers\I18nHelper` class.
 * @module helpers.I18nHelper
 */
namespace yii\mustache\helpers;

/**
 * Provides a collection of helper methods for internationalization.
 * @class yii.mustache.helpers.I18nHelper
 * @extends mustache.helpers.Helper
 * @constructor
 */
class I18nHelper extends Helper {

  /**
   * String used to separate the category from the message in a translation.
   * @property categorySeparator
   * @type string
   * @static
   * @final
   */
  const CATEGORY_SEPARATOR=':';

  /**
   * Translates a message.
   * See: `translate()`
   * @property t
   * @type Closure
   * @final
   */
  public function getT() {
    return static::getTranslate();
  }

  /**
   * Translates a message.
   * See: `Yii::t()`
   * @property translate
   * @type Closure
   * @final
   * @throws {system.CException} The specified message has an invalid format.
   */
  public function getTranslate() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $output=trim($value);
      $isJson=(mb_substr($output, 0, 1)=='{' && mb_substr($output, mb_strlen($output)-1)=='}');

      $defaultArgs=[
        'category'=>'application',
        'language'=>null,
        'params'=>[],
        'source'=>null
      ];

      if($isJson) $args=$this->parseArguments($helper->render($value), 'message', $defaultArgs);
      else {
        $parts=explode(static::CATEGORY_SEPARATOR, $output, 2);
        if(count($parts)!=2) throw new \CException(\Yii::t('yii', 'Invalid translation format.'));
        $args=\CMap::mergeArray($defaultArgs, [
          'category'=>$parts[0],
          'message'=>$parts[1]
        ]);
      }

      return \CHtml::encode(\Yii::t($args['category'], $args['message'], $args['params'], $args['source'], $args['language']));
    };
  }
}
