<?php
namespace ActiveRecord;

class Memcache
{
	const DEFAULT_PORT = 11211;

	private $memcached;

	/**
	 * Creates a Memcache instance.
	 *
	 * Takes an $options array w/ the following parameters:
	 *
	 * <ul>
	 * <li><b>host:</b> host for the memcached server </li>
	 * <li><b>port:</b> port for the memcached server </li>
	 * </ul>
	 * @param array $options
	 */
	public function __construct($options)
	{
		$this->memcached = new \Memcached();
		$options['port'] = isset($options['port']) ? $options['port'] : self::DEFAULT_PORT;

		if (!$this->memcached->addServer($options['host'],$options['port']))
			throw new CacheException("Could not connect to $options[host]:$options[port]");
	}

	public function flush()
	{
		$this->memcached->flush();
	}

	public function read($key)
	{
		return $this->memcached->get($key);
	}

	public function write($key, $value, $expire)
	{
		$this->memcached->set($key,$value,$expire);
	}
}

