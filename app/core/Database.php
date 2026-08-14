<?php
class Database {
    private PDO $pdo;

    public function __construct(){
        try {
            $this->pdo = new PDO(
                "pgsql:host=localhost;dbname=alam;port=5432",
                "postgres",
                "PASSWORD"
            );
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            die('Erreur:'.$ex->getMessage());
        }
    }

    public function query(string $sql, bool $single = true):array{
        $query = $this->pdo->query($sql);
        $resultat = $single ? $query->fetch() : $query->fetchAll();
        return $resultat === false ? [] : $resultat;
    }

    public function prepare(string $sql, array $datas){
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute($datas);
        return $prepare;
    }

    public function executeQuery(string $sql, array $datas, bool $single = true):array{
        $statement = $this->prepare($sql, $datas);
        $resultat = $single ? $statement->fetch() : $statement->fetchAll();
        return $resultat === false ? [] : $resultat;
    }

    public function executeUpdate(string $sql, array $datas):int{
        $statement = $this->prepare($sql, $datas);

        if (str_starts_with(strtoupper($sql), 'INSERT')) {
            return $this->pdo->lastInsertId();
        }

        return $statement->rowCount();
    }

    public function getAllTables(string $tableName):array{
        $sql = "SELECT * FROM $tableName";
        return $this->query($sql, false);
    }
}