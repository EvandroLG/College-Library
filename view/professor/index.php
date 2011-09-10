<?php
    require_once("../../model/Sessao.class.php");
    require_once("../../model/LivroDAO.class.php");
    require_once("../../model/UsuarioDAOFactory.class.php");
    require_once("../../model/ITemplate.class.php");

    session_start();
    $sessao = new Sessao();
    $matricula = $sessao->getValor("matricula");
    $interface = new ITemplate();
    
    $livroDAO = new LivroDAO();
    $livrosDisponiveis = $livroDAO->getLivrosDisponiveis();
    
    $usuario = new UsuarioDAOFactory();
    $professorDAO = $usuario->factory("professor");
    $professorDAO->getProfessorPorMatricula($matricula);
    $livrosReservados = $professorDAO->getLivrosReservados();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Biblioteca - Professor</title>
</head>
<body>
<form action="../controller.php?usuario=professor&acao=reservar" method="post">
    <strong>FAZER RESERVA:</strong><br />
    <label for="reserva">Livros disponiveis:</label><br />
    <select id="reserva" name="reserva">
    <?php $interface->montaDropDown($livrosDisponiveis); ?>
    </select><br />
    <input type="text" id="disciplina" name="disciplina" /><br />
    <input type="submit" value="RESERVAR" />
</form>
<br />
<form action="../controller.php?usuario=professor&acao=cancelar" method="post">
    <strong>CANCELAR RESERVA:</strong><br />
    <label for="cancela">Seus livros reservados:</label><br />
    <select id="cancela" name="cancela">
    <?php $interface->montaDropDown($livrosReservados); ?>
    </select><br />
    <input type="submit" value="CANCELAR" />
</form>
</body>
</html>