<?php
/**
 * Implementation of the `yii\mustache\Cache` class.
 * @module Cache
 */
namespace yii\mustache;

/**
 * Component used to store compiled views to a cache application component.
 * @class yii.mustache.Cache
 * @extends mustache.Mustache_Cache_AbstractCache
 * @constructor
 * @param {yii.mustache.ViewRenderer} $renderer The instance used to render the views.
 */
class Cache extends \Mustache_Cache_AbstractCache {

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
  const CACHE_KEY_PREFIX='yii\mustache\Cache:';

  /**
   * The instance used to render the views.
   * @property renderer
   * @type yii.mustache.ViewRenderer
   * @private
   */
  private $renderer;

  /**
   * Caches and loads a compiled view.
   * @method cache
   * @param {string} $key The key identifying the view to be cached.
   * @param {string} $value The view to be cached.
   */
  public function cache($key, $value) {
    $cache=($this->renderer->cacheId ? \Yii::$app->get($this->renderer->cacheId) : null);
    if(!$cache) eval('?>'.$value);
    else {
      $cache->set(static::CACHE_KEY_PREFIX.$key, $value, $this->renderer->cachingDuration);
      $this->load($key);
    }
  }

  /**
   * Loads a compiled view from cache.
   * @method load
   * @param {string} $key The key identifying the view to be loaded.
   * @return {boolean} `true` if the view was successfully loaded, otherwise `false`.
   */
  public function load($key) {
    $cache=($this->renderer->cacheId ? \Yii::$app->get($this->renderer->cacheId) : null);
    $key=static::CACHE_KEY_PREFIX.$key;
    if(!$cache || !$cache->exists($key)) return false;

    eval('?>'.$cache[$key]);
    return true;
  }
}
