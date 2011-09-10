<?php
interface Usuario{
    public function getCodigo();
    public function getNome();
    public function getMatricula();
    public function getTelefone();
    public function setCodigo($codigo);
    public function setNome($nome);
    public function setMatricula($matricula);
    public function setTelefone($telefone);
}
?>
