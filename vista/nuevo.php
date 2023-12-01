<div class="Stats">
<div class="Form">
<h2>NUEVO <?php echo strtoupper($table)?></h2>
<form action="" method="get">
    <?php
        $NTablas = $producto->db->query("DESCRIBE $table");

        if ($NTablas):
            while ($fila = $NTablas->fetch(PDO::FETCH_ASSOC)):
                $NCampo = $fila['Field'];
                    if (!str_contains($NCampo, 'Codigo')):?> 
                        
                        <input class="Input" type="text" placeholder="INGRESE <?php echo strtoupper($NCampo)?>:" name="<?php echo strval($NCampo)?>"> <br>

                    <?php endif ?> 


                    <?php if (str_contains($NCampo, 'CodigoC')):?> 

                        <select class="Input" name="<?php echo strval($NCampo)?>">

        
                            <?php  
                            $Consulta_Libros = $producto->db->query("SELECT  * FROM Categoria");

                            if ($Consulta_Libros):
                                $Libros = $Consulta_Libros->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($Libros as $libro):?> 

                                        <option value="<?php echo $libro['Codigo'] ?>"><?php echo $libro['Nombre']?></option>

                                <?php endforeach; ?>        
                            <?php endif ?> 

                        </select> <br> 

                    <?php endif ?> 
                    <?php if (str_contains($NCampo, 'CodigoPr')):?> 

                        <select class="Input" name="<?php echo strval($NCampo)?>">


                            <?php  
                            $Consulta_Libros = $producto->db->query("SELECT  * FROM Proveedor");

                            if ($Consulta_Libros):
                                $Libros = $Consulta_Libros->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($Libros as $libro):?> 

                                        <option value="<?php echo $libro['Codigo'] ?>"><?php echo $libro['Nombre']?></option>

                                <?php endforeach; ?>        
                            <?php endif ?> 

                        </select> <br> 

                    <?php endif ?>          
            <?php endwhile; ?>

        <?php endif ?>  
    <a class="btn save">
        <i class="fa-solid fa-floppy-disk fa-shake"></i> 
        <input type="submit"  name="btn" value="GUARDAR">
    </a> <br>
    <input type="hidden" name="m" value="guardar">
    <input type="hidden" name="table" value="<?php echo $_REQUEST['table']?>">
</form>
</div>
</div>
