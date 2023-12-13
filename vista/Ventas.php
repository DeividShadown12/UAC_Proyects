<?php $Model = new Modelo(); ?>

<?php 
$CodVenta = $Model->consulta("SELECT * FROM Venta ORDER BY Codigo DESC LIMIT 1;",1);
if ($CodVenta) {
    $CodV = ($CodVenta[0]['Codigo']);
}
else {
    $CodV = 1;
}

echo "<script>console.log('$CodV')</script>";
?>

<div class="Stats Venta">
    <div class="ContainerVenta">
        <div class="Form vent" style="width: 100%;">
            <h2 class="text-center">REGISTRAR VENTA</h2>
            <form action="" method="get">
                <?php
                    $NVenta =  $Model->consulta("DESCRIBE Venta",1);

                    foreach ($NVenta as $key):
                        $NCampo = $key['Field'];
                        if (!str_contains($NCampo, 'Codigo') && !str_contains($NCampo, 'Monto')):?> 

                            <?php if (str_contains($NCampo, 'CodCliente')):?> 
                                <div class="Option-Btn">

                                    <select class="Input" value="CodCliente" name="CodCliente">
                                        <?php  
                                        $Clientes =  $Model->consulta("SELECT * FROM Cliente",1);

                                        if ($Clientes):
                                            foreach ($Clientes as $cl):?>
                                                    <option value="<?php echo $cl['Codigo'] ?>" <?php echo ($cl['Codigo'] == $CodVenta[0]['CodCliente']) ? "selected" : ""; ?> ><?php echo $cl['Nombre']?></option>
                                            <?php endforeach; ?>        
                                        <?php endif ?> 

                                    </select> <br> 

                                    <div>
                                        <a class="btn new" style="width: 70px; font-size: 1em;" onclick="openModal()">
                                                <i class="fa-solid fa-plus fa-fade"></i>
                                                <p>Nuevo</p>
                                        </a>
                                    </div>
                                </div>
                            <?php else:
                                $type = (str_contains($key['Type'], 'int') || str_contains($key['Type'], 'decimal')) ? 'number" step="0.01' : ((str_contains($key['Type'], 'date')) ? 'date' : 'text');?> 

                                <?php  
                                    if ($CodVenta):?>
                                    
                                        <input class="Input" type="<?php echo $type ?>" value="<?php echo $CodVenta[0][strval($NCampo)] ?>" name="<?php echo strval($NCampo)?>" required> <br>

                                    <?php else:?>

                                        <input class="Input" type="<?php echo $type ?>" placeholder="INGRESE <?php echo strtoupper($NCampo)?>:" name="<?php echo strval($NCampo)?>" required> <br>
                                <?php endif ?>
                                
                            <?php endif ?> 


                        <?php endif ?>                       
                    <?php endforeach; ?> 
                <a class="btn save">
                <i class="fa-solid fa-floppy-disk fa-shake"></i> 
                    <input type="submit"  name="btn" value="GUARDAR">
                </a> <br>
                <input type="hidden" name="MontoFinal" value="0">
                <input type="hidden" name="m" value="guardar">
                <input type="hidden" name="table" value="Venta">
            </form>
        </div>

        <div class="Productos" style="display: <?php echo (isset($_GET['on'])) ? "block" : "none"; ?> ">
            <div class="Table">
                <div class="Table-Header">
                    <i class="fa-solid fa-table"></i>
                    <p class="Title-Productos">Agregar Productos</p>
                    <a class="btn new" style="position: relative;left: 78%;" onclick="openPanel()">
                        <i class="fa-solid fa-plus fa-fade"></i>
                        <p>Agregar</p>
                    </a>
                </div>
            <div class="Table-Contain">
                <table id="miTabla">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>C/U</th>
                        <th>Subtotal</th>
                    </tr>

                    <tbody>
                        <?php 
                            $dato =  $Model->consulta("SELECT * FROM Venta_Producto WHERE CodigoV = $CodV", 1); 
                            foreach ($dato as $key => $fila):?>
                                <tr>
                                    <?php 
                                        $CodigoP = $fila['CodigoP'];
                                        $Producto =  $Model->consulta("SELECT Nombre, Precio FROM Producto WHERE Codigo = $CodigoP",1);?>

                                    <td> <?php echo $Producto[0]['Nombre'];?> </td>
                                    
                                    <td><?php echo $fila['Cantidad']?></td>
                                    
                                    <td> <?php echo $Producto[0]['Precio'];?> </td>

                                    <td><?php echo $fila['Precio']?></td>

                                    <td style="width: 10%; text-align: center;">
                                        <a class="btn edit" href="index.php?m=editar&id=<?php echo $fila['Codigo']?>&table=Venta_Producto">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a class="btn delete" href="index.php?m=eliminar&id=<?php echo $fila['Codigo']?>&table=Venta_Producto" onclick="return confirm('ESTA SEGURO'); false">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>    
                    </tbody>

                    <!-- Fila que se clonará -->
                    
                    <tr id="filaEjemplo" style="display: none;">
                    <?php
                    $ventaProducto =  $Model->consulta("DESCRIBE Venta_Producto",1);

                    foreach ($ventaProducto as $key):
                        $NCampo = $key['Field'];

                        if (str_contains($NCampo, 'CodigoP')):?> 

                            <td>
                            <select class="Input" value="CodigoP" name="CodigoP">
    
                                <?php  
                                $Productos =  $Model->consulta("SELECT * FROM Producto",1);
    
                                if ($Productos):
                                    foreach ($Productos as $producto):?> 
    
                                        <option value="<?php echo $producto['Codigo'] ?>"><?php echo $producto['Nombre']?></option>
    
                                    <?php endforeach; ?>        
                                <?php endif ?> 
    
                            </select>
                            </td>
    
                        <?php endif ?>
                    <?php endforeach; ?> 
                    </tr>
                        
                    <tr id="filaEjemplo" style="display: none;">
                        <td>Contenido Celda 1</td>
                        <td>Contenido Celda 2</td>
                    </tr>
                   <!-- Otras filas pueden agregarse aquí manualmente o dinámicamente -->
                </table>   
            </div>
            </div>
        </div> 
    </div> 
</div>


<!-- Ventana MODAL -->
<?php include 'nuevo.php'; ?>
<?php include 'nuevaVenta.php'; ?>
