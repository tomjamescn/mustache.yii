<?php
/**
 * Implementation of the `yii\mustache\helpers\I18nHelper` class.
 * @module helpers.I18nHelper
 */
namespace yii\mustache\helpers;

// Module dependencies.
use yii\base\InvalidCallException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Provides a collection of helper methods for internationalization.
 * @class yii.mustache.helpers.I18nHelper
 * @extends mustache.helpers.Helper
 * @constructor
 */
class I18nHelper extends Helper {

  /**
   * String used to separate the category from the message in a translation template.
   * @property categorySeparator
   * @type string
   * @default ":"
   */
  public $categorySeparator=':';

  /**
   * Translates a message.
   * See: `getTranslate()`
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
   * @throws {yii.base.InvalidCallException} The specified message has an invalid format.
   */
  public function getTranslate() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $output=trim($value);
      $defaultArgs=[
        'category'=>'app',
        'language'=>null,
        'params'=>[]
      ];

      $isJson=(mb_substr($output, 0, 1)=='{' && mb_substr($output, mb_strlen($output)-1)=='}');
      if($isJson) $args=$this->parseArguments($helper->render($value), 'message', $defaultArgs);
      else {
        $parts=explode($this->categorySeparator, $output, 2);
        if(count($parts)!=2) throw new InvalidCallException(\Yii::t('yii', 'Invalid translation format.'));
        $args=ArrayHelper::merge($defaultArgs, [
          'category'=>$parts[0],
          'message'=>$parts[1]
        ]);
      }

      return Html::encode(\Yii::t($args['category'], $args['message'], $args['params'], $args['language']));
    };
  }
}
