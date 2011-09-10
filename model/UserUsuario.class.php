<?php
require_once("ProfessorDAO.class.php");
require_once("AlunoDAO.class.php");
require_once("BancoDeDados.class.php");
require_once("Sessao.class.php");

/** 
* Classe que implementa as funções p/ validar dados do aluno
* @author Evandro L. Gonçalves, Eduardo Zanona
* @access public
*/ 
class UserUsuario{
    /**
    * Variável guarda matricula do Professor ou do Aluno
    * @access private
    * @name $matricula
    */
    private $matricula;
    /**
    * Variável guarda instância p/ conectar ao Banco de Dados
    * @access private
    * @name $conexao
    */
    private $conexao;
    /**
    * Variável guarda instância da Sessão
    * @access private
    * @name $sessao
    */
    private $sessao;
    
    /** 
    * Método contrutor
    * @access public
    * @param int $matricula
    * @return void
    */
    public function __construct($matricula){
        $this->sessao = new Sessao();
        $this->matricula = $matricula;
        $this->conexao = BancoDeDados::conectar();
    }

    /** 
    * Método que valida usuário, conforme a matricula passada por parâmetro no construtor
    * @access public
    * @return Object Usuario
    */
    public function autenticaUsuario(){
        if(!empty($this->matricula) && is_numeric($this->matricula)){
            $inicioMatricula = substr($this->matricula, 0, 5);

            switch($inicioMatricula){
                case "40000":
                    $existe = $this->existeUsuario("professor");

                    if($existe == 1){
                        $this->sessao->setValor("matricula", $this->matricula);
                        header("Location: professor/");
                    }

                    break;

                case "10000":
                    $existe = $this->existeUsuario("aluno");

                    if($existe == 1){
                        $this->sessao->setValor("matricula", $this->matricula);
                        header("Location: aluno/");
                    }

                    break;
                case "55555":
                    header("Location: secretaria/"); 
                    break;
                    
                default: header("Location: index.php"); 
                         exit;
            }
        }
    }

    /** 
    * Método que verifica se o usuário existe na base
    * @access public
    * @param int $tipo
    * @return int
    */
    public function existeUsuario($tipo){
        $consulta = $this->conexao->prepare("SELECT * FROM ".$tipo." WHERE matricula=".$this->matricula."");
        $consulta->execute();
        $cont = $consulta->rowCount();
        return $cont;
    }
}
?>