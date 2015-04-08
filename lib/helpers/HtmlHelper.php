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
   * Sets the page title.
   * See: `yii\web\View->title`
   * @property viewTitle
   * @type Closure
   * @final
   */
  public function getViewTitle() {
    return function($value, \Mustache_LambdaHelper $helper) {
      \Yii::trace(\Yii::$app->view);
      \Yii::$app->view->title=trim($helper->render($value));
    };
  }
}
