<?php

require '../bootstrap.php';

$query = "SELECT * FROM conversions WHERE status = 0 ORDER BY id ASC";

try {
	# fetch first not processed record from conversion table - FIFO
	$query = $dbConnection->prepare($query);
	$query->execute();
	$result = $query->fetch(\PDO::FETCH_ASSOC);

	if (!$result) {
		exit;
	}

	# fetch mypid
	$pid = getmypid();

	# update status in db to processing
	$query = "UPDATE conversions SET status = :status, pid = :pid WHERE id = :id";
	$statement = $dbConnection->prepare($query);
	$statement->execute(array(
		'id' => (int) $result['id'],
		'pid' => $pid,
		'status' => 1
	));

	// conversion time > 2 minutes
	sleep(5);

	# update status in db to processed
	$query = "UPDATE conversions SET status = :status WHERE id = :id";
	$statement = $dbConnection->prepare($query);
	$statement->execute(array(
		'id' => (int) $result['id'],
		'status' => 2
	));

	// here it can send notification or email that file has been processed.
	// ...

	exit;

} catch (\PDOException $e) {
	exit($e->getMessage());
}
