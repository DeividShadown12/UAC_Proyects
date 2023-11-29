<?php
    require_once("layouts/header.php");
?>

<a href="index.php?m=nuevo&table=<?php echo $_REQUEST['table']?>" class="btn">NUEVO</a>

<div class="TableContainer">
    <table>
        <tr >
            <?php
                $NTablas = $producto->db->query("DESCRIBE $table");

                if ($NTablas):
                    while ($fila = $NTablas->fetch(PDO::FETCH_ASSOC)):
                        $NCampo = $fila['Field'];?> 

                            <td class="TableHeader" "style="font-weight: bold;"><?php echo strtoupper($NCampo)?></td>
                
                    <?php endwhile; ?>
                <?php endif ?>                     
        </tr>
        <tbody>
            <?php 
                if(!empty($dato)): 
                    foreach ($dato as $key => $fila):  ?>
                        <tr>
                            <?php foreach ($fila as $v => $value): 
                                if (str_contains($v, 'CodigoE')):?> 

                                    <?php  
                                    $Consulta_Empleado = $producto->db->query("SELECT * FROM Empleado WHERE Codigo = $value;");

                                    if ($Consulta_Empleado):
                                        $Empleado = $Consulta_Empleado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($Empleado as $emp):?> 

                                                <td><?php echo $emp['Nombre']?></td>

                                        <?php endforeach; ?>        
                                    <?php endif ?> 

                                <?php 
                                elseif (str_contains($v, 'CodigoD')):?> 

                                <?php  
                                $Consulta_Dep = $producto->db->query("SELECT * FROM Departamento WHERE Codigo = $value;");

                                    if ($Consulta_Dep):
                                        $Departamento = $Consulta_Dep->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($Departamento as $dep):?> 

                                                <td><?php echo $dep['Nombre']?></td>

                                        <?php endforeach; ?>
                                    <?php endif ?>         

                                <?php else:?>

                                    <td><?php echo $value?></td>

                                <?php endif ?>     
                                
                            <?php endforeach; ?>
                            <td>
                                <a class="btn" href="index.php?m=editar&id=<?php echo $fila['Codigo']?>&table=<?php echo $_REQUEST['table']?>">EDITAR</a>
                                <a class="btn" href="index.php?m=eliminar&id=<?php echo $fila['Codigo']?>&table=<?php echo $_REQUEST['table']?>" onclick="return confirm('ESTA SEGURO'); false">ELIMINAR</a>
                            </td>
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
