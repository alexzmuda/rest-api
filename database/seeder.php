<?php

require '../bootstrap.php';

$statement = "
    INSERT INTO conversions
        (id, name, status)
    VALUES
        (1, 'test-file-1', 0),
        (2, 'test-file-2', 0),
        (3, 'test-file-3', 0),
        (4, 'test-file-4', 0),
        (5, 'test-file-5', 0),
        (6, 'test-file-6', 0),
        (7, 'test-file-7', 0),
        (8, 'test-file-8', 0);
    ";

try {
	$seeding = $dbConnection->exec($statement);
	echo "Seeding Completed!\n";
} catch (\PDOException $e) {
	exit($e->getMessage());
}
