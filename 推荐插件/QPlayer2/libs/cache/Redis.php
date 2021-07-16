<?php


namespace QPlayer\Cache;


class Redis extends Cache
{
    private $redis;

    public function __construct($host, $port)
    {
        if (empty($host)) {
            $host = '127.0.0.1';
        }
        if (empty($port)) {
            $port = 6379;
        }
        $this->redis = new \Redis();
        $this->redis->connect($host, $port);
    }

    public function set($key, $data, $expire = 86400)
    {
        $this->redis->setex($this->getKey($key), $expire, $data);
    }

    public function get($key)
    {
        return $this->redis->get($this->getKey($key));
    }

    public function uninstall()
    {
        $this->redis->del($this->redis->keys($this->prefix . '*'));
    }
}