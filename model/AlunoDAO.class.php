<?php
require_once("BancoDeDados.class.php");
require_once("Aluno.class.php");

/** 
* Classe retorna e altera dados de Aluno no Banco de Dados
* @author Evandro L. Gonçalves, Eduardo Zanona
* @access public
*/ 
class AlunoDAO{
    /**
    * Variável guarda instância p/ conectar ao Banco de Dados
    * @access private
    * @name $conexao
    */
    private $conexao;
    /**
    * Variável guarda instância p/ objeto Aluno
    * @access private
    * @name $aluno
    */
    private $aluno;
    /**
    * Variável guarda número de reservas do aluno
    * @access private
    * @name $numReservas
    */
    private $numReservas;
    /**
    * Variável guarda número máximo de reservas por aluno
    * @access private
    * @name $maxReservas
    */
    private $maxReservas;
    /**
    * Variável guarda numa lista os livros emprestados ao aluno
    * @access private
    * @name $numReservas
    */
    private $livrosEmEmprestimo;
    /**
    * Váriavel guarda a quantidade de livros que já venceram a data de devolução
    * @access private
    * @name $numEmAtraso
    */
    private $numEmAtraso;
    
    /** 
    * Método contrutor
    * @access public 
    * @return void 
    */ 
    public function __construct(){
        $this->conexao = BancoDeDados::conectar();
        $this->maxReservas = 5;
        $this->livrosEmEmprestimo = array();
        $this->numEmAtraso = 0;
    }
    
    /** 
    * Método que procura aluno no banco e cria um objeto Aluno
    * @param int $matricula
    * @access public 
    * @return Object Aluno
    */ 
    public function getAlunoPorMatricula($matricula){
        $consulta = $this->conexao->query("SELECT * FROM aluno WHERE matricula = '".$matricula."'")->fetch();
        $codigo = $consulta["codAluno"];
        $matricula = $consulta["matricula"];
        $curso = $consulta["curso"];
        $nome = $consulta["nome"];
        $telefone = $consulta["telefone"];
        $endereco = $consulta["endereco"];
        $cep = $consulta["cep"];

        $this->aluno = new Aluno($codigo, $matricula, $curso, $telefone, $endereco, $nome, $cep);

        return $this->aluno;
    }
    
    /** 
    * Método que procura na base os livros que estão emprestados p/ um Aluno
    * @access public 
    * @return Array 
    */ 
    public function getLivrosEmEmprestimo(){
        $codigo = $this->aluno->getCodigo();
        $consulta = $this->conexao->query("SELECT * FROM emprestimo e, aluno a, livro l WHERE a.codAluno = e.codAluno AND e.codLivro = l.codLivro AND a.codAluno = '".$codigo."' AND e.dataDevolucao = '0000-00-00'")->fetchAll();

        $cont = 0;
        foreach($consulta as $livro){
            $this->livrosEmEmprestimo[$cont][0] = $livro["codLivro"];
            $this->livrosEmEmprestimo[$cont][1] = $livro["titulo"];
            ++$cont;
        }

        return $this->livrosEmEmprestimo;
    }
    
    /** 
    * Método que retorna a quantidade de livros em atraso do Aluno
    * @access public 
    * @return int 
    */ 
    public function getNumLivrosEmAtraso(){
        $codigo = $this->aluno->getCodigo();
        $consulta = $this->conexao->query("SELECT * FROM emprestimo e, aluno a, livro l WHERE a.codAluno = e.codAluno AND e.codLivro = l.codLivro AND a.codAluno = '".$codigo."' AND e.dataDevolucao = '0000-00-00' AND DATEDIFF(e.dataPrevDevolucao, CURRENT_DATE()) < 0");
        $consulta->execute();
        $this->numEmAtraso = $consulta->rowCount();

        return $this->numEmAtraso;
    }
    
    /** 
    * Método que retorna o número de reservas/empréstimos de livros
    * @access public 
    * @return int 
    */ 
    public function getNumReservas(){
        $codigo = $this->aluno->getCodigo();
        $consulta = $this->conexao->query("SELECT * FROM emprestimo WHERE codAluno = '".$codigo."' AND dataDevolucao = '0000-00-00'");
        $consulta->execute();
        $this->numReservas = $consulta->rowCount();

        return $this->numReservas;
    }
    
    /** 
    * Método que faz a reserva de livro, verificando antes se o aluno não tem empréstimos em atraso e não está no limite de cotas de livros
    * @access public 
    * @param Object livro
    * @return String 
    */ 
    public function fazReserva($livro){
        $this->getNumReservas();
        $this->getNumLivrosEmAtraso();

        if($this->numEmAtraso == 0){    
            $this->numReservas;
            if($this->numReservas < $this->maxReservas){
                $dataAtual = date("Y-m-d");
                $dataDevolucao = strftime("%Y-%m-%d", strtotime("+7 days"));
                $codLivro = $livro->getCodigo();
                $codAluno = $this->aluno->getCodigo();
                $reserva = $this->conexao->prepare("INSERT INTO emprestimo VALUES('".$codAluno."', '".$codLivro."', '".$dataAtual."', '".$dataDevolucao."', '')");
                $reserva->execute();
                $cont = $reserva->rowCount();

                if($cont == 0){
                    $consulta = $this->conexao->query("SELECT dataPrevDevolucao FROM emprestimo WHERE codLivro ='".$codLivro."'")->fetch();
                    $dataPrev = explode("-", $consulta["dataPrevDevolucao"]);
                    $dataPrev = $dataPrev[2]."/".$dataPrev[1]."/".$dataPrev[0];

                    $msg = "Livro ja emprestado! Data prevista para devolucao: ".$dataPrev;
                }else{
                    $dataDevolucao = explode("-", $dataDevolucao);
                    $dataDevolucao = $dataDevolucao[2]."/".$dataDevolucao[1]."/".$dataDevolucao[0];

                    $msg = "Emprestimo realizado com sucesso! Data de vencimento: ".$dataDevolucao;
                }
            }else{
                $msg = "Voce ja esta no limite de emprestimos: ".$this->maxReservas;
            }	
        }else{
            $msg = "Voce nao pode fazer reserva, pois possui livros em atraso!";
        }

        return $msg;
    }
}
?>