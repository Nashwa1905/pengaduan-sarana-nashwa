<?php

// Copy database to writable /tmp on cold start
$tmpDb = '/tmp/database.sqlite';
$buildDb = __DIR__ . '/../database/database.sqlite';

if (!file_exists($tmpDb) && file_exists($buildDb)) {
    copy($buildDb, $tmpDb);
}

$_ENV['DB_DATABASE'] = $tmpDb;

require __DIR__ . '/../public/index.php';
