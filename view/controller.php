<?php
require_once("../model/UsuarioDAOFactory.class.php");
$usuario = new UsuarioDAOFactory();

if(isset($_POST["matricula"])){
    require_once("../model/UserUsuario.class.php");

    $matricula = $_POST["matricula"];
    $verifica = new UserUsuario($matricula);
    $verifica->autenticaUsuario();
}

if($_GET["usuario"] == "professor"){
    require_once("../model/LivroDAO.class.php");
    require_once("../model/Sessao.class.php");

    session_start();
    $sessao = new Sessao();

    if($_GET["acao"] == "reservar"){
        $matricula = $sessao->getValor("matricula");
        $codLivro = $_POST["reserva"];
        $disciplina = $_POST["disciplina"];

        $professorDAO = $usuario->factory("professor");
        $professor = $professorDAO->getProfessorPorMatricula($matricula);

        $livroDAO = new LivroDAO();
        $livro = $livroDAO->getLivroCodigo($codLivro);

        $reserva = $professorDAO->fazReserva($livro, $disciplina);
        echo $reserva;
    }

    if($_GET["acao"] == "cancelar"){
        $matricula = $sessao->getValor("matricula");
        $codLivro = $_POST["cancela"];

        $professorDAO = $usuario->factory("professor");
        $professor = $professorDAO->getProfessorPorMatricula($matricula);

        $livroDAO = new LivroDAO();
        $livro = $livroDAO->getLivroCodigo($codLivro);

        $cancela = $professorDAO->cancelaReserva($livro);
        echo $cancela;
    }		
}

if($_GET["usuario"] == "aluno"){
    if($_GET["acao"] == "reservar"){
        require_once("../model/AlunoDAO.class.php");
        require_once("../model/LivroDAO.class.php");
        require_once("../model/Sessao.class.php");

        session_start();
        $sessao = new Sessao();

        $matricula = $sessao->getValor("matricula");
        $codLivro = $_POST["reserva"];

        $alunoDAO = $usuario->factory("aluno");
        $aluno = $alunoDAO->getAlunoPorMatricula($matricula);

        $livroDAO = new LivroDAO();
        $livro = $livroDAO->getLivroCodigo($codLivro);

        $reserva = $alunoDAO->fazReserva($livro);
        echo $reserva;
    }
}

if($_GET["usuario"] == "secretaria"){
    if(isset($_POST["matriculaAluno"])){
        require_once("../model/UserUsuario.class.php");
        require_once("../model/Sessao.class.php");

        session_start();
        $sessao = new Sessao();

        $matricula = $_POST["matriculaAluno"];
        $verifica = new UserUsuario($matricula);
        $existe = $verifica->existeUsuario("aluno");

        if($existe == 0){
            echo "Usuário inexistente!";
        }else{
            $sessao->setValor("matricula", $matricula);
            header("Location: secretaria/aluno.php");
        }
    }

    if($_GET["acao"] == "cancelar"){
        require_once("../model/SecretariaDAO.class.php");
        require_once("../model/Sessao.class.php");

        session_start();
        $sessao = new Sessao();
        $codAluno = $_GET["codAluno"];
        $codLivro = $_POST["cancela"];
        $secretariaDAO = $usuario->factory("secretaria");
        $cancela = $secretariaDAO->cancelaEmprestimo($codLivro, $codAluno);
        echo $cancela;
    }
}
?>