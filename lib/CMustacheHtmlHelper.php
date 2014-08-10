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
   * Creates an absolute URL for the specified route.
	 * @property absoluteUrl
	 * @type Closure
	 * @final
	 */
  public function getAbsoluteUrl() {
    return function($route, Mustache_LambdaHelper $helper) {
      $value=$helper->render($route);
      return ($controller=Yii::app()->controller) ? $controller->createAbsoluteUrl($value) : Yii::app()->createAbsoluteUrl($value);
    };
  }

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
   * Encloses the given string within a CDATA tag.
   * @property cdata
   * @type Closure
   * @final
	 */
	public function getCdata() {
    return function($text, Mustache_LambdaHelper $helper) {
      return CHtml::cdata($helper->render($text));
    };
	}

  /**
   * Creates a relative URL for the specified route.
   * @property csrfTokenField
   * @type string
   * @final
   */
  public function getCsrfTokenField() {
    $request=Yii::app()->request;
    return !$request->enableCsrfValidation ? '' : CHtml::hiddenField($request->csrfTokenName, $request->csrfToken, [ 'id'=>false ]);
  }

  /**
   * Encloses the given CSS content with a CSS tag.
   * @property css
   * @type Closure
   * @final
	 */
	public function getCss() {
    return function($text, Mustache_LambdaHelper $helper) {
      return CHtml::css($helper->render($text));
    };
	}

  /**
   * Formats a number using the decimal format defined in the locale.
   * @property decimal
   * @type Closure
   * @final
   */
  public function getDecimal() {
    return function($value, Mustache_LambdaHelper $helper) {
      return Yii::app()->numberFormatter->formatDecimal($helper->render($value));
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
      return CHtml::encode($helper->render($name));
    };
  }

  /**
   * Formats a number using the percentage format defined in the locale.
   * @property percentage
   * @type Closure
   * @final
	 */
	public function getPercentage($url, Mustache_LambdaHelper $helper) {
    return function($value, Mustache_LambdaHelper $helper) {
      return Yii::app()->numberFormatter->formatPercentage($helper->render($value));
    };
	}

  /**
   * Encloses the given JavaScript within a script tag.
   * @property script
   * @type Closure
   * @final
	 */
	public function getScript() {
    return function($text, Mustache_LambdaHelper $helper) {
      return CHtml::script($helper->render($text));
    };
	}

  /**
   * Creates a relative URL for the specified route.
   * @property url
   * @type Closure
   * @final
   */
  public function getUrl() {
    return function($route, Mustache_LambdaHelper $helper) {
      $value=$helper->render($route);
      return ($controller=Yii::app()->controller) ? $controller->createUrl($value) : Yii::app()->createUrl($value);
    };
  }
}
