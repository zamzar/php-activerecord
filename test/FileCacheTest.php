<?php
require_once __DIR__ . "/../lib/cache/File.php";

use ActiveRecord\File;

class FileCacheTest extends SnakeCase_PHPUnit_Framework_TestCase
{
  private $cache, $cache_dir;

  public function set_up() {
    $this->cache_dir = sys_get_temp_dir() . "/phpar-file-cache-test";
    $this->cache = new File(["path" => $this->cache_dir]);
    $this->cache->flush();
  }

  public function test_flushing_clears_all_values()
  {
    $this->cache->write("foo", "bar");
    $this->cache->write("bar", "baz");

    $this->cache->flush();

    $this->assert_null($this->cache->read("foo"));
    $this->assert_null($this->cache->read("bar"));
  }

  public function test_reads_own_writes()
  {
    $this->cache->write("foo", "bar");

    $this->assert_equals("bar", $this->cache->read("foo"));
  }

  public function test_can_store_complex_objects()
  {
    $this->cache->write("foo", new Value("bar"));

    $this->assert_equals(new Value("bar"), $this->cache->read("foo"));
  }

  public function test_creates_cache_directory_if_necessary()
  {
    rmdir($this->cache_dir);
    $this->cache->write("foo", "bar");

    $this->assert_equals("bar", $this->cache->read("foo"));
  }
}

class Value {
  public $raw;

  public function __construct($raw) {
    $this->raw = $raw;
  }
}
