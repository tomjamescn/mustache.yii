<?php
/**
 * Implementation of the `yii\mustache\helpers\Url` class.
 * @module helpers.Url
 */
namespace yii\mustache\helpers;

// Module dependencies.
use yii\helpers\Url as UrlHelper;

/**
 * Provides a set of methods for managing URLs.
 * @class yii.mustache.helpers.Url
 * @extends mustache.helpers.Helper
 * @constructor
 */
class Url extends Helper {

  /**
   * Returns the base URL of the current request.
   * See: `yii\helpers\Url::base()`
   * @property base
   * @type Closure
   * @final
   */
  public function getBase() {
    return function($value, \Mustache_LambdaHelper $helper) {
      \Yii::trace($value, 'aquafadas\UrlHelper');
      // TODO
      return UrlHelper::base($helper->render($value) ?: false);
    };
  }

  /**
   * Returns the canonical URL of the currently requested page.
   * See: `yii\helpers\Url::canonical()`
   * @property canonical
   * @type string
   * @final
   */
  public function getCanonical() {
    return UrlHelper::canonical();
  }

  /**
   * Returns the home URL.
   * See: `yii\helpers\Url::current()`
   * @property current
   * @type Closure
   * @final
   */
  public function getCurrent() {
    return function($value, \Mustache_LambdaHelper $helper) {
      \Yii::trace($value, 'aquafadas\UrlHelper');
      // TODO
      $args=$this->parseArguments($helper->render($value), 'params', [ 'scheme'=>false ]);
      return UrlHelper::current($args['params'], $args['scheme']);
    };
  }

  /**
   * Returns the home URL.
   * See: `yii\helpers\Url::home()`
   * @property home
   * @type Closure
   * @final
   */
  public function getHome() {
    return function($value, \Mustache_LambdaHelper $helper) {
      \Yii::trace($value, 'aquafadas\UrlHelper');
      // TODO
      return UrlHelper::home($helper->render($value) ?: false);
    };
  }

  /**
   * Returns the URL previously remembered.
   * See: `yii\helpers\Url::previous()`
   * @property previous
   * @type Closure
   * @final
   */
  public function getPrevious() {
    return function($value, \Mustache_LambdaHelper $helper) {
      \Yii::trace($value, 'aquafadas\UrlHelper');
      // TODO
      return UrlHelper::previous($helper->render($value) ?: null);
    };
  }

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
      return UrlHelper::to($args['url'], $args['scheme']);
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
      return UrlHelper::toRoute($args['route'], $args['scheme']);
    };
  }
}
