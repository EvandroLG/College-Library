<?php
require_once("Usuario.class.php");

/** 
* Classe retorna e altera propriedades do Aluno
* @author Evandro L. Gonçalves, Eduardo Zanona
* @access public
*/ 
class Aluno implements Usuario{
    private $codigo;
    private $matricula;
    private $curso;
    private $telefone;
    private $endereco;
    private $nome;
    private $cep;
    
    /** 
    * Método contrutor
    * @access public 
    * @param int $codigo
    * @param int $matricula
    * @param String $curso
    * @param int $telefone
    * @param String $endereco
    * @param String $nome
    * @param int $cep
    * @return void 
    */ 
    public function __construct($codigo, $matricula, $curso, $telefone, $endereco, $nome, $cep){
        $this->codigo = $codigo;
        $this->matricula = $matricula;
        $this->curso = $curso;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->nome = $nome;
        $this->cep = $cep;
    }
    
    /** 
    * Método GET
    * @access public 
    * @return int
    */ 
    public function getCodigo(){
        return $this->codigo;
    }
    
    /** 
    * Método GET
    * @access public 
    * @return int
    */ 
    public function getMatricula(){
        return $this->matricula;
    }
    
    /** 
    * Método GET
    * @access public 
    * @return String
    */ 
    public function getCurso(){
        return $this->curso;
    }
    
    /** 
    * Método GET
    * @access public 
    * @return int
    */ 
    public function getTelefone(){
        return $this->telefone;
    }
    
    /** 
    * Método GET
    * @access public 
    * @return String
    */ 
    public function getEndereco(){
        return $this->endereco;
    }

    public function getNome(){
        return $this->nome;
    }
    
    /** 
    * Método GET
    * @access public 
    * @return int
    */ 
    public function getCep(){
        return $this->cep;
    }
    
    /** 
    * Método SET
    * @access public 
    * @param int $codigo
    * @return int
    */ 
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    
    /** 
    * Método SET
    * @access public 
    * @param int $matricula
    * @return int
    */ 
    public function setMatricula($matricula){
        $this->matricula = $matricula;
    }
    
    /** 
    * Método SET
    * @access public 
    * @param int $curso
    * @return String
    */ 
    public function setCurso($curso){
        $this->curso = $curso;
    }
    
    /** 
    * Método SET
    * @access public 
    * @param int $telefone
    * @return int
    */ 
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }
    
    /** 
    * Método SET
    * @access public 
    * @param int $endereco
    * @return String
    */ 
    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }
    
    /** 
    * Método SET
    * @access public 
    * @param int $nome
    * @return String
    */ 
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    /** 
    * Método SET
    * @access public 
    * @param int $cep
    * @return int
    */ 
    public function setCep($cep){
        $this->cep = $cep;
    }
}
?>