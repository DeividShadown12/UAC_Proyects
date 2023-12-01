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



            if ($table == 'Empleado_Departamento') {
                $CodigoE = $_REQUEST['CodigoE']; 
                $CodigoD = $_REQUEST['CodigoD']; 

                $IGuales = $producto->db->query("SELECT * FROM Empleado_Departamento WHERE CodigoE = $CodigoE AND CodigoD = $CodigoD");
                $Existe = $IGuales->fetchAll(PDO::FETCH_ASSOC);

                if ($Existe) {
                    echo "<script>alert('Ya existe este Empleado en el Departamento');</script>";
                    return;
                }                
            }


            $dato = $producto->insertar($table,$data);
            // require_once("vista/pruebas.php");
            header("location:".urlsite);
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
            header("location:".urlsite);
        }

       
        //eliminar
        static function eliminar(){    
            $id = $_REQUEST['id'];
            $table = $_REQUEST['table'];
            $producto = new Modelo();
            $dato = $producto->eliminar($table,"Codigo=".$id);
            header("location:".urlsite);
        }

        static function addRelacion(){ 
            $producto = new Modelo(); 
            require_once("vista/addRelacion.php");
        }
   
    }
?>