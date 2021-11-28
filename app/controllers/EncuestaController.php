<?php
require_once './models/Encuesta.php';
require_once './models/Mesa.php';
require_once './service/Pdf.php';
require_once './interfaces/IApiUsable.php';

class EncuestaController extends Encuesta
{
    public function CargarUno($request, $response, $args)
    {

        $parametros = $request->getParsedBody()['body'];
        $mail_usuario = $parametros['mail_usuario'];
        $id_mesa = $parametros['id_mesa'];
        $valoracion_descripcion = $parametros['valoracion_descripcion'];
        $valoracion_mesa = $parametros['valoracion_mesa'];
        $valoracion_restaurante = $parametros['valoracion_restaurante'];
        $valoracion_mozo = $parametros['valoracion_mozo'];
        $valoracion_cocinero = $parametros['valoracion_cocinero'];
        $valoracion_cervecero = $parametros['valoracion_cervecero'];
        $valoracion_bartender = $parametros['valoracion_bartender'];

        $payload =  null;

        if(!isset($parametros) || !isset($mail_usuario) || !isset($valoracion_descripcion) || !isset($valoracion_mesa) || !isset($valoracion_restaurante) || !isset($valoracion_mozo) || !isset($valoracion_cocinero)){
          $payload = json_encode(array("error" => "Error en los parametros para crear la encuesta."));
          $response = $response->withStatus(400);
        }else{
        
          if(Mesa::obtenerMesa($id_mesa) == null){

            $payload = json_encode(array("error" => "No existe una mesa con ese Id"));
            $response = $response->withStatus(400);

        }else if(Usuario::obtenerClientePorMail($mail_usuario) == null){

          $payload = json_encode(array("error" => "No existe Cliente con ese mail"));
          $response = $response->withStatus(400);

        }elseif(($valoracion_mesa < 1 || $valoracion_mesa > 10) || ($valoracion_restaurante < 1 || $valoracion_restaurante > 10) || ($valoracion_mozo < 1 || $valoracion_mozo > 10) || ($valoracion_cocinero < 1 || $valoracion_cocinero > 10) || ($valoracion_bartender < 1 || $valoracion_bartender > 10)|| ($valoracion_cervecero < 1 || $valoracion_cervecero > 10)){
           
          $payload = json_encode(array("error" => "Error en el numero de valoracion. Tiene que ser de 1 a 10."));
            $response = $response->withStatus(400);

          }elseif(strlen($valoracion_descripcion) > 67){

            $payload = json_encode(array("error" => "La descripcion de la valoracion es muy larga, como maximo 66 caracteres."));
            $response = $response->withStatus(400);

          }else{
            $encuesta = new Encuesta();
            $encuesta->id_mesa = $id_mesa;
            $encuesta->valoracion_descripcion = $valoracion_descripcion;
            $encuesta->valoracion_cocinero = $valoracion_cocinero;
            $encuesta->valoracion_mozo = $valoracion_mozo;
            $encuesta->valoracion_mesa = $valoracion_mesa;
            $encuesta->valoracion_cervecero = $valoracion_cervecero;
            $encuesta->valoracion_bartender = $valoracion_bartender;
            $encuesta->valoracion_restaurante = $valoracion_restaurante;
            $encuesta->id_cliente = $mail_usuario;
            $encuesta->crearEncuesta();
            $payload = json_encode(array("mensaje" => "Encuesta cargada."));
            $response = $response->withStatus(201);
          }
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $id = $args['id'];
        $encuesta = Encuesta::obtenerUno($id);
        $payload = json_encode($encuesta);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Encuesta::obtenerTodos();
        $payload = json_encode(array("listaEncuesta" => $lista));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function GuardarEncuestasEnCSV($request, $response, $args)
    {
      
    }


    public function BDDtoCsv($request, $response, $args)
    {
        $status = Encuesta::GuardarBddEnCsv();
        
        if($status == false){
          $payload = json_encode(array("Status" =>"ERROR, problemas al guardar el CSV en la BDD"));
        }else{
          $payload = json_encode(array("Status" =>"Exito, BBDD Guardada en el CSV"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }


    public function CSVtoBDD($request, $response, $args)
    {
        $status = Encuesta::GuardarCsvEnBdd();

        if($status == false){
          $payload = json_encode(array("Status" =>"El archivo CSV No Existe"));
        }else{
          $payload = json_encode(array("Status" =>"Archivo CSV cargado en la BBDD"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }


    public function ObtenerPdfEncuestas($request, $response, $args)
    {
      ob_clean();
      ob_start();
      $encuesta = Encuesta::obtenerTodos();
      $pdf = new PdfServicio();
      $pdf->SetTitle("Encuestas");
      $pdf->AddPage();
      $pdf->Cell(150, 10, 'Encuestas: ', 0, 1);
      foreach ($encuesta as $e) {
        $pdf->Cell(150, 10, Encuesta::toString($e));
        $pdf->Ln();
      }
      $pdf->Output('F','PDF_VENTAS.pdf',false); 
      ob_end_flush();
  
      $payload = json_encode(array("mensaje" => "Descargado"));
      $response->getBody()->write($payload);
      return $response->withHeader('Content-Type', 'application/pdf');
    }

    public function MejoresComentarios($request, $response, $args)
    {
        $lista = Encuesta::obtenerMejoresComentarios();
        $payload = json_encode(array("mejoresComentarios" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
}