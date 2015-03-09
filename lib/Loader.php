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
   * Loads the view with the specified name.
   * @method load
   * @param {string} $name The view name.
   * @return {string} The view contents.
   * @throws {yii.base.InvalidCallException} Unable to locate the view file.
   * @throws {yii.base.InvalidParamException} The view name is empty.
   */
  public function load($name) {
    if(!isset($this->views[$name])) {
      if(!mb_strlen($name)) throw new InvalidParamException(\Yii::t('yii', 'The view name is empty.'));
      $controller=\Yii::$app->controller;

      if(mb_substr($name, 0, 2)=='//') $file=\Yii::$app->viewPath.'/'.ltrim($name, '/');
      else if($name[0]=='/') {
        if(!$controller) throw new InvalidCallException(\Yii::t('yii', 'Unable to locale the view "{name}": no active controller.', [ 'name'=>$name ]));
        $file=$controller->module->viewPath.'/'.ltrim($view, '/');
      }
      else {
        $viewPath=($controller ? $controller->viewPath : \Yii::$app->viewPath);
        $file=\Yii::getAlias("$viewPath/$name");
      }

      if(!mb_strlen(pathinfo($file, PATHINFO_EXTENSION))) $file.='.'.($controller && ($view=$controller->view) ? $view->defaultExtension : static::DEFAULT_EXTENSION);
      if(!is_file($file)) throw new InvalidCallException(\Yii::t('yii', 'The view file "{file}" does not exist.', [ 'file'=>$file ]));
      $this->views[$name]=@file_get_contents($file);
    }

    return $this->views[$name];
  }
}
