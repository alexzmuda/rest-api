<?php
declare(strict_types=1);

namespace Src\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Model\Conversion;

class StatusTest extends TestCase
{
	/*
	 * this test should validate if status is in defined range
	   CONST = CONVERSION_STATUSES_IDS = [0, 1, 2];
	*/
	public function testIfStatusIsAllowed(): void
	{
		$status = 1;

		//Given
		$conversion = new Conversion();
		$conversion->setName('new-file-name');

		//When
		$conversion->setStatus($status);

		//Then
		self::assertSame($status, $conversion->getStatus());
	}
}