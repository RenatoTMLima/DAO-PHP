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
            $row = $res[0];
            $this->setIdUsuario($row['id_usuario']);
            $this->setDeslogin($row['des_login']);
            $this->setDessenha($row['des_senha']);
            $this->setDtcadastro(new DateTime($row['dt_cadastro']));
        }
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