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


    public function __construct($login = null, $senha = null)
    {
        $this->setLogin($login);
        $this->setSenha($senha);
    }

    public function login($login, $senha)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios WHERE login = :LOGIN AND senha = :SENHA", array(
            ":LOGIN"=>$login,
            ":SENHA"=>$senha
        ));

        if (count($result) > 0)
        {
            $this->setData($result[0]);
        }
        else
        {
            throw new Exception("Login e/ou senha inválidos.");
        }
    }


    public function delete($id = 0)
    {
        $sql = new Sql();

        if ($id == 0 || $id == $this->getId())
        {
            $params = array(
                ":ID"=>$this->getId() # Deleta o registro do próprio objeto
            );

            $this->setData(null);
        }
        else
            $params = array(
                ":ID"=>$id # Deleta um registro especificado
            );

        $sql->query("DELETE FROM tb_usuarios WHERE id = :ID", $params);

    }

    public function update($login, $senha)
    {
        $this->setLogin($login);
        $this->setSenha($senha);

        $sql = new Sql();

       $sql->query("UPDATE tb_usuarios SET login = :LOGIN, senha = :SENHA WHERE id = :ID", array(
            ":LOGIN"=>$this->getLogin(),
            ":SENHA"=>$this->getSenha(),
            ":ID"=>$this->getId()
        ));
    }

    public function insert()
    {
        $sql = new Sql();

        $result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
            ":LOGIN"=>$this->getLogin(),
            ":SENHA"=>$this->getSenha()
        ));

        if (count($result) > 0){
            $this->setData($result[0]);
        }
        else
        {
            throw new Exception("Usuário não inserido");
        }

    }

    private function setData($data)
    {
        if ($data == null)
        {
            $this->setId(null);
            $this->setLogin(null);
            $this->setSenha(null);
        }
        else
        {
            $this->setId($data['id']);
            $this->setLogin($data['login']);
            $this->setSenha($data['senha']);
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
           $this->setData($result[0]);
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
        if ($this->getId() == null)
            return "Nenhum registro carregado. Tente utilizar o método 'loadById(\$id)'";


        $this->loadById($this->getId());

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