<?php
/**
 * Implementation of the `yii\mustache\helpers\HtmlHelper` class.
 * @module helpers.HtmlHelper
 */
namespace yii\mustache\helpers;

// Module dependencies.
use yii\helpers\Html;
use yii\helpers\Markdown;

/**
 * Provides a collection of helper methods for creating views.
 * @class yii.mustache.helpers.HtmlHelper
 * @extends mustache.helpers.Helper
 * @constructor
 */
class HtmlHelper extends Helper {

  /**
   * Generates the JavaScript that initiates an AJAX request.
   * See: `yii\helpers\Html::ajax()`
   * @property ajax
   * @type Closure
   * @final
   */
  public function getAjax() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'options');
      return Html::ajax($args['options']);
    };
  }

  /**
   * Generates a push button that can initiate AJAX requests.
   * See: `yii\helpers\Html::ajaxButton()`
   * @property ajaxButton
   * @type Closure
   * @final
   */
  public function getAjaxButton() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'label', [
        'ajaxOptions'=>[],
        'options'=>[],
        'url'=>''
      ]);

      return Html::ajaxButton($args['label'], $args['url'], $args['ajaxOptions'], $args['options']);
    };
  }

  /**
   * Generates a link that can initiate AJAX requests.
   * See: `yii\helpers\Html::ajaxLink()`
   * @property ajaxLink
   * @type Closure
   * @final
   */
  public function getAjaxLink() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'text', [
        'ajaxOptions'=>[],
        'options'=>[],
        'url'=>''
      ]);

      return Html::ajaxLink($args['text'], $args['url'], $args['ajaxOptions'], $args['options']);
    };
  }

  /**
   * Generates a push button that can submit the current form in POST method.
   * See: `yii\helpers\Html::ajaxSubmitButton()`
   * @property ajaxSubmitButton
   * @type Closure
   * @final
   */
  public function getAjaxSubmitButton() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'label', [
        'ajaxOptions'=>[],
        'options'=>[],
        'url'=>''
      ]);

      return Html::ajaxSubmitButton($args['label'], $args['url'], $args['ajaxOptions'], $args['options']);
    };
  }

  /**
   * Generates the URL for the published assets.
   * See: `yii\helpers\Html::asset()`
   * @property asset
   * @type Closure
   * @final
   */
  public function getAsset() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'path', [ 'hashByName'=>false ]);
      return Html::asset($args['path'], $args['hashByName']);
    };
  }

  /**
   * Generates an opening form tag.
   * See: `yii\helpers\Html::beginForm()`
   * @property beginForm
   * @type Closure
   * @final
   */
  public function getBeginForm() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'action', [
        'options'=>[],
        'method'=>'post'
      ]);

      return Html::beginForm($args['action'], $args['method'], $args['options']);
    };
  }

  /**
   * Creates an absolute URL for the specified route.
   * See: `yii\base\Controller->createAbsoluteUrl()`
   * @property createAbsoluteUrl
   * @type Closure
   * @final
   */
  public function getCreateAbsoluteUrl() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'route', [
        'ampersand'=>'&',
        'params'=>[]
      ]);

      $controller=\Yii::$app->controller;
      $callback=($controller ? [ $controller, 'createAbsoluteUrl' ] : [ \Yii::$app, 'createAbsoluteUrl' ]);
      return call_user_func($callback, $args['route'], $args['params'], $args['ampersand']);
    };
  }

  /**
   * Creates a relative URL for the specified route.
   * See: `yii\base\Controller->createUrl()`
   * @property createUrl
   * @type Closure
   * @final
   */
  public function getCreateUrl() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'route', [
        'ampersand'=>'&',
        'params'=>[]
      ]);

      $controller=\Yii::$app->controller;
      $callback=($controller ? [ $controller, 'createUrl' ] : [ \Yii::$app, 'createUrl' ]);
      return call_user_func($callback, $args['route'], $args['params'], $args['ampersand']);
    };
  }

  /**
   * Generates a hidden field for storing the token used to perform CSRF validation.
   * See: `yii\web\Request->csrfToken`
   * @property csrfTokenField
   * @type string
   * @final
   */
  public function getCsrfTokenField() {
    $request=\Yii::$app->request;
    return !$request->enableCsrfValidation ? '' : Html::hiddenField($request->csrfTokenName, $request->csrfToken, [ 'id'=>false ]);
  }

  /**
   * Generates a valid HTML identifier based on name.
   * See: `yii\helpers\Html::idByName()`
   * @property idByName
   * @type Closure
   * @final
   */
  public function getIdByName() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::idByName($helper->render($value));
    };
  }

  // TODO
  public function getMarkdown() {
    return function($value, \Mustache_LambdaHelper $helper) {
      \Yii::trace($value, 'mustache');
      $args=$this->parseArguments($helper->render($value), 'markdown', [ 'flavor'=>Markdown::$defaultFlavor ]);
      \Yii::trace($args['markdown'], 'mustache');
      \Yii::trace($args['flavor'], 'mustache');
      \Yii::trace(Markdown::processParagraph($args['markdown']));
      return Markdown::processParagraph($args['markdown'], $args['flavor']);
    };
  }

  /**
   * Inserts HTML line breaks before all newlines in a string.
   * See: `nl2br()`
   * @property nl2br
   * @type Closure
   * @final
   */
  public function getNl2br() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return preg_replace('/\r?\n/', '<br>', Html::encode($helper->render($value)));
    };
  }

  /**
   * Generates a hidden field for storing persistent page states.
   * See: `yii\helpers\Html::pageStateField()`
   * @property pageStateField
   * @type Closure
   * @final
   */
  public function getPageStateField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::pageStateField($helper->render($value));
    };
  }

  /**
   * Generates a stateful form tag.
   * See: `yii\helpers\Html::statefulForm()`
   * @property statefulForm
   * @type Closure
   * @final
   */
  public function getStatefulForm() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'action', [
        'method'=>'post',
        'options'=>[]
      ]);

      return Html::statefulForm($args['action'], $args['method'], $args['options']);
    };
  }
}
