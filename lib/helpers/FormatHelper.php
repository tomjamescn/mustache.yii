<?php
/**
 * Implementation of the `yii\mustache\helpers\FormatHelper` class.
 * @module helpers.FormatHelper
 */
namespace yii\mustache\helpers;

// Module dependencies.
use yii\helpers\Html;

/**
 * Provides a collection of helper methods for formatting dates and numbers.
 * @class yii.mustache.helpers.FormatHelper
 * @extends mustache.helpers.Helper
 * @constructor
 */
class FormatHelper extends Helper {

  public function getAsBoolean() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::encode(\Yii::$app->formatter->asBoolean($helper->render($value)));
    };
  }

  /**
   * Formats a number using the currency format defined in the locale.
   * See: `CNumberFormatter->asCurrency()`
   * @property currency
   * @type Closure
   * @final
   */
  public function getCurrency() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'value', [ 'currency'=>'USD' ]);
      return Html::encode(\Yii::$app->formatter->asCurrency($args['value'], $args['currency']));
    };
  }

  /**
   * Formats a date according to a predefined pattern.
   * See: `yii\i18n\Formatter->asDateTime()`
   * @property dateTime
   * @type Closure
   * @final
   */
  public function getDateTime() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'timestamp', [
        'dateWidth'=>'medium',
        'timeWidth'=>'medium'
      ]);

      return Html::encode(\Yii::$app->formatter->asDateTime($args['timestamp'], $args['dateWidth'] , $args['timeWidth']));
    };
  }

  /**
   * Formats a number using the decimal format defined in the locale.
   * See: `CNumberFormatter->asDecimal()`
   * @property decimal
   * @type Closure
   * @final
   */
  public function getDecimal() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::encode(\Yii::$app->formatter->asDecimal($helper->render($value)));
    };
  }

  /**
   * Formats a timestamp using the full date format defined in the locale.
   * See: `yii\i18n\Formatter->asDateTime()`
   * @property fullDate
   * @type Closure
   * @final
   */
  public function getFullDate() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::encode(\Yii::$app->formatter->asDateTime($helper->render($value), 'full', null));
    };
  }

  /**
   * Formats a timestamp using the full time format defined in the locale.
   * See: `yii\i18n\Formatter->asDateTime()`
   * @property fullTime
   * @type Closure
   * @final
   */
  public function getFullTime() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::encode(\Yii::$app->formatter->asDateTime($helper->render($value), null, 'full'));
    };
  }

  /**
   * Formats a timestamp using the long date format defined in the locale.
   * See: `yii\i18n\Formatter->asDateTime()`
   * @property longDate
   * @type Closure
   * @final
   */
  public function getLongDate() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::encode(\Yii::$app->formatter->asDateTime($helper->render($value), 'long', null));
    };
  }

  /**
   * Formats a timestamp using the long time format defined in the locale.
   * See: `yii\i18n\Formatter->asDateTime()`
   * @property longTime
   * @type Closure
   * @final
   */
  public function getLongTime() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::encode(\Yii::$app->formatter->asDateTime($helper->render($value), null, 'long'));
    };
  }

  /**
   * Formats a timestamp using the medium date format defined in the locale.
   * See: `yii\i18n\Formatter->asDateTime()`
   * @property mediumDate
   * @type Closure
   * @final
   */
  public function getMediumDate() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::encode(\Yii::$app->formatter->asDateTime($helper->render($value), 'medium', null));
    };
  }

  /**
   * Formats a timestamp using the medium time format defined in the locale.
   * See: `yii\i18n\Formatter->asDateTime()`
   * @property mediumTime
   * @type Closure
   * @final
   */
  public function getMediumTime() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::encode(\Yii::$app->formatter->asDateTime($helper->render($value), null, 'medium'));
    };
  }

  /**
   * Formats a number using the percentage format defined in the locale.
   * See: `CNumberFormatter->asPercentage()`
   * @property percentage
   * @type Closure
   * @final
   */
  public function getPercentage() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::encode(\Yii::$app->formatter->asPercentage($helper->render($value)));
    };
  }

  /**
   * Formats a timestamp using the short date format defined in the locale.
   * See: `yii\i18n\Formatter->asDateTime()`
   * @property shortDate
   * @type Closure
   * @final
   */
  public function getShortDate() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::encode(\Yii::$app->formatter->asDateTime($helper->render($value), 'short', null));
    };
  }

  /**
   * Formats a timestamp using the short time format defined in the locale.
   * See: `yii\i18n\Formatter->asDateTime()`
   * @property shortTime
   * @type Closure
   * @final
   */
  public function getShortTime() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::encode(\Yii::$app->formatter->asDateTime($helper->render($value), null, 'short'));
    };
  }
}
