<?php
/** 
* Classe que que trabalha com as sessões do sistema
* @author Evandro L. Gonçalves, Eduardo Zanona
* @access public
*/ 
class Sessao{
    /** 
    * Método contrutor
    * @access public 
    * @return void 
    */ 
    public function _construct(){
        session_start();
    }
    
    /** 
    * Método SET - cria/altera uma sessão
    * @param String $matricula, String $valor
    * @access public
    * @return void
    */ 
    public function setValor($var, $valor){
        session_start();
        $_SESSION[$var] = $valor;
    }
    
    /** 
    * Método GET
    * @param String $var
    * @access public
    * @return SESSION
    */ 
    public function getValor($var){
        return $_SESSION[$var];
    }
    
    /** 
    * Método elimina todas as sessões do sistema
    * @access public
    * @return void
    */ 
    public function mataSessao(){
        $_SESSION = array();
        session_destroy();
    }
}
?>
