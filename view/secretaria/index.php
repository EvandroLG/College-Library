<?php
    require_once("../../model/LivroDAO.class.php");
    require_once("../../model/ITemplate.class.php");
    
    $livroDAO = new LivroDAO();
    $template = new ITemplate();
    
    $livrosDisponiveis = $livroDAO->getLivrosDisponiveis();
    $livrosEmEmprestimo = $livroDAO->getLivrosEmEmprestimo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Biblioteca - Secretária</title>
</head>
<body>
<form action="../controller.php?usuario=secretaria" method="post">
    <label for="matriculaAluno">Matricula do Aluno:</label><br />
    <input type="text" id="matriculaAluno" name="matriculaAluno" /><br />
    <input type="submit" value="ENVIAR" />
</form>
<br />
<strong style="font-size:22px;">RELATORIO:</strong><br />
<strong>LIVROS DISPONIVEIS:</strong><br />
<?php $template->montaTableDoLivro($livrosDisponiveis);  ?>
<br />
<strong>LIVROS EM EMPRESTIMO:</strong><br />
<?php $template->montaTableDoLivro($livrosEmEmprestimo); ?>
</body>
</html>