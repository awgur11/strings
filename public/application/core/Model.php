<?php


class Model
{
   public $pdo;

   protected $table;

   protected $fillable;

   public static function currentClass() {
        return __CLASS__;
   }

   public static function factory($table)
   {
   	$currentClass = static::currentClass();
   	return new $currentClass($table);
   }

   public function __construct($table)
   {
        $this->pdo = DBConnection::connect();

        $this->table = $table;

   }  
   public function all()
   {
   	    $query = 'SELECT * FROM ' . $this->table;

   	    $res = $this->pdo->query($query);

        while ($row = $res->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row ;
        }
        return $result;
   }
   public function show($id)
   {
   	$query = 'SELECT * FROM ' . $this->table . ' WHERE `id`=' . $id;

   	$res = $this->pdo->query($query);

   	while ($row = $res->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row ;
        }
    if(empty($result)) $result[0] = NULL;

    return $result[0];
   }
   public function insert($data)
   {
   	$columns = $this->fillable;

   	$query = 'INSERT INTO `' . $this->table . '`('.implode(',', $columns).') VALUES (:'.implode(',:', $columns) . ')';

   	$db = $this->pdo->prepare($query);

	extract($data);

   	foreach($columns as $col)
   	{
     	$db->bindParam(':'.$col, ${$col});
   	}
    try
    { 
   	    $db->execute();
   	}
   	catch (PDOException $e)
    {
         die("MySQL error");
    }
   	return $this->pdo->lastInsertId(); 
   }
   public function update(int $id, $data)
   {
   		$columns = $this->fillable;

   		$query = 'UPDATE `' . $this->table . '` SET ';

   		foreach($columns as $k => $col)
   		{
   			$query .= ($k == 0 ? '' : ', ').$col.'=:'.$col;
   		}
   		$query .= ' WHERE `id`=' . $id;

   		$db = $this->pdo->prepare($query);

   		extract($data);

   		foreach($columns as $col)
   	    {
     	    $db->bindParam(':'.$col, ${$col});
   	    }
        try
        { 
   	        $db->execute();
   	    }
   	    catch (PDOException $e)
        {
            die("MySQL error");
        }
   	}
   	public function delete($id)
   	{
   		$query = 'DELETE FROM `' . $this->table . '` WHERE `id`=' . $id;

   		$this->pdo->query($query);
   	}
}