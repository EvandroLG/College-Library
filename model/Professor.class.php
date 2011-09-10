<?php
require_once("Usuario.class.php");

/** 
* Classe retorna e altera propriedades do Professor
* @author Evandro L. Gonçalves, Eduardo Zanona
* @access public
*/ 
class Professor implements Usuario{
    private $codigo;
    private $nome;
    private $sala;
    private $telefone;
    private $faculdade;
    private $matricula;
    
    /** 
    * Método contrutor
    * @access public 
    * @param int $codigo
    * @param String $nome
    * @param int $sala
    * @param int $telefone
    * @param String $faculdade
    * @param int $matricula
    * @return void 
    */ 
    public function __construct($codigo, $nome, $sala, $telefone, $faculdade, $matricula){
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->sala = $sala;
        $this->telefone = $telefone;
        $this->faculdade = $faculdade;
        $this->matricula = $matricula;
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
    * @return String
    */ 
    public function getNome(){
        return $this->nome;
    }

    /** 
    * Método GET
    * @access public 
    * @return int
    */ 
    public function getSala(){
        return $this->sala;
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
    public function getFaculdade(){
        return $this->faculdade;
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
    * Método SET
    * @access public 
    * @return void
    */ 
     public function setCodigo($codigo){
        $this->codigo = $codigo;
     }

    /** 
    * Método SET
    * @access public 
    * @return void
    */ 
    public function setNome($nome){
            $this->nome = $nome;
    }

    /** 
    * Método SET
    * @access public 
    * @return void
    */ 
    public function setSala($sala){
            $this->sala = $sala;
    }

    /** 
    * Método SET
    * @access public 
    * @return void
    */ 
    public function setTelefone($telefone){
            $this->telefone = $telefone;
    }

    /** 
    * Método SET
    * @access public 
    * @return void
    */ 
    public function setFaculdade($faculdade){
            $this->faculdade = $faculdade;
    }

    /** 
    * Método SET
    * @access public 
    * @return void
    */ 
    public function setMatricula($matricula){
            $this->matricula = $matricula;
    }
}
?>