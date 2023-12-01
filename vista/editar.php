<div class="Stats">
<div class="Form">
<h2 class="text-center">EDITAR <?php echo strtoupper($table)?></h2>
<form action="" method="get">
    <?php
        $NTablas = $producto->db->query("DESCRIBE $table");

        if ($NTablas):
            $filas = $NTablas->fetchAll(PDO::FETCH_ASSOC);
            foreach ($filas as $key):
                $NCampo = $key['Field'];
                    if (!str_contains($NCampo, 'Codigo')):?> 

                        <input class="Input" type="text" value="<?php echo $dato[0][strval($NCampo)] ?>" name="<?php echo strval($NCampo)?>"> <br>

                    <?php else:?>

                        <input type="hidden" value="<?php echo $dato[0][strval($NCampo)] ?>" name="id">

                    <?php endif ?> 


                    <?php if (str_contains($NCampo, 'CodigoC')):?> 

                        <select class="Input" value="<?php echo $dato[0][strval($NCampo)] ?>" name="<?php echo strval($NCampo)?>">


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

                        <select class="Input" value="<?php echo $dato[0][strval($NCampo)] ?>" name="<?php echo strval($NCampo)?>">


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
            <?php endforeach; ?>
        <?php endif ?>
        <a class="btn save">
            <i class="fa-solid fa-pen-to-square fa-shake"></i>
            <input type="submit" name="btn" value="ACTUALIZAR"> 
        </a> <br>
        <input type="hidden" name="m" value="actualizar">
        <input type="hidden" name="table" value="<?php echo $_REQUEST['table']?>">
</form>
</div>
</div>
