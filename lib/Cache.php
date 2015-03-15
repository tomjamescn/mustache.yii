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
 * @param {yii.caching.Cache} $cache The cache application component that is used to store the compiled views.
 * @param {int} [$duration] The number of seconds in which the cached views will expire. 0 means never expire.
 */
class Cache extends \Mustache_Cache_AbstractCache {

  public function __construct(\yii\caching\Cache $cache, $duration=0) {
    $this->cache=$cache;
    $this->duration=$duration;
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
   * The underlying cache application component that is used to cache the compiled views.
   * @property cache
   * @type system.caching.Cache
   * @private
   */
  private $cache;

  /**
   * The time in seconds that the compiled views can remain valid in cache.
   * If set to `0`, the cache never expires.
   * @property duration
   * @type int
   */
  private $duration;

  /**
   * Caches and loads a compiled view.
   * @method cache
   * @param {string} $key The key identifying the view to be cached.
   * @param {string} $value The view to be cached.
   */
  public function cache($key, $value) {
    $this->cache->set(static::CACHE_KEY_PREFIX.$key, $value, $this->duration);
    $this->load($key);
  }

  /**
   * Loads a compiled view from cache.
   * @method load
   * @param {string} $key The key identifying the view to be loaded.
   * @return {boolean} `true` if the view was successfully loaded, otherwise `false`.
   */
  public function load($key) {
    $value=$this->cache[static::CACHE_KEY_PREFIX.$key];
    if($value===false) return false;

    eval('?>'.$value);
    return true;
  }
}
