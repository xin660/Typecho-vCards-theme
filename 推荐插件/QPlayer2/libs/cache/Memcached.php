<?php


namespace QPlayer\Cache;


class Memcached extends Cache
{
    private $memcached;
    private $prefixId;

    public function __construct($host, $port)
    {
        if (empty($host)) {
            $host = '127.0.0.1';
        }
        if (empty($port)) {
            $port = '11211';
        }
        $this->memcached = new \Memcached();
        $this->memcached->addServer($host, $port);
        assert($this->memcached->getVersion() !== false);

        $key = $this->getIdKey();
        $id = $this->memcached->get($key);
        if (!is_numeric($id)) {
            $this->memcached->set($key, $id = 0);
        }
        $this->prefixId = $id;
    }

    public function set($key, $data, $expire = 86400)
    {
        return $this->memcached->set($this->getKey($key), $data, $expire);
    }

    public function get($key)
    {
        return $this->memcached->get($this->getKey($key));
    }

    protected function getKey($key)
    {
        return parent::getKey($key) . $this->prefixId;
    }

    private function getIdKey() {
        return $this->prefix . 'id';
    }

    public function uninstall()
    {
        $this->memcached->increment($this->getIdKey());
    }
}