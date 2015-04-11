<?php
/**
 * Implementation of the `yii\mustache\helpers\View` class.
 * @module helpers.View
 */
namespace yii\mustache\helpers;

/**
 * Provides a set of methods for managing views.
 * @class yii.mustache.helpers.View
 * @extends mustache.helpers.Helper
 * @constructor
 * @param {yii.base.View} $view The underlying view to render.
 */
class View extends Helper {

  public function __construct(\yii\base\View $view) {
    $this->view=$view;
  }

  /**
   * The underlying view to render.
   * @property view
   * @type yii.base.View
   * @private
   */
  private $view;

  /**
   * Calls the named method which is not a class method.
   * @method __call
   * @param {string} $name The method name.
   * @param {array} $arguments The method parameters.
   * @return {mixed} The method return value.
   */
  public function __call($name, $arguments) {
    try { return parent::__call($name, $arguments); }
    catch(\Exception $e) { return call_user_func_array([ $this->view, $name ], $arguments); }
  }

  /**
   * Returns a property value, an event handler list or a behavior based on its name.
   * @method __get
   * @param {string} $name The property name or event name.
   * @return {mixed} The property value, event handlers attached to the event, or the named behavior.
   */
  public function __get($name) {
    try { return parent::__get($name); }
    catch(\Exception $e) { return $this->view->$name; }
  }

  /**
   * Checks if a property value is `null`.
   * @method __isset
   * @param {string} $name The property name or event name.
   * @return {boolean} `true` if the property value is `null`, otherwise `false`.
   */
  public function __isset($name) {
    return parent::__isset($name) ? true : isset($this->view->$name);
  }

  /**
   * Sets the page title.
   * See: `yii\web\View->title`
   * @property setTitle
   * @type Closure
   * @final
   */
  public function getSetTitle() {
    return function($value, \Mustache_LambdaHelper $helper) {
      $view=\Yii::$app->view;
      if($view && $view->canSetProperty('title')) $view->title=trim($helper->render($value));
    };
  }
}
