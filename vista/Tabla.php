<?php 	$Model = new Modelo(); 
		$table = $_REQUEST['table'];
?>

<div class="Stats">
<div class="Table" style="width: 90%;">
    <div class="Table-Header">
        <i class="fa-solid fa-table"></i>
        <p><?php echo strtoupper($table)?></p>
		<a class="btn new" style="position: relative;left: 83.5%;" onclick="openModal()">
			<i class="fa-solid fa-plus fa-fade"></i>
			<p>Nuevo</p>
		</a>
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
                    $dato =  $Model->consulta("SELECT * FROM $table", 1); 
                    foreach ($dato as $key => $fila):?>
                        <tr>
                            <?php foreach ($fila as $v => $value): 
                                if ($v != "CodigoC" && $v != "CodigoPr"): ?>

                                    <td><?php echo $value?></td>

                                <?php endif; ?>
                            <?php endforeach; ?>
							<td style="width: 10%; text-align: center;">
                                <a class="btn edit" href="index.php?m=editar&id=<?php echo $fila['Codigo']?>&table=<?php echo $_REQUEST['table']?>">
									<i class="fa-solid fa-pen"></i>
								</a>
                                <a class="btn delete" href="index.php?m=eliminar&id=<?php echo $fila['Codigo']?>&table=<?php echo $_REQUEST['table']?>" onclick="return confirm('ESTA SEGURO'); false">
									<i class="fa-solid fa-trash"></i>
								</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>    
            </tbody>
        </table>
    </div>
</div>
</div>

<!-- Ventana MODAL -->
<?php include 'nuevo.php'; ?>