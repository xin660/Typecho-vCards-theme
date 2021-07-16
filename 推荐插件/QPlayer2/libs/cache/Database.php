<?php


namespace QPlayer\Cache;

use Exception;
use Typecho_Db;

class Database extends Cache
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = Typecho_Db::get();
        $this->table = $this->db->getPrefix() . 'QPlayer2';
    }

    public function set($key, $data, $expire = 86400)
    {
        $this->db->query($this->db->insert($this->table)->rows(array(
            'key' => md5($key),
            'data' => $data,
            'time' => time() + $expire
        )));
    }

    public function get($key)
    {
        // 回收过期数据
        $this->db->query($this->db->delete($this->table)->where('time <= ?', time()));

        $row = $this->db->fetchRow($this->db->select('data')->from($this->table)->where('key = ?', md5($key)));
        @$data = $row['data'];
        return $data;
    }

    /**
     * @throws Exception
     */
    public function install()
    {
        $adapter = $this->db->getAdapterName();
        switch (true) {
            case false !== strpos($adapter, 'Mysql'):
                $adapter = 'MySQL';
                break;
            case false !== strpos($adapter, 'Pgsql'):
                $adapter = 'PgSQL';
                break;
            case false !== strpos($adapter, 'SQLite'):
                $adapter = 'SQLite';
                break;
            default:
                throw new Exception('Unknown db adapter: ' . $adapter);
        }
        $sql = file_get_contents(__DIR__ . "/$adapter.sql");
        $this->db->query(str_replace('%table%', $this->table, $sql));
    }

    public function uninstall()
    {
        $this->db->query("DROP TABLE IF EXISTS `$this->table`;");
    }

    public function flush()
    {
        $this->db->truncate($this->table);
    }
}