<?php

class Usuario{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdUsuario(){return $this->idusuario;}
    
    public function setIdUsuario($idUsuario){$this->idusuario = $idUsuario;}

    public function getDeslogin(){return $this->deslogin;}
    
    public function setDeslogin($deslogin){$this->deslogin = $deslogin;}

    public function getDessenha(){return $this->dessenha;}
    
    public function setDessenha($dessenha){$this->dessenha = $dessenha;}

    public function getDtcadastro(){return $this->dtcadastro;}
    
    public function setDtcadastro($dtcadastro){$this->dtcadastro = $dtcadastro;}

    public function loadById($id){
        $sql = new SQL();

        $res = $sql->select("SELECT * FROM tb_usuarios WHERE id_usuario = :ID", array(":ID"=>$id));

        if (isset($res[0])){
            $this->setData($res[0]);
        }
    }

    public static function getList(){
        $sql = new SQL();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY des_login");
    }

    public static function search($login){
        $sql = new SQL();

        return $sql->select("SELECT * FROM tb_usuarios WHERE des_login LIKE :SEARCH ORDER BY des_login", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }

    public function login($login, $pass){
        $sql = new SQL();

        $res = $sql->select("SELECT * FROM tb_usuarios WHERE des_login = :LOGIN AND des_senha = :PASS", array(
            ":LOGIN"=>$login, 
            ":PASS"=>$pass));

        if (isset($res[0])){

            $this->setData($res[0]);
        } else {
            throw new Exception("Login e/ou senha inválidos.");
        }
    }

    public function setData($data){
        $this->setIdUsuario($data['id_usuario']);
        $this->setDeslogin($data['des_login']);
        $this->setDessenha($data['des_senha']);
        $this->setDtcadastro(new DateTime($data['dt_cadastro']));
    }

    public function insert($login, $senha){
        $sql = new SQL();
        $res = $sql->query("INSERT INTO tb_usuarios (des_login, des_senha) VALUES (:LOGIN, :PASS)", array(
            ":LOGIN"=>$login,
            ":PASS"=>$senha
        ));

        return $this->search($login);
    }

    public function update($login, $pass){
        $this->setDeslogin($login);
        $this->setDessenha($pass);

        $sql = new SQL();
        $sql->query("UPDATE tb_usuarios SET des_login = :LOGIN, des_senha = :PASS WHERE id_usuario = :ID", array(
            ":LOGIN"=>$login,
            ":PASS"=>$pass,
            ":ID"=>$this->getIdUsuario()
        ));
    }

    public function __toString()
    {
        return json_encode(array(
            "idusuario"=>$this->getIdUsuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));

    }

}