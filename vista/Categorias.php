<?php $Model = new Modelo(); ?>

<div class="Stats">
	<?php
        $dato =  $Model->consulta("SELECT * FROM Categoria", 1);
		  
		foreach ($dato as $key):
    ?>

			<div class="CardMini" <?php echo "style=\"background-color: rgb(".strval((22 + (50 * (int)$key['Codigo'])) % 255).", 
																			".strval((160 + (1 * (int)$key['Codigo'])) % 255).", 
																			".strval((133 + (100 * (int)$key['Codigo'])) % 255).")\" ";?>>
				<div class="CardMini-Head">
					<p> <?php echo $key['Nombre'] ?> </p>						
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
</div>
