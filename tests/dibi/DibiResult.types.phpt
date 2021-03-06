<?php

use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$conn = new DibiConnection($config);
$conn->loadFile(__DIR__ . "/data/$config[system].sql");

$res = $conn->query('SELECT * FROM [customers]');

// auto-converts this column to integer
$res->setType('customer_id', Dibi::DATETIME, 'H:i j.n.Y');

Assert::equal(new DibiRow(array(
	'customer_id' => new DibiDateTime('1970-01-01 01:00:01'),
	'name' => 'Dave Lister',
)), $res->fetch());
