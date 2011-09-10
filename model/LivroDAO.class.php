<?php
require_once("BancoDeDados.class.php");
require_once("Livro.class.php");

/** 
* Classe retorna e altera dados de Livro no Banco de Dados
* @author Evandro L. Gonçalves, Eduardo Zanona
* @access public
*/ 
class LivroDAO{
    private $conexao;
    private $livro; 
    private $livrosDisponiveis;
    private $livroEmEmprestimo;

    /** 
    * Método contrutor
    * @access public 
    * @return void 
    */
    public function __construct(){
        $this->conexao = BancoDeDados::conectar();
        $this->livrosDisponiveis = array();
        $this->livroEmEmprestimo = array();
    }

   /** 
   * Método que procura na base por um livro de acordo com o código passado por parâmetro
   * @param int $codLivro
   * @access public 
   * @return Object Livro
   */ 
   public function getLivroCodigo($codLivro){
       $consulta = $this->conexao->query("SELECT * FROM livro WHERE codLivro = '".$codLivro."'")->fetch();
       $isbn = $consulta["isbn"];
       $titulo = $consulta["titulo"];
       $autor = $consulta["autor"];
       $editora = $consulta["editora"];
       $this->livro = new Livro($titulo, $editora, $codLivro, $isbn, $autor);

       return $this->livro;
   }
   
   /** 
   * Método que procura na base por livros disponíveis
   * @access public 
   * @return array
   */
    public function getLivrosDisponiveis(){
        $consulta = $this->conexao->query("SELECT * FROM livro l WHERE NOT EXISTS(SELECT * FROM reserva r WHERE l.codLivro = r.codLivro)")->fetchAll();

        $cont = 0;
        foreach($consulta as $livro){
            $this->livrosDisponiveis[$cont][0] = $livro["codLivro"];
            $this->livrosDisponiveis[$cont][1] = $livro["titulo"];
            ++$cont;
        }

        return $this->livrosDisponiveis;
    }
    
    /** 
    * Método que procura livros que estejam na condição de emprestados
    * @access public 
    * @return array
    */
    public function getLivrosEmEmprestimo(){
        $consulta = $this->conexao->query("SELECT * FROM emprestimo e, livro l WHERE e.dataDevolucao = '0000-00-00' AND e.codLivro = l.codLivro")->fetchAll();

        $cont = 0;
        foreach($consulta as $livro){
            $this->livroEmEmprestimo[$cont][0] = $livro["codLivro"];
            $this->livroEmEmprestimo[$cont][1] = $livro["titulo"];
            ++$cont;
        }

        return $this->livroEmEmprestimo;
    }
}
?>