<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class UsuariosMiddleware{

public function VerificarAccesoSocio(Request $request, RequestHandler $handler): Response{
   $dataToken = json_decode($request->getParsedBody()["dataToken"], true);
   $tipo_usuario = $dataToken['tipo'];
   $response = new Response();

   if(!isset($dataToken) || !isset($tipo_usuario)){
      $response->getBody()->write(json_encode(array("error" => "Error en los datos del Token")));
      $response = $response->withStatus(400);
   }else{
      if($tipo_usuario == "socio" || $tipo_usuario == "SOCIO"){
         $response = $handler->handle($request);
      }else{
         $response->getBody()->write(json_encode(array("error" => "No tienes accesos, solo para SOCIOS.")));
         $response = $response->withStatus(401);
      }
   }
  return $response->withHeader('Content-Type', 'application/json');
}


public function VerificarAccesoMozo(Request $request, RequestHandler $handler): Response{
   $dataToken = json_decode($request->getParsedBody()["dataToken"], true);
   $tipo_usuario = $dataToken['tipo'];
   $response = new Response();

   if(!isset($dataToken) || !isset($tipo_usuario)){
      $response->getBody()->write(json_encode(array("error" => "Error en los datos del Token")));
      $response = $response->withStatus(400);
   }else{
      if( $tipo_usuario == "SOCIO" || $tipo_usuario == "MOZO"){
         $response = $handler->handle($request);
      }else{
         $response->getBody()->write(json_encode(array("error" => "No tienes accesos, solo para MOZOS / SOCIOS.")));
         $response = $response->withStatus(401);
      }
   }
  return $response->withHeader('Content-Type', 'application/json');
}

public function VerificarAccesoCliente(Request $request, RequestHandler $handler): Response{
   $dataToken = json_decode($request->getParsedBody()["dataToken"], true);
   $tipo_usuario = $dataToken['tipo'];
   $response = new Response();

   if(!isset($dataToken) || !isset($tipo_usuario)){
      $response->getBody()->write(json_encode(array("error" => "Error en los datos del Token")));
      $response = $response->withStatus(400);
   }else{
      if( $tipo_usuario == "SOCIO" || $tipo_usuario == "CLIENTE"){
         $response = $handler->handle($request);
      }else{
         $response->getBody()->write(json_encode(array("error" => "No tienes accesos, solo para CLIENTE / SOCIOS.")));
         $response = $response->withStatus(401);
      }
   }
  return $response->withHeader('Content-Type', 'application/json');
}

}
?>