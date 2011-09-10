<?php
/** 
* Classe retorna Banco de Dados
* @author Evandro L. Gonçalves
* @access public
*/ 
class BancoDeDados{
    /**
    * Variável guarda instância p/ conectar ao Banco de Dados
    * @access private
    * @name $instancia
    */
    private static $instancia;
    
    /** 
    * Método construtor
    * @access private
    * @return void
    */ 
    private function __construct(){}
    
    /** 
    * Método que retorna a instância p/ concertar ao Banco de Dados
    * @access public 
    * @return Object PDO
    */ 
    public static function conectar(){
        if(!isset(self::$instancia)){ 
                self::$instancia = new PDO('mysql:host=localhost;dbname=biblioteca','root','');
        }
        return self::$instancia;
    }	
}
?>