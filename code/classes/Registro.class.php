<?php

class Registro {

	private $data;
	private $tabela;
	private static $con;

	public function __construct($tabela, PDO $con) {
		$this->tabela = $tabela;
		self::$con = $con;
	}

	public function __set($prop, $value) {
		$this->data[$prop] = $value;
	}

	public function __get($prop) {
		return $this->data[$prop];
	}

	public function save($id) {
		if ($id == 0) {
			$sql = 'insert into ' . $this->tabela . '(' . implode(',', array_keys($this->data)) . ') values' . "('" . implode("','", array_values($this->data)) . "')";
		} else {
			$conta = 1;
			$qtde = sizeof($this->data);
			foreach ($this->data as $key => $value) {
				if ($conta == 1) {
					$sql = "update " . $this->tabela . " set ";
				} else if ($conta >= $qtde) {
					$sql .= " $key = '$value'";
				} else {
					$sql .= " $key = '$value', ";
				}
				$conta++;
			}
			$sql .= " where " . $this->tabela . "_id=" . $id;
		}
		try {
			return self::$con->query($sql);
			//echo $id;
			//echo "$sql";
		} catch (Exception $e) {
			echo "Erro na operação<p> {$e->getMessage()}";
			exit;
		}
		
		
	}
	
	public function findAll(){
			$sql = "select * from " . $this->tabela;
			$stmt= self::$con->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
	}
		
	public function findCriterio($campos, $criterio) {
		$sql = "select ". $campos . " FROM " . $this->tabela . " "  . $criterio;
		//echo $sql;exit;
		$stmt= self::$con->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	public function delete($id){
		$sql = "delete from " . $this->tabela . ' where ' . $this->tabela . '_id='.$id;
		try {
			return self::$con->query($sql);
		} catch (Exception $e) {
			echo "Erro na operação! <p> {$e->getMessage()}";exit;
		}
	}
	
	public function find($id=NULL){
		if ($id) {
			$sql = "select * from ". $this->tabela .' where ' . $this->tabela . '_id='.$id;
			$stmt= self::$con->prepare($sql);
			$stmt->execute();
			return $stmt->fetch();
		}else{
			return array(array_keys($this->data));
		}
	}

}
