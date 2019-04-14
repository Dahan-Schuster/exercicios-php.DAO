<?php


class Sql extends PDO
{
    private $conexao;

    public function __construct()
    {
        $user = 'root';
        $pass = 'root';
        $this->conexao = new PDO ("mysql:host=localhost;dbname=dbphp7", $user, $pass);
    }

    private function setParameters($statement, $parameters = array())
    {
        foreach ($parameters as $key => $value)
        {
            $this->setParam($statement, $key, $value);
        }
    }

    private function setParam($statement, $key, $value)
    {
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array())
    {
        $statement = $this->conexao->prepare($rawQuery);

        $this->setParameters($statement, $params);

        $statement->execute();

        return $statement;

    }

    public function select($rawQuery, $params = array())
    {
        $statement = $this->query($rawQuery, $params);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}