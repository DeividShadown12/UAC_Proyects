<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema Inventario</title>
    <link rel="stylesheet" href="./vista/css/stylesss.css" />

    <!-- ICONS  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <header>
      <div class="Logo">
        <p>SISTEMA INVENTARIO</p>
      </div>
      <div class="Barra">
        <p>SISTEMA INVENTARIO</p>
      </div>
    </header>

    <aside>
      <nav class="SideBar">
        <ul>
          <li>
            <i class="fa-solid fa-house"></i>
            <a href="/Proyecto/index.php?m=index&url=Panel">Panel de Control</a>
          </li>
          <li>
            <i class="fa-solid fa-user-large"></i>
            <a href="/Proyecto/index.php?m=index&url=Tabla&table=Cliente">Clientes</a>
          </li>
          <li>
            <i class="fa-brands fa-stack-overflow"></i>
            <a href="/Proyecto/index.php?m=index&url=Categorias&table=Categoria">Categorias</a>
          </li>
          <li>
            <i class="fa-solid fa-grip-vertical"></i>
            <a href="/Proyecto/index.php?m=index&url=Tabla&table=Producto">Productos</a>
          </li>
          <li>
            <i class="fa-solid fa-list"></i>
            <a href="/Proyecto/index.php?m=index&url=Ventas&table=Cliente">Ventas</a>
          </li>
          <li>
            <i class="fa-solid fa-chart-column"></i>
            <a href="/Proyecto/index.php?m=index&url=Tabla&table=Venta">Reporte Ventas</a>
          </li>
        </ul>
      </nav>
    </aside>

    <main>
<script>
  var url = localStorage.getItem('url') || '';

  function SaveUrl() {
    var url = window.location.href;
    localStorage.setItem('url', url);
    console.log(url);
  }

  function LoadUrl() {
    window.location.href = url;
    console.log(url);
  }
</script>
        <!-- contenido-->
