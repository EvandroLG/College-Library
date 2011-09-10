<?php
    require_once("../../model/Sessao.class.php");
    require_once("../../model/LivroDAO.class.php");
    require_once("../../model/UsuarioDAOFactory.class.php");
    require_once("../../model/ITemplate.class.php");
    
    session_start();
    $sessao = new Sessao();
    $matricula = $sessao->getValor("matricula");
    
    $livroDAO = new LivroDAO();
    $interface = new ITemplate();
    $livrosDisponiveis = $livroDAO->getLivrosDisponiveis();
    
    $usuario = new UsuarioDAOFactory();
    $alunoDAO = $usuario->factory("aluno");
    $alunoDAO->getAlunoPorMatricula($matricula);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Biblioteca - Aluno</title>
</head>
<body>
<form action="../controller.php?usuario=aluno&acao=reservar" method="post">
    <strong>FAZER RESERVA:</strong><br />
    <label for="reserva">Livros disponiveis:</label><br />
    <select id="reserva" name="reserva">
    <?php $interface->montaDropDown($livrosDisponiveis); ?>
    </select><br />
    <input type="submit" value="RESERVAR" />
</form>
<br />
</body>
</html>