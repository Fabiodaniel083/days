<?php
class conexion { 

    public static function conexionDB() {
    
        $host = "127.0.0.1";
        $port = "5433";
        $dbname = "daysDB";
        $username = "admin";
        $password = "admin";

        try {
                $conn = new PDO("pgsql:host=$host; port=$port; dbname=$dbname", $username, $password);
                echo ('Conexion exitosa');
            }catch( PDOexception $exp){
        echo ("Error de conexion a la base de datos, $exp");
    }

    return $conn;

    }

    public static function insertarDatos_administracio($lp, $nombre, $apellido) //funcion insertar datos de administracion
    {
       $conn = self::conexionDB(); // Obtener la conexión
        
        try {
            $stmt = $conn->prepare("INSERT INTO personal (adm_lp, adm_nombre, adm_apellido) VALUES (:adm_lp, :adm_nombre, :adm_apellido)");
            $stmt->bindParam(':adm_lp', $lp);
            $stmt->bindParam(':adm_nombre', $nombre);
            $stmt->bindParam(':adm_apellido', $apellido);
            $stmt->execute();
            
            echo "Datos insertados correctamente";
        } catch(PDOException $e) {
            echo "Error al insertar datos: " . $e->getMessage();
        }
   }

   public static function insertarDatosServicios($ser_orden, $ser_anio, $ser_reemp_a, $ser_vigen_desde, $ser_vigen_hasta, $ser_finalizado, $ser_titulo_orden, $ser_mision, $ser_lugar, $ser_prob_atiende, $ser_recursos, $ser_func_respon) {
    // Conexión a la base de datos
    include_once 'conexion.php';
    $conn = conexion::conexionDB();


    $ser_colum_3 = null;
    $ser_colum_2 = null;
    $ser_mapeado = null;


    try {
        // Sentencia SQL para insertar datos en la tabla 'servicios'
        $sql = "INSERT INTO servicios (ser_orden, ser_anio, ser_reemp_a, ser_vigen_desde, ser_vigen_hasta, ser_finalizado, ser_titulo_orden, ser_mision, ser_lugar, ser_prob_atiende, ser_recursos, ser_func_respon) 
        VALUES (:ser_orden, :ser_anio, :ser_reemp_a, :ser_vigen_desde, :ser_vigen_hasta, :ser_finalizado, :ser_titulo_orden, :ser_mision, :ser_lugar, :ser_prob_atiende, :ser_recursos, :ser_func_respon)";
        
        // Preparar la consulta
        $stmt = $conn->prepare($sql);
        
        // Bind de parámetros
        $stmt->bindParam(':ser_orden', $ser_orden);
        $stmt->bindParam(':ser_anio', $ser_anio);
        $stmt->bindParam(':ser_reemp_a', $ser_reemp_a);
        $stmt->bindParam(':ser_vigen_desde', $ser_vigen_desde);
        $stmt->bindParam(':ser_vigen_hasta', $ser_vigen_hasta);
        $stmt->bindParam(':ser_finalizado', $ser_finalizado);
        $stmt->bindParam(':ser_titulo_orden', $ser_titulo_orden);
        $stmt->bindParam(':ser_mision', $ser_mision);
        $stmt->bindParam(':ser_lugar', $ser_lugar);
        $stmt->bindParam(':ser_prob_atiende', $ser_prob_atiende);
        $stmt->bindParam(':ser_recursos', $ser_recursos);
        $stmt->bindParam(':ser_func_respon', $ser_func_respon);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        echo "Datos insertados correctamente en la tabla servicios.";
    } catch(PDOException $e) {
        echo "Error al insertar datos en la tabla servicios: " . $e->getMessage();
    }
}

}
?>



