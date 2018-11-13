<?php
    header('Content-Type: text/html; charset= iso-8859-1');
    $Pagina = (isset($_POST['Pagina'])) ? $_POST['Pagina'] : 0;
    $NumPaginas = (isset($_POST['NumPaginas'])) ? $_POST['NumPaginas'] : 0;
    $NumeroMinimo = 1;
    $filtro =(isset($_POST['filtro'])) ? $_POST['filtro'] : '';
?>
<!-- PAGINAÇÃO  -->
<div class="col-md-12">
    <ul class="pagination">
        <li class="prev <?= $Pagina <= $NumeroMinimo ? "disabled" : $Anterior = $Pagina - 1; ?>"><a href="<?=($filtro != '') ? '?filtro='.$filtro.'&pagina='.$Anterior : '?pagina='.$Anterior?>" rel="prev">&lt; Anterior</a></li>
        <?php        
        if($Pagina % 10 == 0 || $Pagina >= 10){ // Verifica se a p�gina atual � igual ou maior ao n�meros de p�ginas a ser exibida na pagina��o
            $i = $Pagina;
            while(($i % 10 != 0)){ // Subtrai o contador at� um n�mero divis�vel pela quantidade de p�ginas na pagina��o (isso mostra as p�ginas anteriores � p�gina atual)
                $i--;              
            }            
            $i++;
        ?>
        <li><a class="page-link" href="<?=($filtro != '') ? '?filtro='.$filtro.'&pagina='.'1' : '?'?>pagina=<?= '1'?>">1</a></li>
        <li class="page-item"><a class="page-link">...</a></li>
        <?php
        }else{
            $i = 1;
        }
        if($Pagina + 1 == $i){
        ?>
        <li class="page-item <?= $Pagina == $i-1 ? "active" : "";?>"><a class="page-link" href="<?=($filtro != '') ? '?filtro='.$filtro.'&pagina='.$i : '?'?>pagina=<?=$i?>"><?= $i-1 ?></a></li>
        <?php        
        }
        for(;$i<=$NumPaginas;$i++){
            if($i % 10 == 0 && $Pagina != $i && $i != $NumPaginas){
                $i = $NumPaginas - 1;
                echo '<li class="page-item"><a class="page-link">...</a></li>';
            }else{
        ?>
        <li class="page-item <?= $Pagina == $i ? "active" : "";?>"><a class="page-link" href="<?=($filtro != '') ? '?filtro='.$filtro.'&pagina='.$i : '?pagina='.$i?>"><?= $i ?></a></li>
        <?php }}?>
        <li class="next <?= $Pagina >= $NumPaginas ? "disabled" : $Proximo = $Pagina + 1; ?>"><a href="<?=($filtro != '') ? '?filtro='.$filtro.'&pagina='.$Proximo : '?pagina='.$Proximo?>" rel="prev">Pr&oacute;ximo &gt;</a></li>
    </ul>
</div>