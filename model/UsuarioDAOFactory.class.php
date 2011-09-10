<?php
require_once("ProfessorDAO.class.php");
require_once("AlunoDAO.class.php");
require_once("SecretariaDAO.class.php");
/** 
* Classe 'fabrica' objetos AlunoDAO, ProfessorDAO e SecretariaDAO
* @author Evandro L. Gonçalves, Eduardo Zanona
* @access public
*/ 
class UsuarioDAOFactory{
    /** 
    * Método que procura professor no banco e cria um objeto Professor
    * @param int $matricula
    * @access public 
    * @return Object Professor
    */ 
    public function factory($usuario){
        
        switch($usuario){
            case "aluno": 
                return new AlunoDAO();
                break;
                
            case "professor":
                return new ProfessorDAO();
                break;
                
            case "secretaria":
                return new SecretariaDAO();
                
            default: exit;
        }
    }
}
?>
