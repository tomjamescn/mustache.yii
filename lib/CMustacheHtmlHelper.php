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
}
