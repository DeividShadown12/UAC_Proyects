<?php
    require_once("layouts/header.php");
?>

<br><br><br>

<h2 class="text-center">PRESTAMO</h2>
<form action="" method="get"> 
    
    <div class="Option">
        <h3>Seleccione Usuario:</h3>
        <select class="Input" name="CodigoE">

        <!-- LISTA EMPLEADOS -->
        <?php  
        $Consulta_Users = $producto->db->query("SELECT  * FROM Empleado");

        if ($Consulta_Users):
            $User = $Consulta_Users->fetchAll(PDO::FETCH_ASSOC);
            foreach ($User as $user):?> 

                    <option value="<?php echo $user['Codigo']?>"><?php echo $user['Nombre']?></option>

            <?php endforeach; ?>        
        <?php endif ?> 

        </select> <br> 
    </div>

    <div class="Option">
        <h3>Seleccione Departamento:</h3>
        <select class="Input" name="CodigoD">

        <!-- LISTA DEPARTAMENTOS -->
        <?php  
        $Consulta_Dep = $producto->db->query("SELECT * FROM Departamento");

        if ($Consulta_Dep):
            $Departamento = $Consulta_Dep->fetchAll(PDO::FETCH_ASSOC);
            foreach ($Departamento as $dep):?> 

                    <option value="<?php echo $dep['Codigo']?>"><?php echo $dep['Nombre']?></option>

            <?php endforeach; ?>        
        <?php endif ?> 

        </select> <br> 
    </div>

    <input type="submit" class="btn" name="btn" value="AGREGAR EMPLEADO"> <br>
    <input type="hidden" name="m" value="guardar">
    <input type="hidden" name="table" value="Empleado_Departamento">
</form>

