<?php
/**
 * Implementation of the `yii\mustache\helpers\FormatHelper` class.
 * @module helpers.FormatHelper
 */
namespace yii\mustache\helpers;

// Module dependencies.
use yii\helpers\Html;

/**
 * Provides a collection of helper methods for formatting data.
 * @class yii.mustache.helpers.FormatHelper
 * @extends mustache.helpers.Helper
 * @constructor
 */
class FormatHelper extends Helper {

  /**
   * Formats the value as a boolean.
   * See: `yii\i18n\Formatter->asBoolean()`
   * @property boolean
   * @type Closure
   * @final
   */
  public function getBoolean() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::encode(\Yii::$app->formatter->asBoolean($helper->render($value)));
    };
  }

  /**
   * Formats the value as a currency number.
   * See: `yii\i18n\Formatter->asCurrency()`
   * @property currency
   * @type Closure
   * @final
   */
  public function getCurrency() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'value', [
        'currency'=>null,
        'options'=>[],
        'textOptions'=>[]
      ]);

      return Html::encode(\Yii::$app->formatter->asCurrency($args['value'], $args['currency'], $args['options'], $args['textOptions']));
    };
  }

  /**
   * Formats the value as a date.
   * See: `yii\i18n\Formatter->asDate()`
   * @property date
   * @type Closure
   * @final
   */
  public function getDate() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'value', [ 'format'=>null ]);
      return Html::encode(\Yii::$app->formatter->asDate($args['value'], $args['format']));
    };
  }

  /**
   * Formats the value as a datetime.
   * See: `yii\i18n\Formatter->asDateTime()`
   * @property dateTime
   * @type Closure
   * @final
   */
  public function getDateTime() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'value', [ 'format'=>null ]);
      return Html::encode(\Yii::$app->formatter->asDatetime($args['value'], $args['format']));
    };
  }

  /**
   * Formats the value as a decimal number.
   * See: `yii\i18n\Formatter->asDecimal()`
   * @property decimal
   * @type Closure
   * @final
   */
  public function getDecimal() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'value', [
        'decimals'=>null,
        'options'=>[],
        'textOptions'=>[]
      ]);

      return Html::encode(\Yii::$app->formatter->asDecimal($args['value'], $args['decimals'], $args['options'], $args['textOptions']));
    };
  }

  /**
   * Formats the value as an integer number by removing any decimal digits without rounding.
   * See: `yii\i18n\Formatter->asInteger()`
   * @property integer
   * @type Closure
   * @final
   */
  public function getInteger() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'value', [
        'options'=>[],
        'textOptions'=>[]
      ]);

      return Html::encode(\Yii::$app->formatter->asInteger($args['value'], $args['options'], $args['textOptions']));
    };
  }

  /**
   * Formats the value as a percent number with `%` sign.
   * See: `yii\i18n\Formatter->asPercent()`
   * @property percentage
   * @type Closure
   * @final
   */
  public function getPercent() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'value', [
        'decimals'=>null,
        'options'=>[],
        'textOptions'=>[]
      ]);

      return Html::encode(\Yii::$app->formatter->asPercent($args['value'], $args['decimals'], $args['options'], $args['textOptions']));
    };
  }

  /**
   * Formats the value as a time.
   * See: `yii\i18n\Formatter->asTime()`
   * @property time
   * @type Closure
   * @final
   */
  public function getTime() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'value', [ 'format'=>null ]);
      return Html::encode(\Yii::$app->formatter->asTime($args['value'], $args['format']));
    };
  }
}
