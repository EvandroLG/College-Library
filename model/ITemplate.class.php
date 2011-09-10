<?php
/** 
* Classe que monta o template
* @author Evandro L. Gonçalves
* @access public
*/ 
class ITemplate{
    /** 
    * Método monta dropdown de acordo com o conteúdo do array
    * @param array $vetor
    * @access public 
    * @return HTML
    */ 
    public function montaDropDown($vetor){
        $tamVetor = count($vetor);
        $cont = 0;

        while($tamVetor > $cont){
          echo "<option value='".$vetor[$cont][0]."'>".$vetor[$cont][1]."</option>";
          ++$cont;
        }
    }
    
    /** 
    * Método monta table de acordo com o conteúdo do array
    * @param array $vetor
    * @access public 
    * @return HTML
    */
    public function montaTableDoLivro($vetor){
        $tamVetor = count($vetor);

        if($tamVetor > 0){
            $cont = 0;

            echo "<table>
                  <tr>
                  <td>Codigo</td>    
                  <td>Titulo</td>
                  </tr>";    
            while($tamVetor > $cont){
              echo "<tr><td>".$vetor[$cont][0]."</td><td>".$vetor[$cont][1]."</td><tr>";
              ++$cont;
            }
            echo "</table>";
        }

    }
}
?>