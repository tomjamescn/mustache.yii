<?php
/**
 * Implementation of the `yii\mustache\Loader` class.
 * @module Loader
 */
namespace yii\mustache;

// Module dependencies.
use yii\base\InvalidCallException;
use yii\base\InvalidParamException;
use yii\base\Object;
use yii\helpers\FileHelper;

/**
 * Loads views from the file system.
 * @class yii.mustache.Loader
 * @extends yii.base.Object
 * @constructor
 * @param {yii.mustache.ViewRenderer} $renderer The instance used to render the views.
 */
class Loader extends Object implements \Mustache_Loader {

  public function __construct(ViewRenderer $renderer) {
    $this->renderer=$renderer;
  }

  /**
   * The string prefixed to every cache key in order to avoid name collisions.
   * @property CACHE_KEY_PREFIX
   * @type string
   * @static
   * @final
   */
  const CACHE_KEY_PREFIX='yii\mustache\Loader:';

  /**
   * The default extension of template files.
   * @property DEFAULT_EXTENSION
   * @type string
   * @final
   * @static
   */
  const DEFAULT_EXTENSION='mustache';

  /**
   * The instance used to render the views.
   * @property renderer
   * @type yii.mustache.ViewRenderer
   * @private
   */
  private $renderer;

  /**
   * The loaded views.
   * @property views
   * @type array
   * @private
   */
  private $views=[];

  /**
   * Loads the view with the specified name.
   * @method load
   * @param {string} $name The view name.
   * @return {string} The view contents.
   * @throws {yii.base.InvalidCallException} Unable to locate the view file.
   * @throws {yii.base.InvalidParamException} The view name is empty.
   */
  public function load($name) {
    if(!isset($this->views[$name])) {
      $cache=($this->renderer->cacheId ? \Yii::$app->get($this->renderer->cacheId) : null);
      $key=static::CACHE_KEY_PREFIX.$name;

      if($cache && $cache->exists($key)) $output=$cache[$key];
      else {
        if(!mb_strlen($name)) throw new InvalidParamException(\Yii::t('yii', 'The view name is empty.'));
        $controller=\Yii::$app->controller;

        if(mb_substr($name, 0, 2)=='//') $file=\Yii::$app->viewPath.'/'.ltrim($name, '/');
        else if($name[0]=='/') {
          if(!$controller) throw new InvalidCallException(\Yii::t('yii', 'Unable to locale the view "{name}": no active controller.', [ 'name'=>$name ]));
          $file=$controller->module->viewPath.'/'.ltrim($name, '/');
        }
        else {
          $viewPath=($controller ? $controller->viewPath : \Yii::$app->viewPath);
          $file=\Yii::getAlias("$viewPath/$name");
        }

        $view=($controller ? $controller->view : null);
        if($view && $view->theme) $file=$view->theme->applyTo($file);
        if(!mb_strlen(pathinfo($file, PATHINFO_EXTENSION))) $file.='.'.($view ? $view->defaultExtension : static::DEFAULT_EXTENSION);

        $path=FileHelper::localize($file);
        if(!is_file($path)) throw new InvalidCallException(\Yii::t('yii', 'The view file "{file}" does not exist.', [ 'file'=>$file ]));

        $output=@file_get_contents($path);
        if($cache) $cache->set($key, $output, $this->renderer->cachingDuration);
      }

      $this->views[$name]=$output;
    }

    return $this->views[$name];
  }
}
