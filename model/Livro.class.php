<?php
/** 
* Classe retorna e altera propriedades do Livro
* @author Evandro L. Gonçalves
* @access public
*/ 
class Livro{
    private $titulo;
    private $editora;
    private $codigo;
    private $isbn;
    private $autor;
    
    /** 
    * Método contrutor
    * @access public 
    * @param String $titulo
    * @param String $editora
    * @param int $codigo
    * @param int $isbn
    * @param String $autor
    * @return void 
    */ 
    public function __construct($titulo, $editora, $codigo, $isbn, $autor){
        $this->titulo = $titulo;
        $this->editora = $editora;
        $this->codigo = $codigo;
        $this->isbn = $isbn;
        $this->autor = $autor;
    }
    
    /** 
    * Método GET
    * @access public 
    * @return String
    */ 
    public function getTitulo(){
        return $this->titulo;
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
    public function getIsbn(){
        return $this->isbn;
    }
    
    /** 
    * Método GET
    * @access public 
    * @return String
    */ 
    public function getAutor(){
        return $this->autor;
    }
    
    /** 
    * Método SET
    * @access public 
    * @param String $titulo
    * @return void
    */ 
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    
    /** 
    * Método SET
    * @access public 
    * @param int $codigo
    * @return void
    */
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    
    /** 
    * Método SET
    * @access public 
    * @param int $isbn
    * @return void
    */
    public function setIsbn($isbn){
        $this->isbn = $isbn;
    }
    
    /** 
    * Método SET
    * @access public 
    * @param String $autor
    * @return void
    */
    public function setAutor($autor){
        $this->autor = $autor;
    }
}
?>