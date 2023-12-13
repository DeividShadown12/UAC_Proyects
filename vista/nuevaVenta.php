<!-- Contenido de nuevo.php -->
<div class="modal-container" id="Panel">
	<div class="modal-content">

        <div class="ModalBtn">
            <a onclick="closePanel()">
                <i class="fa-solid fa-circle-xmark"></i>
            </a>
        </div>

		<div class="Form">

            <?php  
			require_once("modelo/index.php"); ?>

            <h2>AGREGAR PRODUCTO</h2>
            <form action="" method="get">
                <?php
                
                    $NVenta =  $Model->consulta("DESCRIBE Venta_Producto",1);

                    if ($NVenta):
                        foreach ($NVenta as $key):
                            $NCampo = $key['Field'];
                                if (($NCampo != 'Codigo') && ($NCampo != 'Precio') && ($NCampo != 'CodigoV')): 

                                    if (str_contains($NCampo, 'CodigoP')):?> 
                                        <select class="Input" value="CodigoP" name="CodigoP">
                                            <?php  
                                            $Productos =  $Model->consulta("SELECT * FROM Producto",1);

                                            if ($Productos):
                                                foreach ($Productos as $product):?>
                                                        <option value="<?php echo $product['Codigo'] ?>"><?php echo $product['Nombre']?></option>
                                                <?php endforeach; ?>        
                                            <?php endif ?> 

                                        </select> <br>
                                    <?php else:
                                        $type = (str_contains($key['Type'], 'int') || str_contains($key['Type'], 'decimal')) ? 'number" step="0.01' : ((str_contains($key['Type'], 'date')) ? 'date' : 'text');?> 
        
                                        <input class="Input" type="<?php echo $type ?>" placeholder="INGRESE <?php echo strtoupper($NCampo)?>:" name="<?php echo strval($NCampo)?>"> <br>
                                        
                                    <?php endif ?> 
        
                                <?php endif ?>                                                         
                        <?php endforeach; ?>
                    <?php endif ?>  
                <a class="btn save">
                    <i class="fa-solid fa-floppy-disk fa-shake"></i> 
                    <input type="submit"  name="btn" value="GUARDAR">
                </a> <br>

                <input type="hidden" name="Precio" value="0">
                <input type="hidden" name="CodigoV" value="<?php echo $CodV ?>">       
                <input type="hidden" name="m" value="guardar">
                <input type="hidden" name="table" value="Venta_Producto">
            </form>
        </div>
	</div>
</div>

<script>
    // Función para abrir la ventana modal
    function openPanel() {
        document.getElementById("Panel").style.display = "flex";
    }

    // Función para cerrar la ventana modal
    function closePanel() {
        document.getElementById("Panel").style.display = "none";
    }
</script>