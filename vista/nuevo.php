<!-- Contenido de nuevo.php -->
<div class="modal-container" id="ModalNew">
	<div class="modal-content">

        <div class="ModalBtn">
            <a onclick="closeModal()">
                <i class="fa-solid fa-circle-xmark"></i>
            </a>
        </div>

		<div class="Form">

            <?php  
			require_once("modelo/index.php");

			$table = $_REQUEST['table'];
			$producto   = new Modelo(); ?>

            <h2>NUEVO <?php echo strtoupper($table)?></h2>
            <form action="" method="get">
                <?php

                    $NTablas = $producto->db->query("DESCRIBE $table");

                    if ($NTablas):
                        while ($fila = $NTablas->fetch(PDO::FETCH_ASSOC)):
                            $NCampo = $fila['Field'];
                                if (!str_contains($NCampo, 'Codigo')):
                                    $type = str_contains($fila['Type'], 'int') || str_contains($fila['Type'], 'decimal') ? 'number" step="0.01' : 'text';?> 
                                    
                                    
                                    <input class="Input" type="<?php echo strval($type)?>" placeholder="INGRESE <?php echo strtoupper($NCampo)?>:" name="<?php echo strval($NCampo)?>" id="<?php echo strval($NCampo)?>" required> <br>

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
                                        $Consulta_Libros = $producto->db->query("SELECT * FROM Proveedor");

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
                <input type="hidden" name="url" value="<?php echo $_REQUEST['url']?>">
            </form>
        </div>
	</div>
</div>

<script>
    // Función para abrir la ventana modal
    function openModal() {
        document.getElementById("ModalNew").style.display = "flex";
    }

    // Función para cerrar la ventana modal
    function closeModal() {
        document.getElementById("ModalNew").style.display = "none";
    }
</script>