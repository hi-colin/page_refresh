<?php

$url = 'https://www.baidu.com';
$interval_time = 5;

$url_info = parse_url($url);
$scheme = $url_info['scheme'];

refresh($url, $interval_time, $scheme);

function refresh($url, $interval_time, $scheme)
{
    static $i = 0;

    if ($i == 0) {
        echo "准备：=================" . PHP_EOL;
        echo "链接：{$url}" . PHP_EOL;
        echo "间隔时间：{$interval_time} 秒" . PHP_EOL;
        echo "请求次数：{$i} 次" . PHP_EOL;
        echo PHP_EOL;
        echo "开始：=================" . PHP_EOL;
    }

    if ($scheme == 'https') {
        $contextOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ]
        ];
        file_get_contents($url, false, stream_context_create($contextOptions));
    } else {
        file_get_contents($url);
    }

    $i++;
    echo "请求次数：{$i} 次" . PHP_EOL;

    sleep($interval_time);
    refresh($url, $interval_time , $scheme);

}