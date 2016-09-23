<?php
namespace ActiveRecord;

/**
 * A simple, file-based implementation of Cache.
 *
 * Stores cached values as a series of file in the directory passed to its constructor
 *
 * @package ActiveRecord
 */
class File
{
  private $cache_dir;

  /**
   * Creates a File instance.
   *
   * Takes an $options array w/ the following parameters:
   *
   * <ul>
   * <li><b>path:</b> directory to which cache files will be written</li>
   * </ul>
   * @param array $options
   */
  public function __construct($options)
  {
    $this->cache_dir = $options["path"];
  }

  public function flush()
  {
    array_map("unlink", glob($this->get_cache_path_for_key("*")));
  }

  public function read($key)
  {
    $cache_path = $this->get_cache_path_for_key($key);
    return file_exists($cache_path) ? unserialize(file_get_contents($cache_path)) : null;
  }

  public function write($key, $value)
  {
    if (!is_dir($this->cache_dir)) mkdir($this->cache_dir);

    $cache_path = $this->get_cache_path_for_key($key);
    file_put_contents($cache_path, serialize($value));
  }

  private function get_cache_path_for_key($key) {
    return $this->cache_dir . "/" .  $key;
  }
}
