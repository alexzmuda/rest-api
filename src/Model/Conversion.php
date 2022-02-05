<?php

namespace Src\Model;

/**
 * Class Conversion
 *
 * @property int $id
 * @property string $name
 * @property int $status
 *
 */
class Conversion
{
	const ID = 'id';
	const NAME = 'name';
	const STATUS = 'status';

	const CONVERSION_STATUSES = [
		'AWAIT' => 0,
		'PROCESSING' => 1,
		'COMPLETED' => 2
	];

	protected $table = 'conversions';

	protected $casts = [
		self::ID => 'int',
		self::STATUS => 'int',
	];

}
