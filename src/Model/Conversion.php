<?php
declare(strict_types=1);

namespace Src\Model;

/**
 * Class Conversion
 *
 * @property int $id
 * @property string $name
 * @property int $status,
 * @property int $pid
 *
 */
class Conversion
{
	const ID = 'id';
	const NAME = 'name';
	const STATUS = 'status';
	const PID = 'pid';

	const CONVERSION_STATUSES_IDS = [0, 1, 2];

	const CONVERSION_STATUSES = [
		'AWAIT' => 0,
		'PROCESSING' => 1,
		'PROCESSED' => 2
	];

	protected $table = 'conversions';

	protected $casts = [
		self::ID => 'int',
		self::STATUS => 'int',
		self::PID => 'pid'
	];


	/**
	 * @throws \Exception
	 */
	public function setStatus(int $status) : bool
	{
		if (!in_array($status, self::CONVERSION_STATUSES_IDS)) {
			return false;
		}
		return true;
	}
}
