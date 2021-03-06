<?php
/**
 * easyDB for PDO
 * NOTE: Requires PHP version 5 or later
 * @author		Dogan ISIKDEMIR
 * @email		dgn_isikdemir@hotmail.com
 * @website		http://www.dusyazilim.com/
 * @facebook	https://www.facebook.com/dogan89
 * @twitter		https://twitter.com/dogan89
 * @linkedin	https://tr.linkedin.com/in/dogan89
 * @github		https://github.com/dogan89
 */

class easyDB {
	
	private $db;
	
	public function __construct($db)
	{
		$this->db = $db;
	}
	
	//Sorgular
	public function query($prepare, $value = array(), $type = "")
	{
		if($type == "all")
		{
			$query=$this->db->prepare($prepare);
			$query->execute($value);
			$rows=$query->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		}
		elseif($type == "count")
		{
			$query=$this->db->prepare($prepare);
			$query->execute($value);
			$rows=$query->fetch(PDO::FETCH_NUM);
			return $rows[0];
		}
		elseif($type == "delete" || $type == "update")
		{
			$query=$this->db->prepare($prepare);
			$query->execute($value);
			return $query->rowCount();
		}
		else
		{
			$query=$this->db->prepare($prepare);
			$query->execute($value);
			$rows=$query->fetch(PDO::FETCH_ASSOC);
			return $rows;
		}
	}
	
	//Select işlemi
	public function selectSingle($prepare, $value = array())
	{
		$query=$this->db->prepare($prepare);
		$query->execute($value);
		$rows=$query->fetch(PDO::FETCH_ASSOC);
		return $rows;
	}
	
	//Select all işlemi
	public function selectAll($prepare, $value = array())
	{
		$query=$this->db->prepare($prepare);
		$query->execute($value);
		$rows=$query->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}
	
	//Select count işlemi
	public function selectCount($prepare, $value = array())
	{
		$query=$this->db->prepare($prepare);
		$query->execute($value);
		$rows=$query->fetch(PDO::FETCH_NUM);
		return $rows[0];
	}
	
	//Delete işlemi
	public function delete($prepare, $value = array())
	{
		$query=$this->db->prepare($prepare);
		$query->execute($value);
		return $query->rowCount();
	}
	
	//Update işlemi
	public function update($prepare, $value = array())
	{
		$query=$this->db->prepare($prepare);
		$query->execute($value);
		return $query->rowCount();
	}
	
	//Hızlı tek veri alma
	public function findSingle($table, $where = "", $value = array())
	{
		$params= $where != "" ? " WHERE ".$where : "";
		$query=$this->db->prepare("SELECT * FROM ".$table.$params);
		$query->execute($value);
		$rows=$query->fetch(PDO::FETCH_ASSOC);
		return $rows;
	}
	
	//Hızlı tüm veri alma
	public function findAll($table, $where = "", $value = array())
	{
		$params= $where != "" ? " WHERE ".$where : "";
		$query=$this->db->prepare("SELECT * FROM ".$table.$params);
		$query->execute($value);
		$rows=$query->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}
	
	//Hızlı miktar alma
	public function findCount($table, $where = "", $value = array())
	{
		$params= $where != "" ? " WHERE ".$where : "";
		$query=$this->db->prepare("SELECT COUNT(*) FROM ".$table.$params);
		$query->execute($value);
		$rows=$query->fetch(PDO::FETCH_NUM);
		return $rows[0];
	}
	
	//Hızlı silme
	public function deleteAll($table, $where = "", $value = array())
	{
		$params= $where != "" ? " WHERE ".$where : "";
		$query=$this->db->prepare("DELETE FROM ".$table.$params);
		$query->execute($value);
		return $query->rowCount();
	}
	
	//Insert işlemi
	public function insert($table, $fields = array())
	{
		$keys	= array();
		$values	= array();
		
		foreach($fields as $key => $value) {
			$keys[]		= $key;
			$values[]	= ':'.$key;
		}
		
		$query	= $this->db->prepare("INSERT INTO ".$table." (".implode(', ', $keys).") VALUES (".implode(', ', $values).")");
		$insert	= $query->execute($fields);
		
		if($insert)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Son eklenen id
	public function lastInsertId()
	{
		return $this->db->lastInsertId();
	}
}
?>