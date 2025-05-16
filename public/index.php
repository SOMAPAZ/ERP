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
use Controllers\ImagenesController;
use Controllers\TanquesController;
use Controllers\UpdatesController;

// use Controllers\NotificationesController;

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
$router->get('/reportes-abiertos', [ReportesController::class, 'reportesAbiertos']);
$router->get('/reportes-cerrados', [ReportesController::class, 'reportesCerrados']);
$router->get('/reportes-proceso', [ReportesController::class, 'reportesProceso']);
$router->get('/reportes-terminados', [ReportesController::class, 'reportesTerminados']);
$router->get('/reporte', [ReportesController::class, 'reporte']);
$router->get('/generar-reporte', [ReportesController::class, 'generarReporte']);
$router->post('/generar-reporte', [ReportesController::class, 'generarReporte']);
$router->get('/editar-reporte', [ReportesController::class, 'editarReporte']);
$router->post('/editar-reporte', [ReportesController::class, 'editarReporte']);
$router->post('/crear-comentario', [ReportesController::class, 'crearComentario']);
$router->get('/api/reporte', [ReportesController::class, 'reporteAPI']);
$router->get('/crear-nota_reporte', [ReportesController::class, 'formNotaReporte']);
$router->post('/crear-nota_reporte', [ReportesController::class, 'generarNotaReporte']);
$router->get('/crear-material_reporte', [ReportesController::class, 'generarMaterialReporte']);
$router->post('/crear-material_reporte', [ReportesController::class, 'generarMaterialReporte']);
$router->post('/api/cambiar-estado_reporte', [ReportesController::class, 'cambiarEstado']);
$router->post('/eliminar-reporte', [ReportesController::class, 'eliminarReporte']);
$router->get('/reporte/pdf', [PDFController::class, 'reportePDF']);

//Actions Usuarios
$router->get('/datos-usuarios-crear', [UsersController::class, 'crearUsuario']);
$router->post('/datos-usuarios-crear', [UsersController::class, 'crearUsuario']);
$router->get('/datos-usuarios-editar', [UsersController::class, 'editarUsuario']);
$router->post('/datos-usuarios-editar', [UsersController::class, 'editarUsuario']);
$router->post('/datos-usuarios-eliminar', [UsersController::class, 'eliminarUsuario']);

$router->get('/usuarios', [UsersController::class, 'index']);
$router->get('/buscar-usuario', [UsersController::class, 'buscarUsuario']);
$router->get('/api/usuarios', [UsersController::class, 'usersAPI']);
$router->get('/api/usuario', [UsersController::class, 'usuario']);
$router->get('/api/users', [UsersController::class, 'datosBusqueda']);
$router->get('/api/user', [UsersController::class, 'getUsuario']);


// // Actions CAJA
$router->get('/consultar', [CajaController::class, 'index']);
$router->get('/caja-cobro', [CajaController::class, 'getDeuda']);
$router->get('/pagar-servicio', [CajaController::class, 'pagarServicio']);

$router->get('/deuda-usuario', [DeudaController::class, 'totalDebt']);
$router->get('/deuda-desglosada', [DeudaController::class, 'desgloseDebt']);
$router->post('/api/pago-total', [CajaController::class, 'setPagoTotal']);
$router->post('/condonacion-parcial', [CajaController::class, 'setCondonaciones']);
$router->get('/pagar-total', [CajaController::class, 'viewPagoTotal']);
$router->get('/consultar-condonaciones', [CajaController::class, 'getCondonaciones']);
$router->get('/consultar-condonaciones-listado', [CajaController::class, 'getListadoCondonaciones']);
$router->post('/deshacer-condonacion', [CajaController::class, 'deshacerCondonacion']);
$router->post('/pago-parcial', [CajaController::class, 'pagoCostosAdicionales']);
$router->get('/historial-recibos', [CajaController::class, 'getRecibos']);

$router->get('/crear-corte', [CajaController::class, 'crearCorte']);
$router->post('/crear-corte', [CajaController::class, 'crearCorte']);
$router->get('/solicitar-arqueo', [CajaController::class, 'solicitarArqueo']);
$router->get('/arqueos', [CajaController::class, 'arqueo']);
$router->post('/eliminar-corte', [CajaController::class, 'eliminarCorte']);

$router->post('/cancelar-recibo', [CajaController::class, 'cambiarEstadoRecibo']);

// // Actions Updates
$router->get('/datos-usuarios', [UpdatesController::class, 'index']);

// // Actions Tanques
$router->get('/tanks', [TanquesController::class, 'index']);
$router->get('/graficos', [TanquesController::class, 'index']);
$router->get('/tanques', [TanquesController::class, 'tanques']);
$router->get('/tanques-registros', [TanquesController::class, 'getInformacion']);
$router->get('/generar-registro', [TanquesController::class, 'generarRegistro']);
$router->post('/guardar-registro', [TanquesController::class, 'guardarRegistro']);


// //PDF
$router->get('/pdf/recibo', [PDFController::class, 'recibo']);
$router->get('/pdf/recibo-adicionales', [PDFController::class, 'reciboAdicionales']);
$router->get('/pdf/corte-caja', [PDFController::class, 'corteCaja']);
$router->get('/pdf/contrato-servicio', [PDFController::class, 'contratoServicio']);

//OTROS
$router->get('/api/categorias', [GenericasController::class, 'categorias']);
$router->get('/api/incidencias', [GenericasController::class, 'incidenciasCat']);
$router->get('/api/prioridades', [GenericasController::class, 'prioridadesRep']);
$router->get('/api/materiales', [GenericasController::class, 'materialesRep']);
$router->get('/api/unidades', [GenericasController::class, 'unidadesRep']);
$router->get('/api/colonias', [GenericasController::class, 'colonias']);
$router->get('/api/zonas', [GenericasController::class, 'zonas']);
$router->get('/cuentas-adicionales', [GenericasController::class, 'cuentasAdicionales']);
$router->get('/api/estados-reportes', [GenericasController::class, 'estadosReportes']);

$router->comprobarRutas();
