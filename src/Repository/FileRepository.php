<?php

namespace Src\Repository;

use Src\Repository\Interfaces\FileRepositoryInterface;

class FileRepository implements FileRepositoryInterface
{

	private $db = null;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function index()
	{
		$query = "
			SELECT 
				*  
			FROM 
				conversions;";

		try {
			$query = $this->db->query($query);
			$result = $query->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		} catch (\PDOException $e) {
			exit($e->getMessage());
		}
	}

	public function store(array $data)
	{
		$statement = "
            INSERT INTO conversions 
                (name, status)
            VALUES
                (:name, :status);
        ";

		try {
			$statement = $this->db->prepare($statement);
			$statement->execute(array(
				'name' => $data['name'],
				'status' => $data['status'],
			));
			return $statement->rowCount();
		} catch (\PDOException $e) {
			exit($e->getMessage());
		}
	}


	public function changeStatus($id, $status)
	{
		$statement = "
            UPDATE 
            	conversions
            SET 
                status = :status,
            WHERE 
            	id = :id;
        ";

		try {
			$statement = $this->db->prepare($statement);
			$statement->execute(array(
				'id' => (int)$id,
				'status' => $status,
			));
			return $statement->rowCount();
		} catch (\PDOException $e) {
			exit($e->getMessage());
		}
	}

	public function find($id)
	{
		$query = "
			SELECT 
  				* 
  			FROM 
  				conversions 
  			WHERE 
  				id = :id;";

		try {
			$query = $this->db->prepare($query);
			$query->execute(array($id));
			$result = $query->fetch(\PDO::FETCH_ASSOC);
			return $result;
		} catch (\PDOException $e) {
			exit($e->getMessage());
		}
	}

	public function delete($id)
	{
		$statement = "
			DELETE FROM conversions 
			WHERE id = :id;";

		try {
			$statement = $this->db->prepare($statement);
			$statement->execute(array('id' => $id));
			return $statement->rowCount();
		} catch (\PDOException $e) {
			exit($e->getMessage());
		}
	}
}
