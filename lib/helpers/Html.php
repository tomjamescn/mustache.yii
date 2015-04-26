<?php
/**
 * Implementation of the `yii\mustache\helpers\Html` class.
 * @module helpers.Html
 */
namespace yii\mustache\helpers;

// Module dependencies.
use yii\helpers\Markdown;
use yii\widgets\Spaceless;

/**
 * Provides a set of methods for generating commonly used HTML tags.
 * @class yii.mustache.helpers.Html
 * @extends mustache.helpers.Helper
 * @constructor
 */
class Html extends Helper {

  /**
   * Marks the beginning of an HTML body section.
   * @property beginBody
   * @type string
   * @final
   */
  public function getBeginBody() {
    $view=\Yii::$app->view;
    if(!$view || !$view->hasMethod('beginBody')) return '';

    ob_start();
    $view->beginBody();
    return ob_get_clean();
  }

  /**
   * Marks the beginning of an HTML page.
   * @property beginPage
   * @type string
   * @final
   */
  public function getBeginPage() {
    $view=\Yii::$app->view;
    if(!$view || !$view->hasMethod('beginPage')) return '';

    ob_start();
    $view->beginPage();
    return ob_get_clean();
  }

  /**
   * Marks the ending of an HTML body section.
   * @property endBody
   * @type string
   * @final
   */
  public function getEndBody() {
    $view=\Yii::$app->view;
    if(!$view || !$view->hasMethod('endBody')) return '';

    ob_start();
    $view->endBody();
    return ob_get_clean();
  }

  /**
   * Marks the ending of an HTML page.
   * @property endPage
   * @type string
   * @final
   */
  public function getEndPage() {
    $view=\Yii::$app->view;
    if(!$view || !$view->hasMethod('endPage')) return '';

    ob_start();
    $view->endPage();
    return ob_get_clean();
  }

  /**
   * Marks the position of an HTML head section.
   * @property head
   * @type string
   * @final
   */
  public function getHead() {
    $view=\Yii::$app->view;
    if(!$view || !$view->hasMethod('head')) return '';

    ob_start();
    $view->head();
    return ob_get_clean();
  }

  /**
   * Converts Markdown into HTML.
   * See: `yii\helpers\Markdown::processParagraph()`
   * @property markdown
   * @type Closure
   * @final
   */
  public function getMarkdown() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'markdown', [ 'flavor'=>Markdown::$defaultFlavor ]);
      return Markdown::processParagraph($args['markdown'], $args['flavor']);
    };
  }

  /**
   * Removes whitespace characters between HTML tags.
   * See: `yii\widgets\Spaceless`
   * @property spaceless
   * @type Closure
   * @final
   */
  public function getSpaceless() {
    return function($value, \Mustache_LambdaHelper $helper) {
      ob_start();
      Spaceless::begin();
      echo $helper->render($value);
      Spaceless::end();
      return ob_get_clean();
    };
  }

  /**
   * Sets the view title.
   * See: `yii\web\View->title`
   * @property viewTitle
   * @type Closure
   * @final
   */
  public function getViewTitle() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $view=\Yii::$app->view;
      if($view && $view->canSetProperty('title')) $view->title=trim($helper->render($value));
    };
  }
}
