<div class="TableContainer">
    <table>
        <tr >
            <?php
                $NTablas = $producto->db->query("DESCRIBE Ejemplar");

                if ($NTablas):
                    while ($fila = $NTablas->fetch(PDO::FETCH_ASSOC)):
                        $NCampo = $fila['Field'];?> 

                            <td class="TableHeader" "style="font-weight: bold;"><?php echo strtoupper($NCampo)?></td>
                
                    <?php endwhile; ?>
                <?php endif; ?>                     
        </tr>
        <tbody>
            <?php 
                $Consulta_Ejemplar = $producto->db->query("SELECT Ejemplar.Codigo, Localizacion, CodigoL FROM Ejemplar JOIN Usuario_Ejemplar ON Usuario_EJemplar.CodigoU='$CodigoU' WHERE Ejemplar.Codigo = Usuario_EJemplar.CodigoE;");
                $dato = $Consulta_Ejemplar->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($dato)): 
                    foreach ($dato as $key => $fila):  ?>
                        <tr>
                            <?php foreach ($fila as $v => $value): ?>

                                <?php if($v == "CodigoL"): 
                                        
                                        $NLibro = $producto->db->query("SELECT Titulo FROM Libro WHERE Codigo=$value;");
                                        $Libro = $NLibro->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                    
                                    <td><?php echo $Libro['Titulo']?></td>

                                <?php continue;
                                    endif; ?>


                               <td><?php echo $value?></td>
                                
                            <?php endforeach; ?>
                        
                        </tr>
                    <?php endforeach; ?>
            <?php else: ?>
                    <tr>
                        <td colspan="3">NO HAY REGISTROS</td>
                    </tr>
            <?php endif ?>    
        </tbody>
    </table>
</div>

