<?php 
    $on = $_REQUEST['on'];
    $table = $_REQUEST['tableShow'];
    $nombre = $_REQUEST['nombre'];
?>
<div style="width: 100%; padding: 50px 30% 0 30%;">
<div class="Table">
    <div class="Table-Header">
        <i class="fa-solid fa-table"></i>
        <p><?php echo strtoupper($nombre)?></p>
    </div>
    <div class="Table-Contain">
        <table>
            <tr >
                <?php 
                    $NTablas = $Model->consulta("DESCRIBE $table", 1);
                    
                    foreach ($NTablas as $key):
                        $NCampo = $key['Field'];
                        if ($NCampo != "CodigoC" && $NCampo != "CodigoPr"):?> 

                            <th class="TableHeader" style="font-weight: bold;"><?php echo strtoupper($NCampo)?></th>

                        <?php endif; ?>
                    <?php endforeach; ?>                   
            </tr>
            <tbody>
                <?php 
                    $dato =  $Model->consulta("SELECT * FROM $table WHERE Codigo = $on", 1); 
                        foreach ($dato as $key => $fila):?>
                            <tr>
                                <?php foreach ($fila as $v => $value): 
                                    if ($v != "CodigoC" && $v != "CodigoPr"): ?>

                                        <td><?php echo $value?></td>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>

                            
                        <?php endforeach; ?>    
            </tbody>
        </table>
    </div>
</div>
</div>
