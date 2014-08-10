<?php
/**
 * Implementation of the `CMustacheHtmlHelper` class.
 * @module CMustacheHtmlHelper
 */

/**
 * Component providing a collection of helper methods for creating views.
 * @class CMustacheHtmlHelper
 * @extends CComponent
 * @constructor
 */
class CMustacheHtmlHelper extends CComponent {

  /**
   * Generates the URL for the published assets.
   * @property asset
   * @type Closure
   * @final
	 */
	public function getAsset() {
    return function($path, Mustache_LambdaHelper $helper) {
      return CHtml::asset($helper->render($path));
    };
	}

  /**
   * Creates an absolute URL for the specified route.
	 * @property createAbsoluteUrl
	 * @type Closure
	 * @final
	 */
  public function getCreateAbsoluteUrl() {
    return function($route, Mustache_LambdaHelper $helper) {
      $value=$helper->render($route);
      return ($controller=Yii::app()->controller) ? $controller->createAbsoluteUrl($value) : Yii::app()->createAbsoluteUrl($value);
    };
  }

  /**
   * Creates a relative URL for the specified route.
   * @property createUrl
   * @type Closure
   * @final
   */
  public function getCreateUrl() {
    return function($route, Mustache_LambdaHelper $helper) {
      $value=$helper->render($route);
      return ($controller=Yii::app()->controller) ? $controller->createUrl($value) : Yii::app()->createUrl($value);
    };
  }

  /**
   * Generates a hidden field for storing the token used to perform CSRF validation.
   * @property csrfTokenField
   * @type string
   * @final
   */
  public function getCsrfTokenField() {
    $request=Yii::app()->request;
    return !$request->enableCsrfValidation ? '' : CHtml::hiddenField($request->csrfTokenName, $request->csrfToken, [ 'id'=>false ]);
  }

  /**
   * Formats a number using the decimal format defined in the locale.
   * @property formatDecimal
   * @type Closure
   * @final
   */
  public function getFormatDecimal() {
    return function($value, Mustache_LambdaHelper $helper) {
      return Yii::app()->numberFormatter->formatDecimal($helper->render($value));
    };
  }

  /**
   * Formats a number using the percentage format defined in the locale.
   * @property formatPercentage
   * @type Closure
   * @final
	 */
	public function getFormatPercentage($url, Mustache_LambdaHelper $helper) {
    return function($value, Mustache_LambdaHelper $helper) {
      return Yii::app()->numberFormatter->formatPercentage($helper->render($value));
    };
	}

  /**
   * Generates a valid HTML identifier based on name.
   * @property idByName
   * @type Closure
   * @final
	 */
  public function getIdByName() {
    return function($name, Mustache_LambdaHelper $helper) {
      return CHtml::idByName($helper->render($name));
    };
  }

  /**
   * Generates a hidden field for storing persistent page states.
   * @property pageStateField
   * @type Closure
   * @final
	 */
  public function getPageStateField() {
    return function($value, Mustache_LambdaHelper $helper) {
      return CHtml::pageStateField($helper->render($value));
    };
  }

  /**
   * Registers a `refresh` meta tag.
   * @property refresh
   * @type Closure
   * @final
	 */
	public function getRefresh() {
    return function($value, Mustache_LambdaHelper $helper) {
      $parts=explode(';', $helper->render($value), 2);
      $seconds=$parts[0];
      $url=(count($parts)>1 ? $parts[1] : '');
      return CHtml::refresh($seconds, $url);
    };
	}
}
