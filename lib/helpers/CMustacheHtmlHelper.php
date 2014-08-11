<?php
/**
 * Implementation of the `CMustacheHtmlHelper` class.
 * @module CMustacheHtmlHelper
 */
Yii::import('mustache.CMustacheHelper');

/**
 * Component providing a collection of helper methods for creating views.
 * @class CMustacheHtmlHelper
 * @extends CMustacheHelper
 * @constructor
 */
class CMustacheHtmlHelper extends CMustacheHelper {

  /**
   * Creates an absolute URL for the specified route.
   * See: `CController->createAbsoluteUrl()`
   * @property absoluteUrl
   * @type Closure
   * @final
   */
  public function getAbsoluteUrl() {
    return function($value, Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'route', [
        'ampersand'=>'&',
        'params'=>[]
      ]);

      $controller=Yii::app()->controller;
      $callback=($controller ? [ $controller, 'createAbsoluteUrl' ] : [ Yii::app(), 'createAbsoluteUrl' ]);
      return call_user_func($callback, $args['route'], $args['params'], $args['ampersand']);
    };
  }

  /**
   * Generates the URL for the published assets.
   * See: `CHtml::asset()`
   * @property asset
   * @type Closure
   * @final
   */
	public function getAsset() {
    return function($value, Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'path', [ 'hashByName'=>false ]);
      return CHtml::asset($args['path'], $args['hashByName']);
    };
	}

  /**
   * Generates a hidden field for storing the token used to perform CSRF validation.
   * See: `CHttpRequest->csrfToken`
   * @property csrfTokenField
   * @type string
   * @final
   */
  public function getCsrfTokenField() {
    $request=Yii::app()->request;
    return !$request->enableCsrfValidation ? '' : CHtml::hiddenField($request->csrfTokenName, $request->csrfToken, [ 'id'=>false ]);
  }

  /**
   * Generates a valid HTML identifier based on name.
   * See: `CHtml::idByName()`
   * @property idByName
   * @type Closure
   * @final
   */
  public function getIdByName() {
    return function($value, Mustache_LambdaHelper $helper) {
      return CHtml::idByName($helper->render($value));
    };
  }

  /**
   * Generates a hidden field for storing persistent page states.
   * See: `CHtml::pageStateField()`
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
   * Returns a string that can be displayed on your Web page showing Powered-by-Yii information.
   * See: `Yii::powered()`
   * @property powered
   * @type string
   * @final
   */
  public function getPowered() {
    return Yii::powered();
  }

  /**
   * Registers a `refresh` meta tag.
   * See: `CHtml::refresh()`
   * @property refresh
   * @type Closure
   * @final
   */
	public function getRefresh() {
    return function($value, Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'seconds', [ 'url'=>'' ]);
      return CHtml::refresh($args['seconds'], $args['url']);
    };
	}

  /**
   * Translates a message to the specified language.
   * See: `Yii::t()`
   * @property translate
   * @type Closure
   * @final
   */
  public function getTranslate() {
    return function($value, Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'message', [
        'category'=>'application',
        'language'=>null,
        'params'=>[],
        'source'=>null
      ]);

      return CHtml::encode(Yii::t($args['category'], $args['message'], $args['params'], $args['source'], $args['language']));
    };
  }

  /**
   * Creates a relative URL for the specified route.
   * See: `CController->createUrl()`
   * @property url
   * @type Closure
   * @final
   */
  public function getUrl() {
    return function($value, Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'route', [
        'ampersand'=>'&',
        'params'=>[]
      ]);

      $controller=Yii::app()->controller;
      $callback=($controller ? [ $controller, 'createUrl' ] : [ Yii::app(), 'createUrl' ]);
      return call_user_func($callback, $args['route'], $args['params'], $args['ampersand']);
    };
  }
}
