<?php
require_once("BancoDeDados.class.php");
require_once("AlunoDAO.class.php");
/** 
* Classe que implementa as funções que uma secretaria pode fazer
* @author Evandro L. Gonçalves
* @access public
*/ 
class SecretariaDAO{
    /**
    * Variável guarda instância p/ conectar ao Banco de Dados
    * @access private
    * @name $conexao
    */
    private $conexao;
    /**
    * Variável guarda instância p/ objeto AlunoDAO
    * @access private
    * @name $alunoDAO
    */
    private $alunoDAO;
    
    /** 
    * Método contrutor
    * @access public 
    * @return void 
    */
    public function __construct(){
        $this->conexao = BancoDeDados::conectar();
        $this->alunoDAO = new AlunoDAO();
    }
    
    /** 
    * Método que cancela empréstimo do Aluno
    * @param Object $codLivro, String $codAluno
    * @access public
    * @return String
    */ 
    public function cancelaEmprestimo($codLivro, $codAluno){
        $dataDevolucao = date("Y-m-d");

        $cancela = $this->conexao->prepare("UPDATE emprestimo SET dataDevolucao = '".$dataDevolucao."' WHERE codAluno = '".$codAluno."' AND codLivro = '".$codLivro."'");
        $cancela->execute();
        $cont = $cancela->rowCount();

        if($cont == 0){
            $msg = "Livro não pôde ser cancelado!";
        }else{
            $msg = "Livro cancelado com sucesso!";
        }

        return $msg;
    }
}
?>