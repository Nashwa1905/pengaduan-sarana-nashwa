<?php

// Vercel: copy database to /tmp (writable) on cold start
$tmpDb = '/tmp/database.sqlite';
$buildDb = __DIR__ . '/../database/database.sqlite';

if (!file_exists($tmpDb) && file_exists($buildDb)) {
    copy($buildDb, $tmpDb);
}

// Point Laravel to writable database
$_ENV['DB_DATABASE'] = $tmpDb;
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['CACHE_STORE'] = 'file';
$_ENV['QUEUE_CONNECTION'] = 'sync';

require __DIR__ . '/../public/index.php';
