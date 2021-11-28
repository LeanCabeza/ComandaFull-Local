<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Handlers\Strategies\RequestHandler;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';
require_once './controllers/UsuarioController.php';
require_once './controllers/ProductoController.php';
require_once './controllers/MesaController.php';
require_once './controllers/PedidoController.php';
require_once './controllers/EncuestaController.php';
require_once './db/AccesoDatos.php';
require_once './middlewares/AutenticacionMiddelware.php';
require_once './middlewares/UsuariosMiddleware.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = AppFactory::create();
$app->setBasePath('/comanda');
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);


$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("COMANDA, Leandro Cabeza");
    return $response;
});

// AUTENTICACION, GENERA TOKENS.

$app->group('/autenticacion', function (RouteCollectorProxy $group) {
  $group->post('/login', \UsuarioController::class . ':LoginUsers');
});

// REGISTRAR CLIENTES, SOLO MOZOS.
$app->group('/clientes', function (RouteCollectorProxy $group) {
  $group->post('[/]', \UsuarioController::class . ':CargarUno');
})
->add(\UsuariosMiddleware::class . ':VerificarAccesoMozo')
->add(\AutenticacionMiddelware::class . ':VerificarToken');

// USUARIOS, SOLO SOCIOS.
$app->group('/usuarios', function (RouteCollectorProxy $group) {

    $group->get('[/]', \UsuarioController::class . ':TraerTodos');
    $group->get('/{id}', \UsuarioController::class . ':TraerUno');
    $group->get('/estadoEmpleados/', \UsuarioController::class . ':EstadoEmpleados');
    $group->post('[/]', \UsuarioController::class . ':CargarUno');
    $group->put('[/]', \UsuarioController::class . ':ModificarUno');
    $group->delete('/{id}', \UsuarioController::class . ':BorrarUno');
  })
  ->add(\UsuariosMiddleware::class . ':VerificarAccesoSocio')
  ->add(\AutenticacionMiddelware::class . ':VerificarToken');

// PRODUCTOS, cualquier puede actualizar ya que puede aprenderse recetas nuevas... 

$app->group('/productos', function (RouteCollectorProxy $group) {
  $group->get('[/]', \ProductoController::class . ':TraerTodos');
  $group->get('/{id}', \ProductoController::class . ':TraerUno');
  $group->post('[/]', \ProductoController::class . ':CargarUno');
  $group->put('[/]', \ProductoController::class . ':ModificarUno');
  $group->delete('/{id}', \ProductoController::class . ':BorrarUno');
})
->add(\AutenticacionMiddelware::class . ':VerificarToken');

// MESAS, SOLO MOZOS Y SOCIO.

$app->group('/mesas', function (RouteCollectorProxy $group) {
  $group->get('[/]', \MesaController::class . ':TraerTodos');
  $group->get('/{id}', \MesaController::class . ':TraerUno');
  $group->post('[/]', \MesaController::class . ':CargarUno');
  $group->put('[/]', \MesaController::class . ':ModificarUno');
  $group->post('/actualizarEstadoDeMesa', \MesaController::class . ':actualizarEstadoDeMesa');
  $group->post('/cuentaCero', \MesaController::class . ':CuentaCero');
  $group->post('/obtenerCuenta', \MesaController::class . ':obtenerCuenta');
  $group->delete('/{id}', \MesaController::class . ':BorrarUno');
})
->add(\UsuariosMiddleware::class . ':VerificarAccesoMozo')
->add(\AutenticacionMiddelware::class . ':VerificarToken');

// PEDIDOS
$app->group('/pedidos', function (RouteCollectorProxy $group) {
  $group->get('[/]', \PedidoController::class . ':TraerTodos');
  $group->get('/{id}', \PedidoController::class . ':TraerUno');
  $group->get('/obtenerPorTipo/', \PedidoController::class . ':TraerPorSector');
  $group->get('/tiempoEsperaPedido/{id}', \PedidoController::class . ':ObtenerDemoraPedido');
  $group->post('[/]', \PedidoController::class . ':CargarUno');
  $group->post('/sacarFoto', \PedidoController::class . ':SacarFotoCliente');
  $group->put('[/]', \PedidoController::class . ':ModificarUno');
  $group->put('/actualizarEstadoPedido/', \PedidoController::class . ':ActualizarEstadoPedidoSegunSector');
  $group->delete('/{id}', \PedidoController::class . ':BorrarUno');
})
->add(\AutenticacionMiddelware::class . ':VerificarToken');

// ENCUESTAS
$app->group('/encuenta', function (RouteCollectorProxy $group) {
  $group->get('[/]', \EncuestaController::class . ':TraerTodos');
  $group->get('/{id}', \EncuestaController::class . ':TraerUno');
  $group->post('[/]', \EncuestaController::class . ':CargarUno');
})
->add(\UsuariosMiddleware::class . ':VerificarAccesoCliente')
->add(\AutenticacionMiddelware::class . ':VerificarToken');

// SOCIOS
$app->group('/socios', function (RouteCollectorProxy $group) {
  $group->get('/pdf', \EncuestaController::class . ':ObtenerPdfEncuestas');
  $group->get('/BBDDtoCSV', \EncuestaController::class . ':BDDtoCsv');
  $group->get('/CSVtoBBDD', \EncuestaController::class . ':CSVtoBDD');
  $group->get('/MejoresComentarios', \EncuestaController::class . ':MejoresComentarios');
})
->add(\UsuariosMiddleware::class . ':VerificarAccesoSocio')
->add(\AutenticacionMiddelware::class . ':VerificarToken');


  
// Run app
$app->run();

