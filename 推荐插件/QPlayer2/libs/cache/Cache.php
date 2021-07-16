<?php


namespace QPlayer\Cache;

use Exception;

abstract class Cache
{
    protected $prefix = 'QPlayer2_';

    public abstract function set($key, $data, $expire = 86400);
    public abstract function get($key);

    public function install() {}
    public function uninstall() {}

    public function flush() {
        $this->uninstall();
    }

    /**
     * @throws Exception
     */
    public function test() {
        $id = uniqid();
        $this->set('test', $id, 60);
        if ($this->get('test') != $id) {
            throw new Exception('Cache test error!');
        }
    }

    protected function getKey($key) {
        return $this->prefix . md5($key);
    }

    /**
     * @param string $type
     * @param string $host
     * @param int $port
     * @return Cache
     * @throws Exception
     */
    public static function Build($type, $host, $port)
    {
        $type = ucfirst($type);
        if (!in_array($type, array('Database', 'Memcached', 'Redis'))) {
            throw new Exception("Cache type error: $type");
        }
        include_once("$type.php");
        $type = __NAMESPACE__ . '\\' . $type;
        return new $type($host, $port);
    }

    /**
     * @param $config
     * @return Cache
     * @throws Exception
     */
    public static function BuildWithConfig($config) {
        return self::Build($config->cacheType, $config->cacheHost, $config->cachePort);
    }

    public static function UninstallWithConfig($config) {
        try {
            $cache = self::BuildWithConfig($config);
            $cache->uninstall();
        } catch (Exception $e) {
            echo "<pre>$e</pre>";
        }
    }
}
