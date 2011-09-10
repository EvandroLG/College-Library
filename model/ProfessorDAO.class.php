<?php
require_once("BancoDeDados.class.php");
require_once("Professor.class.php");

/** 
* Classe retorna e altera dados do Professor no Banco de Dados
* @author Evandro L. Gonçalves, Eduardo Zanona
* @access public
*/ 
class ProfessorDAO{
    /**
    * Variável guarda instância p/ conectar ao Banco de Dados
    * @access private
    * @name $conexao
    */
    private $conexao;
    /**
    * Variável guarda instância p/ objeto Professor
    * @access private
    * @name $professor
    */
    private $professor;
    /**
    * Variável guarda número de reservas do professor
    * @access private
    * @name $numReservas
    */
    private $numReservas;
    /**
    * Variável guarda número máximo de reservas por professor
    * @access private
    * @name $maxReservas
    */
    private $maxReservas;
    /**
    * Variável guarda lista de livros reservados
    * @access private
    * @name $livrosReservados
    */
    private $livrosReservados;
    
    /** 
    * Método contrutor
    * @access public 
    * @return void 
    */ 
    public function __construct(){
        $this->conexao = BancoDeDados::conectar();
        $this->maxReservas = 7;
        $this->livrosReservados = array();
    }

    /** 
    * Método que procura professor no banco e cria um objeto Professor
    * @param int $matricula
    * @access public 
    * @return Object Professor
    */ 
    public function getProfessorPorMatricula($matricula){
        $consulta = $this->conexao->query("SELECT * FROM professor WHERE matricula = '".$matricula."'")->fetch();
        $codigo = $consulta["codProfessor"];
        $nome = $consulta["nome"];
        $sala = $consulta["sala"];
        $telefone = $consulta["telefone"];
        $faculdade = $consulta["faculdade"];
        $this->professor = new Professor($codigo, $nome, $sala, $telefone, $faculdade, $matricula);

        return $this->professor;
    }
    
    /** 
    * Método que procura o número de livros reservados por um professor no banco
    * @access public 
    * @return int
    */ 
    public function getNumReservas(){
        $codigo = $this->professor->getCodigo();
        $consulta = $this->conexao->query("SELECT * FROM reserva WHERE codProfessor = '".$codigo."'");
        $consulta->execute();
        $this->numReservas = $consulta->rowCount();

        return $this->numReservas;
    }
    
    /** 
    * Método que retorna uma lista de livros reservados
    * @access public 
    * @return array
    */ 
    public function getLivrosReservados(){
        $codigo = $this->professor->getCodigo();
        $consulta = $this->conexao->query("SELECT * FROM reserva r, professor p, livro l WHERE p.codProfessor = r.codProfessor AND r.codLivro = l.codLivro AND p.codProfessor = '".$codigo."'")->fetchAll();

        $cont = 0;
        foreach($consulta as $livro){
            $this->livrosReservados[$cont][0] = $livro["codLivro"];
            $this->livrosReservados[$cont][1] = $livro["titulo"];
            ++$cont;
        }

        return $this->livrosReservados;
    }
    
    /** 
    * Método que faz a reserva de um livro professor 
    * @param Object $livro, String $disciplina
    * @access public 
    * @return String
    */ 
    public function fazReserva($livro, $disciplina){
        $this->getNumReservas();

        if(!empty($disciplina)){
            if($this->numReservas < $this->maxReservas){
                $codLivro = $livro->getCodigo();
                $codProfessor =  $this->professor->getCodigo();

                $reserva = $this->conexao->prepare("INSERT INTO reserva VALUES('".$codLivro."', '".$codProfessor."', '".$disciplina."')");
                $reserva->execute();
                $cont = $reserva->rowCount();

                if($cont == 0){
                    $msg = "Reserva não pôde ser realizada!";
                }else{
                    $msg = "Reserva realizada com sucesso!";
                }
            }else{
                $msg = "Você já está no limite de reservas: ".$this->maxReservas;
            }
        }else{
            $msg = "Preencha o campo disciplina!";
        }

        return $msg;
    }

    /** 
    * Método cancela reserva do professor
    * @param Object $livro, String $disciplina
    * @access public 
    * @return String
    */ 
    public function cancelaReserva($livro){
        $codLivro = $livro->getCodigo();
        $codProfessor =  $this->professor->getCodigo();

        $cancela = $this->conexao->prepare("DELETE FROM reserva WHERE codLivro = '".$codLivro."' AND codProfessor = '".$codProfessor."'");
        $cancela->execute();
        $cont = $cancela->rowCount();

        if($cont == 0){
            $msg = "Reserva não pôde ser cancelada!";
        }else{
            $msg = "Reserva cancelada com sucesso!";
        }

        return $msg;
    }
}
?>