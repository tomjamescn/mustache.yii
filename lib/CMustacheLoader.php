<?php
/**
 * Implementation of the `CMustacheLoader` class.
 * @module CMustacheLoader
 */

/**
 * Component used to load views from the file system.
 * @class CMustacheLoader
 * @extends CComponent
 * @constructor
 * @param {string} [$fileExtension] The extension name of the views.
 */
class CMustacheLoader extends CComponent implements Mustache_Loader {

  public function __construct($fileExtension='.mustache') {
    $this->fileExtension=$fileExtension;
  }

  /**
   * The extension name of the views.
   * @property fileExtension
   * @type string
   * @default ".mustache"
   * @private
   */
  private $fileExtension;

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
    $controller=Yii::app()->controller;
    if(!$controller) return Yii::app()->viewPath;

    $viewPath=($theme=Yii::app()->theme ? $theme->viewPath : $controller->viewPath);
    return $module=$controller->module ? $viewPath.'/'.$module->id : $viewPath;
  }

  /**
   * Loads the view with the specified name.
   * @method load
   * @param {string} $name The view name.
   * @return {string} The view contents.
   */
  public function load($name) {
    if(!isset($this->views[$name])) {
      $fileName="{$this->viewPath}/$name";
      if(mb_substr($fileName, 0-mb_strlen($this->fileExtension))!=$this->fileExtension) $fileName.=$this->fileExtension;

      if(!is_file($fileName)) throw new CException(Yii::t('yii', 'View file "{file}" does not exist.', [ '{file}'=>$fileName ]));
      $this->views[$name]=file_get_contents($fileName);
    }

    return $this->views[$name];
  }
}
