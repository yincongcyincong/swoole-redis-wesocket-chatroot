<?php
    $redis = new \Redis();
    $redis->connect('127.0.0.1', 6379);
    $ser = new swoole_websocket_server("172.17.46.31",8080);
    $ser->on('open', function($ser, $request) use($redis) {
        $map[$request->fd] = (string)$request->fd;
        $redis->hmset('uid', $map);
        $ser->push($request->fd, 'connect success');
    });
    $ser->on('message', function($ser, $a) use($redis) {
        $map = [];
        $map = $redis->hgetall('uid');
        foreach ($map as $v) {
            $ser->push($v, $a->data);
        }
    });
    $ser->on('close', function($ser, $fd) use($redis) {
        $redis->hdel('uid', $fd);
    });
    $ser->start();
