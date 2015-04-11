<?php
/**
 * Implementation of the `yii\mustache\helpers\Url` class.
 * @module helpers.Url
 */
namespace yii\mustache\helpers;

/**
 * Provides a set of methods for managing URLs.
 * @class yii.mustache.helpers.Url
 * @extends mustache.helpers.Helper
 * @constructor
 */
class Url extends Helper {

  /**
   * Returns the home URL.
   * See: `yii\helpers\Url::home()`
   * @property home
   * @type Closure
   * @final
   */
  public function getHome() {
    return function($value, \Mustache_LambdaHelper $helper) {
      \Yii::trace($value);
      // TODO
      return \yii\helpers\Url::home($helper->render($value) ?: false);
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
      \Yii::trace($value);
      // TODO
      return \yii\helpers\Url::previous($helper->render($value) ?: null);
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
      return \yii\helpers\Url::to($args['url'], $args['scheme']);
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
      return \yii\helpers\Url::toRoute($args['route'], $args['scheme']);
    };
  }
}
