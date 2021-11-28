<?php

class Encuesta
{
    public $id;
    public $id_mesa;
    public $id_cliente;
    public $valoracion_descripcion;
    public $valoracion_mesa;
    public $valoracion_restaurante;
    public $valoracion_mozo;
    public $valoracion_cocinero;
    public $valoracion_cervecero;
    public $valoracion_bartender;
    public $fecha_hora;

    public function crearEncuesta()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO encuestas
                                                                    (valoracion_descripcion, 
                                                                    valoracion_mozo, 
                                                                    valoracion_mesa,
                                                                    valoracion_cocinero,
                                                                    valoracion_bartender,
                                                                    valoracion_cervecero,
                                                                    valoracion_restaurante,
                                                                    id_mesa,
                                                                    id_cliente,
                                                                    fecha_hora) 
                                                            VALUES (:valoracion_descripcion,
                                                                    :valoracion_mozo,
                                                                    :valoracion_mesa,
                                                                    :valoracion_cocinero,
                                                                    :valoracion_bartender,
                                                                    :valoracion_cervecero,
                                                                    :valoracion_restaurante,
                                                                    :id_mesa,
                                                                    :id_cliente,
                                                                    :fecha_hora)");
        $consulta->bindValue(':valoracion_descripcion', $this->valoracion_descripcion, PDO::PARAM_STR);
        $consulta->bindValue(':valoracion_mozo', $this->valoracion_mozo, PDO::PARAM_STR);
        $consulta->bindValue(':valoracion_mesa', $this->valoracion_mesa, PDO::PARAM_STR);
        $consulta->bindValue(':valoracion_cocinero', $this->valoracion_cocinero, PDO::PARAM_STR);
        $consulta->bindValue(':valoracion_bartender', $this->valoracion_bartender, PDO::PARAM_STR);
        $consulta->bindValue(':valoracion_cervecero', $this->valoracion_cervecero, PDO::PARAM_STR);
        $consulta->bindValue(':valoracion_restaurante', $this->valoracion_restaurante, PDO::PARAM_STR);
        $consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
        $consulta->bindValue(':id_mesa', $this->id_mesa, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_hora', date('Y-m-d H:i'), PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM Encuestas");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Encuesta');
    }

    public static function obtenerUno($id_encuesta)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM encuestas WHERE id = :id");
        $consulta->bindValue(':id', $id_encuesta, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchObject('Encuesta');
    }
    
    public static function toString(Encuesta $encuesta){
        return 'Id Encuesta: ' . $encuesta->id .
                'Id Mesa :'. $encuesta->id_mesa .
                //'Mail: ' . $encuesta->id_cliente .
                //'Fecha y Hora' .$encuesta->fecha_hora;
                //'Descripcion: ' . $encuesta->valoracion_descripcion .
                'Mesa: (' . $encuesta->valoracion_mesa."/10)".
                'Restaurante: (' . $encuesta->valoracion_restaurante ."/10)".
                'Mozo: (' . $encuesta->valoracion_mozo ."/10)".
                'Cocinero: (' . $encuesta->valoracion_cocinero ."/10)".
                'Cervecero: (' . $encuesta->valoracion_cervecero ."/10)".
                'Bartender: (' . $encuesta->valoracion_bartender ."/10)";
    }


    // DESDE ACA, METODOS PARA CSV 

    public static function LimpiarCsv(){
        $nombreArchivo = 'Encuesta.csv';
        $archivo = fopen($nombreArchivo, 'w');
        $exito = fwrite($archivo, "");
        fclose($archivo);
        return $exito;
    }

    public static function GuardarUnaEncuestaCSV(Encuesta $encuesta){
        $nombreArchivo = 'Encuesta.csv';
        $archivo = fopen($nombreArchivo, 'a+');

        $registroNuevo = $encuesta->id.','.
        $encuesta->id_mesa.','.
        $encuesta->id_cliente.','.
        $encuesta->fecha_hora.','.
        $encuesta->valoracion_descripcion.','.
        $encuesta->valoracion_mesa.','.
        $encuesta->valoracion_restaurante.','.
        $encuesta->valoracion_mozo.','.
        $encuesta->valoracion_cocinero.','.
        $encuesta->valoracion_cervecero.','.
        $encuesta->valoracion_bartender."\n";

        $exito = fwrite($archivo, $registroNuevo);
        fclose($archivo);
        return $exito;
    }


    public static function LeerEncuestasCSV($nombreCSV)
    {
        $archivo = fopen($nombreCSV, "r");
        if ($archivo != null) {
            $datos = array();
            while (!feof($archivo)) {
                $aux = fgets($archivo);
                $lectura = explode(",", $aux);
       
                if (isset($lectura[0]) && !empty($lectura[0]) 
                    && isset($lectura[1]) && !empty($lectura[1])
                    && isset($lectura[2]) && !empty($lectura[2])
                    && isset($lectura[3]) && !empty($lectura[3])
                    && isset($lectura[4]) && !empty($lectura[4])
                    && isset($lectura[5]) && !empty($lectura[5])
                    && isset($lectura[6]) && !empty($lectura[6])
                    && isset($lectura[7]) && !empty($lectura[7])
                    && isset($lectura[8]) && !empty($lectura[8])
                    && isset($lectura[9]) && !empty($lectura[9])
                    && isset($lectura[10]) && !empty($lectura[10])
                ) {
                    $encuesta = new Encuesta();
                    $encuesta->id_mesa = $lectura[1];
                    $encuesta->id_cliente = $lectura[2];
                    $encuesta->fecha_hora = $lectura[3];
                    $encuesta->valoracion_descripcion = $lectura[4];
                    $encuesta->valoracion_mesa = $lectura[5];
                    $encuesta->valoracion_restaurante = $lectura[6];
                    $encuesta->valoracion_mozo = $lectura[7];
                    $encuesta->valoracion_cocinero = $lectura[8];
                    $encuesta->valoracion_cervecero = $lectura[9];
                    $encuesta->valoracion_bartender = $lectura[10];

                    if (!is_null($encuesta)) {
                        array_push($datos, $encuesta);
                    }
                }
            }
            fclose($archivo);
            return $datos;
        }
        return false;
    }


    public static function GuardarCsvEnBdd(){
        $respuesta = false;
        $arrayEncuestas = Encuesta::LeerEncuestasCSV('EncuestasParaBDD.csv');

        if($arrayEncuestas != null)
        {
            foreach ($arrayEncuestas as $e) {
                $e->crearEncuesta();
            } 
            $respuesta = true;
        }
        return $respuesta;
    }


    public static function GuardarBddEnCsv(){
        
        $respuesta = false;
        Encuesta::LimpiarCsv();
        $arrayEncuestas = Encuesta::obtenerTodos();
        
        if($arrayEncuestas != null){

            foreach ($arrayEncuestas as $e) {
                Encuesta::GuardarUnaEncuestaCSV($e);
            }
            $respuesta = true;
        }
            return $respuesta;  
    }

    public static function obtenerMejoresComentarios()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM encuestas 
                                                        WHERE valoracion_mesa > 7 AND
                                                        valoracion_restaurante > 7 AND
                                                        valoracion_mozo > 7 AND
                                                        valoracion_cocinero > 7 AND
                                                        valoracion_cervecero > 7 AND
                                                        valoracion_bartender > 7 ");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Encuesta');
    }

}