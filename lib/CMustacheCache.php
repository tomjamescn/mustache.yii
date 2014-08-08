<?php
/**
 * Implementation of the `CMustacheCache` class.
 * @module CMustacheCache
 */

/**
 * Component used to store compiled views to a cache application component.
 * @class CMustacheCache
 * @extends Mustache_Cache_AbstractCache
 * @constructor
 * @param {ICache} $cache The cache application component that is used to store the compiled views.
 */
class CMustacheCache extends Mustache_Cache_AbstractCache {

  public function __construct(ICache $cache) {
    $this->cache=$cache;
  }

  /**
   * The string prefixed to every cache key in order to avoid name collisions.
   * @property KEY_PREFIX
   * @type string
   * @final
   */
  const KEY_PREFIX='mustache:';

  /**
   * The cache application component that is used to cache the compiled views.
   * @property cache
   * @type ICache
   * @private
   */
  private $cache;

  /**
   * Caches and loads a compiled view.
   * @method cache
   * @param {string} $key The key identifying the view to be cached.
   * @param {string} $value The view to be cached.
   */
  public function cache($key, $value) {
    $this->cache->set(static::KEY_PREFIX.$key, $value);
    $this->load($key);
  }

  /**
   * Loads a compiled view from cache.
   * @method load
   * @param {string} $key The key identifying the view to be loaded.
   * @return {bool} `true` if the view was successfully loaded, otherwise `false`.
   */
  public function load($key) {
    $value=$this->cache->get(static::KEY_PREFIX.$key);
    if($value===false) return false;

    eval('?>'.$value);
    return true;
  }
}
