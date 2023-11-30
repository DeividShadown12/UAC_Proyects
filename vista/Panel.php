<?php $Model = new Modelo(); ?>

<div class="Stats">
        <div class="Card">
          <div class="Card-Icon" style="background-color: #16a085">
            <i class="fa-solid fa-user"></i>
          </div>
          <div class="Card-info">

          <?php
			$dato =  $Model->consulta("SELECT * FROM Cliente", 1);    	
			?>
				<p class="Card-Num">  <?php echo count($dato);?> </p> 

            <p>Usuarios</p>
          </div>
        </div>
        <div class="Card">
          <div class="Card-Icon" style="background-color: #ff7858">
            <i class="fa-solid fa-list"></i>
          </div>
          <div class="Card-info">

		  <?php
			$dato =  $Model->consulta("SELECT * FROM Categoria", 1);    	
			?>
				<p class="Card-Num">  <?php echo count($dato);?> </p>

            <p>Categorias</p>
          </div>
        </div>
        <div class="Card">
          <div class="Card-Icon" style="background-color: #7bcbee">
            <i class="fa-solid fa-cart-shopping"></i>
          </div>
          <div class="Card-info">

		  <?php
			$dato =  $Model->consulta("SELECT * FROM Producto", 1);    	
			?>
				<p class="Card-Num">  <?php echo count($dato);?> </p> 

            <p>Productos</p>
          </div>
        </div>
        <div class="Card">
          <div class="Card-Icon" style="background-color: #fed762">
            <i class="fa-solid fa-coins"></i>
          </div>
          <div class="Card-info">

			<?php
			$dato =  $Model->consulta("SELECT * FROM Venta", 1);    	
			?>
				<p class="Card-Num">  <?php echo count($dato);?> </p>

            <p>Ventas</p>
          </div>
        </div>
      </div>

      <div class="Tables">
        <div class="Table">
          <div class="Table-Header">
            <i class="fa-solid fa-table"></i>
            <p>PRODUCTOS MAS VENDIDOS</p>
          </div>
          <div class="Table-Contain">
            <table>
              <tr>
                <th>Item</th>
                <th>Cantidad</th>
                <th>Precio</th>
              </tr>
              <tr>
                <td>Producto 1</td>
                <td>5</td>
                <td>$10.00</td>
              </tr>
              <tr>
                <td>Producto 2</td>
                <td>3</td>
                <td>$15.00</td>
              </tr>
              <tr>
                <td>Producto 3</td>
                <td>2</td>
                <td>$20.00</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="Table">
          <div class="Table-Header">
            <i class="fa-solid fa-table"></i>
            <p>ÚLTIMAS VENTAS</p>
          </div>
          <div class="Table-Contain">
            <table>
              <tr>
                <th>Item</th>
                <th>Cantidad</th>
                <th>Precio</th>
              </tr>
              <tr>
                <td>Producto 1</td>
                <td>5</td>
                <td>$10.00</td>
              </tr>
              <tr>
                <td>Producto 2</td>
                <td>3</td>
                <td>$15.00</td>
              </tr>
              <tr>
                <td>Producto 3</td>
                <td>2</td>
                <td>$20.00</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="Table">
          <div class="Table-Header">
            <i class="fa-solid fa-table"></i>
            <p>PRODUCTOS RECIENTEMENTE AÑADIDOS</p>
          </div>
          <div class="Table-Contain">
            <table>
              <tr>
                <th>Item</th>
                <th>Cantidad</th>
                <th>Precio</th>
              </tr>
              <tr>
                <td>Producto 1</td>
                <td>5</td>
                <td>$10.00</td>
              </tr>
              <tr>
                <td>Producto 2</td>
                <td>3</td>
                <td>$15.00</td>
              </tr>
              <tr>
                <td>Producto 3</td>
                <td>2</td>
                <td>$20.00</td>
              </tr>
            </table>
          </div>
        </div>
      </div>