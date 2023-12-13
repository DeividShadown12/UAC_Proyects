<?php

    require_once("modelo/index.php");

    class Controller{
        // Atributos de la clase
        private $model;

        public function __construct(){
            $this->model = new Modelo();
        }
       
        
        // MOSTRAR INDEX
        static function index(){
            $url = $_REQUEST['url'];
            require_once("vista/$url.php");
        }


        // REALIZAR CONSULTA
        static function Consulta($query, $Assoc){   
            $consu   = new Modelo();
            $dato    =   $consu->consulta($query, $Assoc);
        }

        // MOSTRAR TABLA
        static function ShowTable(){
            $table = $_REQUEST['table'];
            $producto   = new Modelo();
            $dato       =   $producto->mostrar($table,"1");
            require_once("vista/Table.php");
        }

        //nuevo
        static function nuevo(){ 
            $table = $_REQUEST['table'];
            $producto   = new Modelo();       
            require_once("vista/nuevo.php");
        }

        //guardar
        static function guardar(){
            $table = $_REQUEST['table']; 
            
            $data = "";
            $producto = new Modelo();

            if (isset($_GET['CodCliente'])) {
                $Nombre = $_REQUEST['CodCliente'];
                $IGuales = $producto->db->query("SELECT * FROM $table WHERE CodCliente = '$Nombre'");
                $Existe = $IGuales->fetchAll(PDO::FETCH_ASSOC);
            }
            elseif (isset($_GET['CodigoP'])) {
                $Nombre = $_REQUEST['CodigoP'];
                $IGuales = $producto->db->query("SELECT * FROM $table WHERE CodigoP = '$Nombre'");
                $Existe = $IGuales->fetchAll(PDO::FETCH_ASSOC);
            }
            else {
                $Nombre = $_REQUEST['Nombre'];
                $IGuales = $producto->db->query("SELECT * FROM $table WHERE Nombre = '$Nombre'");
                $Existe = $IGuales->fetchAll(PDO::FETCH_ASSOC);
            }


            if ($table == 'Venta_Producto') {
                
                $cod = $producto->db->query("SELECT * FROM Venta ORDER BY Codigo DESC LIMIT 1;")->fetchAll(PDO::FETCH_ASSOC);
                $CodV = $cod[0]['Codigo'];
                echo "<script>console.log('$CodV')</script>";
                $IGuales = $producto->db->query("SELECT * FROM $table WHERE CodigoV = $CodV AND CodigoP = '$Nombre'");
                $Existe = $IGuales->fetchAll(PDO::FETCH_ASSOC);
                
            }

            if ($Existe) {
                echo "<script>alert('Oops!, Ya existe ". $_REQUEST['Nombre'] ." en los registros');</script>";
                Controller::ReDirect($table);
                return;
            } 

            $NCampo = $producto->db->query("DESCRIBE $table");
            if ($NCampo) {
               $filas = $NCampo->fetchAll(PDO::FETCH_ASSOC);
                
               foreach ($filas as $key) {
                    if ($key['Field'] != 'Codigo') { 
                        if (str_contains($key['Type'], 'varchar') || str_contains($key['Type'], 'date') ) {
                           $data .="'";
                           $data .= $_REQUEST[$key['Field']];
                           $data .= "',";    
                        }
                        else{
                            $data .= $_REQUEST[$key['Field']];
                            $data .= ",";
                        }
                    }
               }
               $data = substr($data, 0, -1);
            }

            $dato = $producto->insertar($table,$data);
            // require_once("vista/pruebas.php");

            Controller::ReDirect($table);
        }


        //editar
        static function editar(){    
            $id = $_REQUEST['id'];
            $table = $_REQUEST['table'];
            $producto = new Modelo();
            $dato = $producto->mostrar($table,"Codigo=".$id);        
            require_once("vista/editar.php");
        }

        //actualizar
        static function actualizar(){
            $id = $_REQUEST['id'];
            $table = $_REQUEST['table'];

            $data = "";
            $producto = new Modelo();
            $NCampo = $producto->db->query("DESCRIBE $table");
            if ($NCampo) {
               $filas = $NCampo->fetchAll(PDO::FETCH_ASSOC);
                
               foreach ($filas as $key) {
                    if ($key['Field'] != 'Codigo') { 

                        $data .= $key['Field']."=";
                        $data .="'";
                        $data .= $_REQUEST[$key['Field']];
                        $data .= "',";
                    }
               }
               $data = substr($data, 0, -1);
            }


            // require_once("vista/pruebas.php");
            $dato = $producto->actualizar($table,$data,"Codigo=".$id);
            // header("location:".urlsite);
            Controller::ReDirect($table);
        }

       
        //eliminar
        static function eliminar(){    
            $id = $_REQUEST['id'];
            $table = $_REQUEST['table'];
            $producto = new Modelo();
            $dato = $producto->eliminar($table,"Codigo=".$id);

            Controller::ReDirect($table);
        }

        static function addRelacion(){ 
            $producto = new Modelo(); 
            require_once("vista/addRelacion.php");
        }

        static function ReDirect($table){
            $url = '';
            if ($table == 'Categoria') {
                $url = "http://localhost/Proyecto/index.php?m=index&url=Categorias&table=Categoria";
            }
            elseif ($table == 'Producto') {
                $url = "http://localhost/Proyecto/index.php?m=index&url=Tabla&table=Producto";

            } 
            elseif ($table == 'Venta') {
                $url = "http://localhost/Proyecto/index.php?m=index&url=Ventas&table=Cliente&on=1";

            }
            elseif ($table == 'Cliente') {
                $url = "http://localhost/Proyecto/index.php?m=index&url=Ventas&table=Cliente";

            }
            elseif ($table == 'Venta_Producto') {
                $url = "http://localhost/Proyecto/index.php?m=index&url=Ventas&table=Cliente&on=1";

            }
            header("Location:".$url);
        }
   
    }
?>