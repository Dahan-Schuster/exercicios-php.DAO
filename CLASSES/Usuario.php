<?php


class Usuario
{

    # Recomenda-se utilizar os mesmos nomes das colunas da tabela no banco
    # Assim é possível utilizar o fetch style PDO::FETCH_CLASS
    private $id;
    private $login;
    private $senha;

    const RAW_LIST = 1;
    const JSON_LIST = 2;


    public function login($login, $senha)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios WHERE login = :LOGIN AND senha = :SENHA", array(
            ":LOGIN"=>$login,
            ":SENHA"=>$senha
        ));

        if (count($result) > 0)
        {
            $row = $result[0];
            $this->setId($row['id']);
            $this->setLogin($row['login']);
            $this->setSenha($row['senha']);
        }
        else
        {
            throw new Exception("Login e/ou senha inválidos.");
        }
    }

    public function loadById($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios WHERE id = :ID", array(
            ":ID"=>$id
        ));

        if (count($result) > 0)
        {
            $row = $result[0];
            $this->setId($row['id']);
            $this->setLogin($row['login']);
            $this->setSenha($row['senha']);
        }

    }


    public static function loadAll($list_style = self::JSON_LIST){
        $sql = new Sql();
        $list = $sql->select("SELECT * FROM tb_usuarios");

        if ($list_style == self::JSON_LIST)
            return json_encode($list);

        return $list;
    }


    public static function search($login, $list_style = self::JSON_LIST)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios WHERE login LIKE :SEARCH", array(
           ":SEARCH"=>'%'.$login.'%'
        ));

        if ($list_style == self::JSON_LIST)
            return json_encode($result);

        return $result;
    }

    public function __toString()
    {
        return json_encode(array(
            "id"=>$this->getId(),
            "login"=>$this->login,
            "senha"=>$this->senha
        ));
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }


}