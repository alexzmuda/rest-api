<?php

declare(strict_types=1);

namespace Tests\Unit\App\Modules\User\Http\Requests;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;

final class CrudTest extends TestCase
{
	public function testIndex(): void
	{
		$client = new Client([
			'base_uri' => 'http://127.0.0.1:8000',
			'headers' => ['Content-Type' => 'application/json']
		]);

		$request = new Request('GET', 'http://127.0.0.1:8000/conversion');
		$response = $client->send($request, []);

		$this->assertEquals(200, $response->getStatusCode());
	}


	public function testPOST(): void
	{
		$client = new Client([
			'base_uri' => 'http://127.0.0.1:8000',
			'headers' => ['Content-Type' => 'application/json']
		]);

		$name = 'sample-file' . rand(0, 999);
		$data = array(
			'name' => $name,
			'status' => 1
		);

		$request = new Request('POST', 'http://127.0.0.1:8000/conversion');
		$response = $client->send($request,
			[
				'body' => json_encode($data)
			]
		);

		$this->assertEquals(201, $response->getStatusCode());
	}

	public function testPUT(): void
	{
		$client = new Client([
			'base_uri' => 'http://127.0.0.1:8000',
			'headers' => ['Content-Type' => 'application/json']
		]);

		$data = array(
			'status' => 2
		);

		$request = new Request('PUT', '/conversion/1');
		$response = $client->send($request,
			[
				'body' => json_encode($data)
			]
		);

		$this->assertEquals(200, $response->getStatusCode());
	}
}