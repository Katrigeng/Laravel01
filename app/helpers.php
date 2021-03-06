<?php

function get_db_config(){
    if(getenv('IS_IN_HEROKU')){
        $url = parse_url(getenv('DATABASE_URL'));
        //正式环境 pgsql
        return $db_config = [
            'connection' => 'pgsql',
            'host' => $url['post'],
            'database' => substr($url['path'],1),
            'username' => $url['user'],
            'password' => $url['pass'],
        ];
    }else{
        //本地环境 mysql
        return $db_config = [
            'connection' => env('DB_CONNECTION', 'mysql'),
            'host' => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'forge'),
            'username'  => env('DB_USERNAME', 'forge'),
            'password'  => env('DB_PASSWORD', ''),
        ];
    }
}
