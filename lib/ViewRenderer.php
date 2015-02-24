<?php
/**
 * Implementation of the `yii\mustache\ViewRenderer` class.
 * @module ViewRenderer
 */
namespace yii\mustache;

// Module dependencies.
use yii\base\InvalidParamException;
use yii\caching\FileCache;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\mustache\helpers\FormatHelper;
use yii\mustache\helpers\HtmlHelper;
use yii\mustache\helpers\I18nHelper;

/**
 * View renderer allowing to use the [Mustache](http://mustache.github.io) template syntax.
 * @class yii.mustache.ViewRenderer
 * @extends yii.base.ViewRenderer
 * @constructor
 */
class ViewRenderer extends \yii\base\ViewRenderer {

  /**
   * The directory or path alias pointing to where Mustache cache will be stored.
   * @property cachePath
   * @type string
   * @default "@runtime/mustache/cache"
   */
  public $cachePath='@runtime/mustache/cache';

  /**
   * The underlying Mustache template engine.
   * @property engine
   * @type mustache.Mustache_Engine
   * @private
   */
  private $engine;

  /**
   * The directory or path alias to where the Mustache engine is stored.
   * @property enginePath
   * @type string
   * @default "@vendor/mustache/mustache/src/Mustache"
   */
  public $enginePath='@vendor/mustache/mustache/src/Mustache';

  /**
   * Values prepended to the context stack, so they will be available in any view loaded by this instance.
   * Always `null` until the component is fully initialized.
   * @property helpers
   * @type mustache.Mustache_HelperCollection
   */
  private $helpers=[];

  public function getHelpers() {
    return $this->isInitialized ? $this->engine->getHelpers() : null;
  }

  public function setHelpers(array $value) {
    if($this->isInitialized) $this->engine->setHelpers($value);
    else $this->helpers=$value;
  }

  /**
   * Initializes the application component.
   * @method init
   */
  public function init() {
    /*
    if(!class_exists('\Mustache_Autoloader', false)) {
      require_once \Yii::getAlias($this->enginePath).'@vendor/mustache/mustache/src/Mustache/Autoloader.php';
      \Yii::registerAutoloader([ new \Mustache_Autoloader(), 'autoload' ]);
    }
    */

    $helpers=[
      'app'=>\Yii::$app,
      //'format'=>new FormatHelper(),
      //'html'=>new HtmlHelper(),
      //'i18n'=>new I18nHelper()
    ];

    $options=[
      'charset'=>\Yii::$app->charset,
      'entity_flags'=>ENT_QUOTES,
      'escape'=>function($value) { return Html::encode($value); },
      'helpers'=>ArrayHelper::merge($helpers, $this->helpers),
      // TODO 'logger'=>new Logger(),
      'partials_loader'=>new Loader($this->fileExtension),
      'strict_callables'=>true
    ];

    /* TODO
    if($this->enableCaching) {
      $cache=\Yii::createComponent([
        'class'=>'yii\caching\FileCache',
        'cachePath'=>'@runtime/views/mustache'
      ]);

      if($this->cacheID) {
        $component=\Yii::$app->getComponent($this->cacheID);
        if($component instanceof \ICache) $cache=$component;
      }

      if($cache instanceof FileCache && !is_dir($cache->cachePath)) FileHelper::createDirectory($cache->cachePath);
      $options['cache']=new Cache($cache);
    }*/

    $this->engine=new \Mustache_Engine($options);
    parent::init();
    $this->helpers=[];
  }
  
  /**
   * Renders a view file.
   * @method render
   * @param {yii.web.View} $view The view object used for rendering the file.
   * @param {string} $file The view file.
   * @param {array} $params The parameters to be passed to the view file.
   * @return {string} The rendering result.
   * @throws {yii.base.InvalidCallException} The specified view file is not found.
   */
  public function render($view, $file, $params) {
    if(!is_file($file)) throw new \CException(\Yii::t('yii', 'View file "{file}" does not exist.', [ '{file}'=>$file ]));

    $input=file_get_contents($file);
    $values=ArrayHelper::merge([ 'this'=>$view ], is_array($params) ? $params : []);
    $output=$this->engine->render($input, $values);

    return $output;
  }

  /**
   * Renders a view file.
   * @method renderFile
   * @param {system.web.CBaseController} $context The controller or widget who is rendering the view file.
   * @param {string} $sourceFile The view file path.
   * @param {array} $data The data to be passed to the view.
   * @param {boolean} $return Whether the rendering result should be returned.
   * @return {string} The rendering result, or `null` if the rendering result is not needed.
   * @throws {system.base.CException} The specified view file is not found.
   */
  public function renderFile($context, $sourceFile, $data, $return) {
    if(!is_file($sourceFile)) throw new \CException(\Yii::t('yii', 'View file "{file}" does not exist.', [ '{file}'=>$sourceFile ]));

    $input=file_get_contents($sourceFile);
    $values=\CMap::mergeArray([ 'this'=>$context ], is_array($data) ? $data : []);
    $output=$this->engine->render($input, $values);

    if($return) return $output;
    echo $output;
  }
}
