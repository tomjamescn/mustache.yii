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

/**
 * Loads views from the file system.
 * @class yii.mustache.Loader
 * @extends yii.base.Object
 * @constructor
 */
class Loader extends Object implements \Mustache_Loader {

  /**
   * The default extension of template files.
   * @property DEFAULT_EXTENSION
   * @type string
   * @final
   * @static
   */
  const DEFAULT_EXTENSION='mustache';

  /**
   * The loaded views.
   * @property views
   * @type array
   * @private
   */
  private $views=[];

  /**
   * The path of the directory containing the views.
   * @property viewPath
   * @type string
   * @final
   */
  public function getViewPath() {
    $controller=\Yii::$app->controller;
    if(!$controller) return \Yii::$app->viewPath;
    return ($theme=$controller->view->theme) ? $theme->basePath : $controller->viewPath;
  }

  /**
   * Loads the view with the specified name.
   * @method load
   * @param {string} $name The view name.
   * @return {string} The view contents.
   * @throws {yii.base.InvalidCallException} The view file does not exist.
   * @throws {yii.base.InvalidParamException} The view name is empty.
   */
  public function load($name) {
    if(!isset($this->views[$name])) {
      if(!mb_strlen($name)) throw new InvalidParamException(\Yii::t('yii', 'View "{name}" does not exist.', [ 'name'=>$name ]));

      $fileName=\Yii::getAlias(mb_substr($name, 0, 2)=='//' ? \Yii::$app->viewPath.'/'.mb_substr($name, 2) : $this->viewPath.'/'.$name);
      if(!mb_strlen(pathinfo($fileName, PATHINFO_EXTENSION))) {
        $controller=\Yii::$app->controller;
        $fileName.='.'.($controller && ($view=$controller->view) ? $view->defaultExtension : static::DEFAULT_EXTENSION);
      }

      if(!is_file($fileName)) throw new InvalidCallException(\Yii::t('yii', 'View file "{file}" does not exist.', [ 'file'=>$fileName ]));
      $this->views[$name]=@file_get_contents($fileName);
    }

    return $this->views[$name];
  }
}
