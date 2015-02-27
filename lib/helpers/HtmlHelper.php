<?php
/**
 * Implementation of the `yii\mustache\helpers\HtmlHelper` class.
 * @module helpers.HtmlHelper
 */
namespace yii\mustache\helpers;

// Module dependencies.
use yii\helpers\Html;

/**
 * Provides a collection of helper methods for creating views.
 * @class yii.mustache.helpers.HtmlHelper
 * @extends mustache.helpers.Helper
 * @constructor
 */
class HtmlHelper extends Helper {

  /**
   * Generates the JavaScript that initiates an AJAX request.
   * See: `Html::ajax()`
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
   * See: `Html::ajaxButton()`
   * @property ajaxButton
   * @type Closure
   * @final
   */
  public function getAjaxButton() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'label', [
        'ajaxOptions'=>[],
        'htmlOptions'=>[],
        'url'=>''
      ]);

      return Html::ajaxButton($args['label'], $args['url'], $args['ajaxOptions'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a link that can initiate AJAX requests.
   * See: `Html::ajaxLink()`
   * @property ajaxLink
   * @type Closure
   * @final
   */
  public function getAjaxLink() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'text', [
        'ajaxOptions'=>[],
        'htmlOptions'=>[],
        'url'=>''
      ]);

      return Html::ajaxLink($args['text'], $args['url'], $args['ajaxOptions'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a push button that can submit the current form in POST method.
   * See: `Html::ajaxSubmitButton()`
   * @property ajaxSubmitButton
   * @type Closure
   * @final
   */
  public function getAjaxSubmitButton() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'label', [
        'ajaxOptions'=>[],
        'htmlOptions'=>[],
        'url'=>''
      ]);

      return Html::ajaxSubmitButton($args['label'], $args['url'], $args['ajaxOptions'], $args['htmlOptions']);
    };
  }

  /**
   * Generates the URL for the published assets.
   * See: `Html::asset()`
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
   * See: `Html::beginForm()`
   * @property beginForm
   * @type Closure
   * @final
   */
  public function getBeginForm() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'action', [
        'htmlOptions'=>[],
        'method'=>'post'
      ]);

      return Html::beginForm($args['action'], $args['method'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a button.
   * See: `Html::button()`
   * @property button
   * @type Closure
   * @final
   */
  public function getButton() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'label', [ 'htmlOptions'=>[] ]);
      return Html::button($args['label'], $args['htmlOptions']);
    };
  }

  /**
   * Encloses the given string within a CDATA tag.
   * See: `Html::cdata()`
   * @property cdata
   * @type Closure
   * @final
   */
  public function getCdata() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::cdata($helper->render($value));
    };
  }

  /**
   * Generates a check box.
   * See: `Html::checkBox()`
   * @property checkBox
   * @type Closure
   * @final
   */
  public function getCheckBox() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'checked'=>false,
        'htmlOptions'=>[]
      ]);

      return Html::checkBox($args['name'], $args['checked'], $args['htmlOptions']);
    };
  }

  /**
   * Creates an absolute URL for the specified route.
   * See: `CController->createAbsoluteUrl()`
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
   * See: `CController->createUrl()`
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
   * See: `CHttpRequest->csrfToken`
   * @property csrfTokenField
   * @type string
   * @final
   */
  public function getCsrfTokenField() {
    $request=\Yii::$app->request;
    return !$request->enableCsrfValidation ? '' : Html::hiddenField($request->csrfTokenName, $request->csrfToken, [ 'id'=>false ]);
  }

  /**
   * Encloses the given CSS content with a CSS tag.
   * See: `Html::css()`
   * @property css
   * @type Closure
   * @final
   */
  public function getCss() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'text', [ 'media'=>'' ]);
      return Html::css($args['text'], $args['media']);
    };
  }

  /**
   * Generates a date field input.
   * See: `Html::dateField()`
   * @property dateField
   * @type Closure
   * @final
   */
  public function getDateField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      return Html::dateField($args['name'], $args['value'], $args['htmlOptions']);
    };
  }

  /**
   * Generates an email field input.
   * See: `Html::emailField()`
   * @property emailField
   * @type Closure
   * @final
   */
  public function getEmailField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      return Html::emailField($args['name'], $args['value'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a closing form tag.
   * See: `Html::endForm()`
   * @property endForm
   * @type string
   * @final
   */
  public function getEndForm() {
    return Html::endForm();
  }

  /**
   * Generates a file input.
   * See: `Html::fileField()`
   * @property fileField
   * @type Closure
   * @final
   */
  public function getFileField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      return Html::fileField($args['name'], $args['value'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a hidden input.
   * See: `Html::hiddenField()`
   * @property hiddenField
   * @type Closure
   * @final
   */
  public function getHiddenField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      return Html::hiddenField($args['name'], $args['value'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a button using HTML button tag.
   * See: `Html::htmlButton()`
   * @property htmlButton
   * @type Closure
   * @final
   */
  public function getHtmlButton() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'label', [ 'htmlOptions'=>[] ]);
      return Html::htmlButton($args['label'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a valid HTML identifier based on name.
   * See: `Html::idByName()`
   * @property idByName
   * @type Closure
   * @final
   */
  public function getIdByName() {
    return function($value, \Mustache_LambdaHelper $helper) {
      return Html::idByName($helper->render($value));
    };
  }

  /**
   * Generates an image submit button.
   * See: `Html::imageButton()`
   * @property imageButton
   * @type Closure
   * @final
   */
  public function getImageButton() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'src', [ 'htmlOptions'=>[] ]);
      return Html::imageButton($args['src'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a label tag.
   * See: `Html::label()`
   * @property label
   * @type Closure
   * @final
   */
  public function getLabel() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'label', [
        'for'=>false,
        'htmlOptions'=>[]
      ]);

      return Html::label($args['label'], $args['for'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a hyperlink tag.
   * See: `Html::link()`
   * @property link
   * @type Closure
   * @final
   */
  public function getLink() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'text', [
        'htmlOptions'=>[],
        'url'=>'#'
      ]);

      return Html::link($args['text'], $args['url'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a link submit button.
   * See: `Html::linkButton()`
   * @property linkButton
   * @type Closure
   * @final
   */
  public function getLinkButton() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'label', [ 'htmlOptions'=>[] ]);
      return Html::linkButton($args['label'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a mailto link.
   * See: `Html::mailto()`
   * @property mailto
   * @type Closure
   * @final
   */
  public function getMailto() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'text', [
        'email'=>'',
        'htmlOptions'=>[]
      ]);

      return Html::mailto($args['text'], $args['email'], $args['htmlOptions']);
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
      return preg_replace('/\r?\n/', Html::$closeSingleTags ? '<br />' : '<br>', $helper->render($value));
    };
  }

  /**
   * Generates a number field input.
   * See: `Html::numberField()`
   * @property numberField
   * @type Closure
   * @final
   */
  public function getNumberField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      return Html::numberField($args['name'], $args['value'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a hidden field for storing persistent page states.
   * See: `Html::pageStateField()`
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
   * Generates a password field input.
   * See: `Html::passwordField()`
   * @property passwordField
   * @type Closure
   * @final
   */
  public function getPasswordField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      return Html::passwordField($args['name'], $args['value'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a radio button.
   * See: `Html::radioButton()`
   * @property radioButton
   * @type Closure
   * @final
   */
  public function getRadioButton() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'checked'=>false,
        'htmlOptions'=>[]
      ]);

      return Html::radioButton($args['name'], $args['checked'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a range field input.
   * See: `Html::rangeField()`
   * @property rangeField
   * @type Closure
   * @final
   */
  public function getRangeField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      return Html::rangeField($args['name'], $args['value'], $args['htmlOptions']);
    };
  }

  /**
   * Registers a `refresh` meta tag.
   * See: `Html::refresh()`
   * @property refresh
   * @type Closure
   * @final
   */
  public function getRefresh() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'seconds', [ 'url'=>'' ]);
      return Html::refresh($args['seconds'], $args['url']);
    };
  }

  /**
   * Generates a reset button.
   * See: `Html::resetButton()`
   * @property resetButton
   * @type Closure
   * @final
   */
  public function getResetButton() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'label', [ 'htmlOptions'=>[] ]);
      return Html::resetButton($args['label'], $args['htmlOptions']);
    };
  }

  /**
   * Encloses the given JavaScript within a script tag.
   * See: `Html::script()`
   * @property script
   * @type Closure
   * @final
   */
  public function getScript() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'text', [ 'htmlOptions'=>[] ]);
      return Html::script($args['text'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a search field input.
   * See: `Html::searchField()`
   * @property searchField
   * @type Closure
   * @final
   */
  public function getSearchField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      Html::clientChange('change', $args['htmlOptions']);
      return Html::inputField('search', $args['name'], $args['value'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a stateful form tag.
   * See: `Html::statefulForm()`
   * @property statefulForm
   * @type Closure
   * @final
   */
  public function getStatefulForm() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'action', [
        'htmlOptions'=>[],
        'method'=>'post'
      ]);

      return Html::statefulForm($args['action'], $args['method'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a submit button.
   * See: `Html::submitButton()`
   * @property submitButton
   * @type Closure
   * @final
   */
  public function getSubmitButton() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'label', [ 'htmlOptions'=>[] ]);
      return Html::submitButton($args['label'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a telephone field input.
   * See: `Html::telField()`
   * @property telField
   * @type Closure
   * @final
   */
  public function getTelField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      return Html::telField($args['name'], $args['value'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a text area input.
   * See: `Html::textArea()`
   * @property textArea
   * @type Closure
   * @final
   */
  public function getTextArea() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      return Html::textArea($args['name'], $args['value'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a text field input.
   * See: `Html::textField()`
   * @property textField
   * @type Closure
   * @final
   */
  public function getTextField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      return Html::textField($args['name'], $args['value'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a time field input.
   * See: `Html::timeField()`
   * @property timeField
   * @type Closure
   * @final
   */
  public function getTimeField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      return Html::timeField($args['name'], $args['value'], $args['htmlOptions']);
    };
  }

  /**
   * Generates a URL field input.
   * See: `Html::urlField()`
   * @property urlField
   * @type Closure
   * @final
   */
  public function getUrlField() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'name', [
        'htmlOptions'=>[],
        'value'=>''
      ]);

      return Html::urlField($args['name'], $args['value'], $args['htmlOptions']);
    };
  }
}
