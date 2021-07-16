<?php

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

require_once 'libs/Config.php';
require_once 'libs/cache/Cache.php';

use QPlayer\Cache\Cache;
use QPlayer\Config;

class QPlayer2_Action extends Typecho_Widget implements Widget_Interface_Do
{
    /**
     * @throws Exception
     */
    public function action()
    {
        $request = $this->request;

        $do = $request->get('do');
        if ($do == 'flush') {
            $config = Config::getConfig();
            try {
                if ($config->cacheType == 'none') {
                   echo _t('没有配置缓存！');
                } else {
                    Cache::BuildWithConfig($config)->flush();
                    echo _t('操作成功！');
                }
                echo _t('5 秒后自动关闭！');
                echo '<script>setTimeout(window.close, 5000);</script>';
            } catch (Exception $e) {
                throw new Exception(_t('操作失败！'), 0, $e);
            }
            return;
        }

        $server = $request->get('server');
        $type = $request->get('type');
        $id = $request->get('id');

        if (!$this->test($server, $type, $id)) {
            http_response_code(403);
            die();
        }

        include_once 'libs/Meting.php';
        $m = new Metowolf\Meting($server);
        $m->format(true);

        $config = Config::getConfig();
        $cookie = $config->cookie;
        if ($server == 'netease' && !empty($cookie)) {
            $m->cookie($cookie);
        }

        $cache = $config->cacheType == 'none' ? null : Cache::BuildWithConfig($config);
        $key = $server . $type . $id;
        if ($cache != null) {
            $data = $cache->get($key);
        }
        if (empty($data)) {
            $arg2 = null;
            $expire = 7200;
            switch ($type) {
                case 'audio':
                    $type = 'url';
                    $arg2 = $config->bitrate;
                    $expire = 1200;
                    break;
                case 'cover':
                    $type = 'pic';
                    $arg2 = 64;
                    $expire = 86400;
                    break;
                case 'lrc':
                    $type = 'lyric';
                    $expire = 86400;
                    break;
                case 'artist':
                    $arg2 = 50;
                    break;
            }
            $data = $m->$type($id, $arg2);
            $data = json_decode($data, true);
            switch ($type) {
                case 'url':
                case 'pic':
                    $url = $data['url'];
                    if (empty($url)) {
                        if ($server != 'netease') {
                            http_response_code(403);
                            die();
                        }
                        $url = 'https://music.163.com/song/media/outer/url?id=' . $id . '.mp3';
                    } else {
                        $url = preg_replace('/^http:/', 'https:', $url);
                    }
                    $data = $url;
                    break;
                case 'lyric':
                    $data = $data['lyric'] . "\n" . $data['tlyric'];
                    break;
                default:
                    $url = Typecho_Common::url('action/QPlayer2', Helper::options()->index);
                    $array = array();
                    foreach ($data as $v) {
                        $prefix = $url . '?server=' . $v['source'];
                        $array []= array(
                            'name' => $v['name'],
                            'artist' => implode(' / ', $v['artist']),
                            'audio' => $prefix . '&type=audio&id=' . $v['url_id'],
                            'cover' => $prefix . '&type=cover&id=' . $v['pic_id'],
                            'lrc' => $prefix . '&type=lrc&id=' . $v['lyric_id'],
                            'provider' => 'default'
                        );
                    }
                    $data = json_encode($array);
            }
            if ($cache != null) {
                $cache->set($key, $data, $expire);
            }
        }
        switch ($type) {
            case 'url':
            case 'pic':
            case 'audio':
            case 'cover':
                $this->response->redirect($data);
                break;
            case 'lrc':
            case 'lyric':
                header("Content-Type: text/plain");
                break;
            default:
                header("Content-Type: application/json");
                break;
        }
        echo $data;
    }

    private function test($server, $type, $id)
    {
        if (!in_array($server, array('netease', 'tencent', 'baidu', 'xiami', 'kugou'))) {
            return false;
        }
        if (!in_array($type, array('audio', 'cover', 'lrc', 'song', 'album', 'artist', 'playlist'))) {
            return false;
        }
        if (empty($id)) {
            return false;
        }
        return true;
    }
}