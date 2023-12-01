<?php $Model = new Modelo(); ?>

<div class="Stats Venta">
    <div class="ContainerVenta">
        <div class="Form" style="width: 100%;">
            <h2 class="text-center">REGISTRAR VENTA</h2>
            <form action="" method="get">
                <?php
                    $NVenta =  $Model->consulta("DESCRIBE Venta",1);

                    foreach ($NVenta as $key):
                        $NCampo = $key['Field'];
                        if (!str_contains($NCampo, 'Codigo') && !str_contains($NCampo, 'Monto')):?> 

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
                    <?php endforeach; ?> 
                <a class="btn save">
                <i class="fa-solid fa-floppy-disk fa-shake"></i> 
                    <input type="submit"  name="btn" value="GUARDAR">
                </a> <br>
                <input type="hidden" name="m" value="guardar">
            </form>
        </div>
        <div class="Productos">
            <div class="Table">
                <div class="Table-Header">
                    <i class="fa-solid fa-table"></i>
                    <p class="Title-Productos">Agregar Productos</p>
                    <a class="btn new" style="position: relative;left: 78%;" href="index.php?m=nuevo&table=<?php echo $table?>">
                        <i class="fa-solid fa-plus fa-fade"></i>
                        <p>Nuevo</p>
                    </a>
                </div>
            <div class="Table-Contain">
                        
            </div>
            </div>
        </div> 
    </div> 
</div>
