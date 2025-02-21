<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PDFController;
use Controllers\CajaController;
use Controllers\AdminController;
use Controllers\DeudaController;
use Controllers\LoginController;
use Controllers\UsersController;
use Controllers\ReportesController;
use Controllers\GenericasController;
use Controllers\NotificationsController;
use Controllers\NotificationesController;

$router = new Router();

//AQUI VAN LAS URLS QUE SE PUEDEN ENCONTRAR

//Ruta de error 404
$router->get('/not-found', [LoginController::class, 'notFound']);

//Actions LOGIN / SESSION
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/cambiar-password', [LoginController::class, 'cambiarPassword']);
$router->post('/cambiar-password', [LoginController::class, 'cambiarPassword']);
$router->get('/reestablecer-password', [LoginController::class, 'reestablecerPassword']);
$router->post('/reestablecer-password', [LoginController::class, 'reestablecerPassword']);
$router->get('/mensaje', [LoginController::class, 'mensajeInstrucciones']);
$router->get('/close', [LoginController::class, 'cerrarSession']);

//WELCOME
$router->get('/welcome', [LoginController::class, 'welcome']);

//Actions ADMINISTRATOR
$router->get('/general', [AdminController::class, 'index']);
$router->get('/empleados', [AdminController::class, 'employees']);
$router->get('/roles', [AdminController::class, 'roles']);
$router->get('/api/empleados', [AdminController::class, 'empleadosAPI']);
$router->post('/api/empleado', [AdminController::class, 'guardarEmpleado']);
$router->post('/api/empleado-actualizar', [AdminController::class, 'actualizarEmpleado']);
$router->post('/api/empleado-eliminar', [AdminController::class, 'eliminarEmpleado']);
$router->get('/api/roles', [AdminController::class, 'rolesAPI']);
$router->post('/api/rol', [AdminController::class, 'guardarRol']);
$router->post('/api/rol-actualizar', [AdminController::class, 'actualizarRol']);
$router->post('/api/rol-eliminar', [AdminController::class, 'eliminarRol']);

//Actions REPORTES
$router->get('/reportes', [ReportesController::class, 'index']);
$router->get('/reporte', [ReportesController::class, 'reporte']);
$router->get('/generar-reporte', [ReportesController::class, 'formReporte']);
$router->get('/editar-reporte', [ReportesController::class, 'editFormReporte']);
$router->get('/api/reporteID', [ReportesController::class, 'JSONreporte']);
$router->post('/api/reporte', [ReportesController::class, 'generarReporte']);
$router->post('/api/reporte/editar', [ReportesController::class, 'actualizarReporte']);
$router->post('/api/reporte/eliminar', [ReportesController::class, 'eliminarReporte']);
$router->get('/api-reportes', [ReportesController::class, 'reportesAPI']);

$router->post('/api/notas-reportes', [ReportesController::class, 'notasAPI']);
$router->post('/api/nota-reporte', [ReportesController::class, 'generarNotaReporte']);
$router->post('/api/nota-reporte/eliminar', [ReportesController::class, 'eliminarNota']);
$router->post('/api/material', [ReportesController::class, 'guardarMateriales']);
$router->post('/api/materiales-reportes', [ReportesController::class, 'materialesAPI']);

//Actions Usuarios
$router->get('/api/usuarios', [UsersController::class, 'usersAPI']);
$router->get('/api/usuario', [UsersController::class, 'usuario']);
$router->get('/api/users', [UsersController::class, 'datosBusqueda']);

//Actions CAJA
$router->get('/consultar', [CajaController::class, 'index']);
$router->get('/deuda-usuario', [DeudaController::class, 'totalDebt']);
$router->get('/deuda-desglosada', [DeudaController::class, 'desgloseDebt']);
$router->post('/api/deuda-mostrar', [CajaController::class, 'getDeuda']);
$router->post('/api/pago-total', [CajaController::class, 'setPagoTotal']);
$router->post('/api/pago-parcial', [CajaController::class, 'setPagoParciales']);
$router->post('/api/pago-unico', [CajaController::class, 'setPagoUnico']);

$router->post('/condonacion-parcial', [CajaController::class, 'setCondonaciones']);
$router->post('/api/condonacion-unico', [CajaController::class, 'setCondonacionUnico']);
$router->post('/api/condonacion-recargos', [CajaController::class, 'setCondonacionRecargos']);


$router->get('/pagar-total', [CajaController::class, 'viewPagoTotal']);
$router->get('/consultar-avanzados', [CajaController::class, 'getAvanzados']);

// Actions Notificaciones
$router->get('/notificaciones', [NotificationesController::class, 'index']);
$router->get('/notificaciones/deudores', [NotificationesController::class, 'deudores']);
$router->get('/notificaciones/medido', [NotificationesController::class, 'medido']);
$router->get('/agenda', [NotificationesController::class, 'agenda']);
$router->get('/lecturas', [NotificationesController::class, 'lecturas']);

//PDF
$router->get('/pdf/recibo', [PDFController::class, 'recibo']);

//OTROS
$router->get('/api/categorias', [GenericasController::class, 'categorias']);
$router->get('/api/incidencias', [GenericasController::class, 'incidenciasCat']);
$router->post('/api/incidencias', [GenericasController::class, 'incidenciasCat']);
$router->get('/api/prioridades', [GenericasController::class, 'prioridadesRep']);
$router->get('/api/materiales', [GenericasController::class, 'materialesRep']);
$router->get('/api/unidades', [GenericasController::class, 'unidadesRep']);
$router->get('/api/colonias', [GenericasController::class, 'colonias']);
$router->get('/api/zonas', [GenericasController::class, 'zonas']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
