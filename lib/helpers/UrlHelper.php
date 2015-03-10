<?php
/**
 * Implementation of the `yii\mustache\helpers\UrlHelper` class.
 * @module helpers.UrlHelper
 */
namespace yii\mustache\helpers;

// Module dependencies.
use yii\helpers\Url;

/**
 * Provides a collection of helper methods for managing URLs.
 * @class yii.mustache.helpers.UrlHelper
 * @extends mustache.helpers.Helper
 * @constructor
 */
class UrlHelper extends Helper {

  /**
   * Creates a URL based on the given parameters.
   * See: `yii\helpers\Url::to()`
   * @property to
   * @type Closure
   * @final
   */
  public function getTo() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'url', [ 'scheme'=>false ]);
      return Url::to($args['url'], $args['scheme']);
    };
  }

  /**
   * Creates a URL for the given route.
   * See: `yii\helpers\Url::toRoute()`
   * @property toRoute
   * @type Closure
   * @final
   */
  public function getToRoute() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $args=$this->parseArguments($helper->render($value), 'route', [ 'scheme'=>false ]);
      return Url::toRoute($args['route'], $args['scheme']);
    };
  }
}
