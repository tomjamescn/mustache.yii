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
}
