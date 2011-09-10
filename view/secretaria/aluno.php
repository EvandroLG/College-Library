<?php
    require_once("../../model/Sessao.class.php");
    require_once("../../model/AlunoDAO.class.php");
    require_once("../../model/ITemplate.class.php");
    
    $sessao = new Sessao();
    session_start();
    
    $matricula = $sessao->getValor("matricula");
    $interface = new ITemplate();    
    
    $alunoDAO = new AlunoDAO();
    $aluno = $alunoDAO->getAlunoPorMatricula($matricula);
    $codAluno = $aluno->getCodigo();
    $livrosEmEmprestimo = $alunoDAO->getLivrosEmEmprestimo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Biblioteca - Secretária</title>
</head>
<body>
<form action="../controller.php?usuario=secretaria&acao=cancelar&codAluno=<?php echo $codAluno; ?>" method="post">
    <strong>CANCELAR EMPRESTIMOS:</strong><br />
    <label for="cancela">Livros em emprestimo:</label><br />
    <select id="cancela" name="cancela">
    <?php $interface->montaDropDown($livrosEmEmprestimo); ?>
    </select><br />
    <input type="submit" value="CANCELAR" />
</form>
</body>
</html>