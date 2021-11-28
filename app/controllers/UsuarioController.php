<?php
require_once './models/Usuario.php';
require_once './interfaces/IApiUsable.php';
require_once './models/AutentificadorJWT.php';


class UsuarioController extends Usuario implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody()["body"];

        $nombre = $parametros['nombre'];
        $apellido = $parametros['apellido'];
        $clave = $parametros['clave'];
        $tipo_usuario = $parametros['tipo_usuario'];
        $mail = $parametros['mail'];

        $user = new Usuario();
        $user->nombre = $nombre;
        $user->apellido = $apellido;
        $user->clave = $clave;
        $user->tipo_usuario = $tipo_usuario;
        $user->mail = $mail;
        $user->crearUsuario();

        $payload = json_encode(array("mensaje" => "[ALTA]: Usuario creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {

        $id = $args['id'];
        $usuario = Usuario::obtenerUsuario($id);
        $payload = json_encode($usuario);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Usuario::obtenerTodos();
        $payload = json_encode(array("listaUsuario" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function EstadoEmpleados($request, $response, $args)
    {
        $lista = Usuario::obtenerEstadoEmpleados();
        $payload = json_encode(array("listaEmpleados" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody()["body"];

        $id = $parametros['id'];
        $nombre = $parametros['nombre'];
        $apellido = $parametros['apellido'];
        $clave = $parametros['clave'];
        $tipo_usuario = $parametros['tipo_usuario'];
        $baja = $parametros['baja'];
        $mail = $parametros['mail'];

        Usuario::modificarUsuario($id,$nombre,$apellido,$clave,$tipo_usuario,$baja,$mail);

        $payload = json_encode(array("mensaje" => "Usuario modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['id'];
        Usuario::borrarUsuario($id);

        $payload = json_encode(array("mensaje" => "[BAJA]: Usuario ".$id." borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    
    public function LoginUsers($request, $response, $args){

      $parametros = $request->getParsedBody();
      $mail = $parametros['mail'];
      $clave = $parametros['clave'];

      if( $mail == "" || $clave == ""){
        $response->getBody()->write(json_encode(array("error" => "Falta mail o clave.")));
        $response = $response->withStatus(400);
      }else{

        $usuario = Usuario::obtenerUsuarioPorMail($mail);

        if($usuario != null ){
          if(password_verify($clave,$usuario->clave)){
            $datos = json_encode(array("Id" => $usuario->id,"mail"=> $usuario->mail, "tipo" => $usuario->tipo_usuario));
            $token = AutentificadorJWT::CrearToken($datos);
            $response->getBody()->write(json_encode(array("Status"=>"Usuario Validado",
                                                          "Tipo:"=>$usuario->tipo_usuario,
                                                          "token" => $token)));
          }else{
          $response->getBody()->write(json_encode(array("error" => "Ocurrio un error, password incorrecto.")));
          $response = $response->withStatus(400);
        }        
        }else{
          $response->getBody()->write(json_encode(array("error" => "Ocurrio un error al generar el token, Usuario Inexistente.")));
          $response = $response->withStatus(400);
        }
      }
      return $response->withHeader('Content-Type', 'application/json');
    }


}