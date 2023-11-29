<?php
	require_once("layouts/header.php");
?>

<h2 class="text-center">NUEVO</h2>
<form action="" method="get">
    <?php
        $NTablas = $producto->db->query("DESCRIBE $table");

        if ($NTablas):
            while ($fila = $NTablas->fetch(PDO::FETCH_ASSOC)):
                $NCampo = $fila['Field'];
                    if (!str_contains($NCampo, 'Codigo')):?> 
                        
                        <input class="Input" type="text" placeholder="INGRESE <?php echo strtoupper($NCampo)?>:" name="<?php echo strval($NCampo)?>"> <br>

                    <?php endif ?> 


                    <?php if (str_contains($NCampo, 'CodigoL')):?> 

                        <select class="Input" name="<?php echo strval($NCampo)?>">

        
                            <?php  
                            $Consulta_Libros = $producto->db->query("SELECT  * FROM Libro");

                            if ($Consulta_Libros):
                                $Libros = $Consulta_Libros->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($Libros as $libro):?> 

                                        <option value="<?php echo $libro['Codigo'] ?>"><?php echo $libro['Titulo']?></option>

                                <?php endforeach; ?>        
                            <?php endif ?> 

                        </select> <br> 

                    <?php endif ?>          
            <?php endwhile; ?>



            <?php if (str_contains($table, 'Libro')):?> 

                <select class="Input" name="CodigoA">


                    <?php  
                    $Consulta_Autor = $producto->db->query("SELECT  * FROM Autor");

                    if ($Consulta_Autor):
                        $Autor = $Consulta_Autor->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($Autor as $aut):?> 

                                <option value="<?php echo $aut['Codigo'] ?>"><?php echo $aut['Nombre']?></option>

                        <?php endforeach; ?>        
                    <?php endif ?> 

                </select> <br> 

            <?php endif ?> 

        <?php endif ?>  
    <input type="submit" class="btn" name="btn" value="GUARDAR"> <br>
    <input type="hidden" name="m" value="guardar">
    <input type="hidden" name="table" value="<?php echo $_REQUEST['table']?>">
</form>
