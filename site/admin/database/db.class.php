<?php

class DB
{
    private $host     = 'localhost';
    private $user     = 'root';
    private $password = '';
    private $port     = '3306';
    private $dbname   = 'printlab';

    private $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    private function conn()
    {
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset=utf8mb4";
            return new PDO(
                $dsn,
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]
            );
        } catch (PDOException $e) {
            exit("Connection Error: " . $e->getMessage());
        }
    }

    public function all()
    {
        $pdo = $this->conn();
        $st  = $pdo->prepare("SELECT * FROM {$this->tableName}");
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function find($id)
    {
        $pdo = $this->conn();
        $st  = $pdo->prepare("SELECT * FROM {$this->tableName} WHERE id = ?");
        $st->execute([$id]);
        return $st->fetchObject();
    }

    public function store($data)
    {
        unset($data['id']);
        $pdo    = $this->conn();
        $fields = array_keys($data);
        $vals   = array_values($data);
        $qs     = array_fill(0, count($fields), '?');

        $sql = sprintf(
          "INSERT INTO %s (%s) VALUES (%s)",
          $this->tableName,
          implode(',', $fields),
          implode(',', $qs)
        );

        $st = $pdo->prepare($sql);
        $st->execute($vals);
    }

    public function update($data)
    {
        $id   = $data['id'];
        unset($data['id']);
        $pdo  = $this->conn();
        $sets = [];
        foreach ($data as $f => $v) {
            $sets[] = "$f = ?";
        }

        $sql = sprintf(
          "UPDATE %s SET %s WHERE id = %d",
          $this->tableName,
          implode(',', $sets),
          $id
        );

        $st = $pdo->prepare($sql);
        $st->execute(array_values($data));
    }

    public function destroy($id)
    {
        $pdo = $this->conn();
        $st  = $pdo->prepare("DELETE FROM {$this->tableName} WHERE id = ?");
        $st->execute([$id]);
    }

    public function search($criteria)
    {
        $pdo   = $this->conn();
        $field = $criteria['field'];
        $val   = "%{$criteria['value']}%";
        $st    = $pdo->prepare("SELECT * FROM {$this->tableName} WHERE {$field} LIKE ?");
        $st->execute([$val]);
        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function findBy($field, $value)
    {
        $pdo = $this->conn();
        $st  = $pdo->prepare("SELECT * FROM {$this->tableName} WHERE {$field} = ?");
        $st->execute([$value]);
        return $st->fetchObject();
    }
}
?>
