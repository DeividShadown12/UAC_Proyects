<?php $Model = new Modelo(); ?>

<div class="Stats">

	<div style="width: 100%">
		<a class="btn new" style="width: 150px; font-size: 1.5em; margin-bottom: 20px;" onclick="openModal()">
			<i class="fa-solid fa-plus fa-fade"></i>
			<p>Nuevo</p>
		</a>
	</div>
	

	<?php
        $dato =  $Model->consulta("SELECT * FROM Categoria", 1);
		  
		foreach ($dato as $key):
    ?>

			<div class="CardMini" <?php echo "style=\"background-color: rgb(".strval((22 + (50 * (int)$key['Codigo'])) % 255).", 
																			".strval((160 + (1 * (int)$key['Codigo'])) % 255).", 
																			".strval((133 + (100 * (int)$key['Codigo'])) % 255).")\" ";?>>
				<div class="CardMini-Head">
					<a href="index.php?m=index&url=Categorias&table=Categoria&on=<?php echo $key['Codigo']?>&tableShow=Producto&nombre=<?php echo $key['Nombre']?>"> 

						<?php echo $key['Nombre'] ?> 
						
					</a>

					<div>			
						<a class="btn delete" href="index.php?m=eliminar&id=<?php echo $key['Codigo']?>&table=Categoria" onclick="return confirm('ESTA SEGURO'); false">
							<i class="fa-solid fa-trash"></i>
						</a>
					</div>

				</div>
				<div class="CardMini-Footer">

					<?php 
						$cod = $key['Codigo'];

						$productos = $Model->consulta("SELECT * FROM Producto 
													   WHERE CodigoC = $cod;", 1); 
					?>

					<p class="Card-Num">  <?php echo count($productos);?> </p> 
				</div>
			</div>

	<?php endforeach; ?>


<?php 
	if(isset($_GET['on'])):    
    	if(isset($_GET['tableShow'])):    
			require_once("vista/TablesCategorias.php");
		endif;	
	endif;
?>
</div>

<!-- Ventana MODAL -->
<?php include 'nuevo.php'; ?>