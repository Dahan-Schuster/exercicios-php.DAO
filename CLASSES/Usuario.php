<?php


class Usuario
{

    # Recomenda-se utilizar os mesmos nomes das colunas da tabela no banco
    # Assim é possível utilizar o fetch style PDO::FETCH_CLASS
    private $id;
    private $login;
    private $senha;

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