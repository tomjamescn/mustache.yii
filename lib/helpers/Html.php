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

    return $this->captureOutput(function() use($view) {
      $view->beginBody();
    });
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

    return $this->captureOutput(function() use($view) {
      $view->beginPage();
    });
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

    return $this->captureOutput(function() use($view) {
      $view->endBody();
    });
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

    return $this->captureOutput(function() use($view) {
      $view->endPage();
    });
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

    return $this->captureOutput(function() use($view) {
      $view->head();
    });
  }

  /**
   * Converts Markdown into HTML.
   * See: `yii\helpers\Markdown::process()`
   * @property markdown
   * @type Closure
   * @final
   */
  public function getMarkdown() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'markdown', [ 'flavor'=>Markdown::$defaultFlavor ]);
      return Markdown::process($args['markdown'], $args['flavor']);
    };
  }

  /**
   * Converts Markdown into HTML but only parses inline elements.
   * See: `yii\helpers\Markdown::processParagraph()`
   * @property markdownParagraph
   * @type Closure
   * @final
   */
  public function getMarkdownParagraph() {
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
      return $this->captureOutput(function() use($helper, $value) {
        Spaceless::begin();
        echo $helper->render($value);
        Spaceless::end();
      });
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
