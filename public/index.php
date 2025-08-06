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
use Controllers\TanquesController;
use Controllers\NotificacionesController;
use Controllers\UpdatesController;




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
$router->get('/api/bempleados', [AdminController::class, 'bempleados']);


//Actions REPORTES
$router->get('/reportes', [ReportesController::class, 'index']);
$router->get('/reporte', [ReportesController::class, 'reporte']);
$router->get('/generar-reporte', [ReportesController::class, 'formReporte']);
$router->get('/editar-reporte', [ReportesController::class, 'editFormReporte']);
$router->get('/api/reporteID', [ReportesController::class, 'JSONreporte']);
$router->post('/api/reporte', [ReportesController::class, 'generarReporte']);
$router->post('/api/reporte/editar', [ReportesController::class, 'actualizarReporte']);
$router->post('/api/reporte/eliminar', [ReportesController::class, 'eliminarReporte']);
$router->get('/reporte/estado', [ReportesController::class, 'statusReporte']);
$router->post('/reporte/estado/actualizar', [ReportesController::class, 'actualizarStatusReporte']);
$router->get('/api-reportes', [ReportesController::class, 'reportesAPI']);
$router->get('/filtrar-reportes', [ReportesController::class, 'filtrar']);
$router->post('/filtrar-reportes-coincidencias', [ReportesController::class, 'filtrarReportes']);
$router->post('/filtrar-reportes-coincidencias-exacto', [ReportesController::class, 'filtrarReportesCoincidencias']);


$router->get('/notas-reportes', [ReportesController::class, 'notasAPI']);
$router->post('/api/nota-reporte', [ReportesController::class, 'generarNotaReporte']);
$router->post('/api/nota-reporte/eliminar', [ReportesController::class, 'eliminarNota']);
$router->post('/api/material', [ReportesController::class, 'guardarMateriales']);
$router->post('/api/material/eliminar', [ReportesController::class, 'eliminarMateriales']);
$router->get('/reporte/evidencias', [ReportesController::class, 'obtenerEvidencias']);
$router->post('/reporte/evidencias-guardar', [ReportesController::class, 'guardarEvidencias']);
$router->get('/api/materiales-reportes', [ReportesController::class, 'materialesAPI']);
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

//Actions Caja
$router->get('/consultar', [CajaController::class, 'index']);
$router->get('/deuda-usuario', [DeudaController::class, 'totalDebt']);
$router->get('/deuda-desglosada', [DeudaController::class, 'desgloseDebt']);
$router->post('/api/pago-total', [CajaController::class, 'setPagoTotal']);
$router->post('/condonacion-parcial', [CajaController::class, 'setCondonaciones']);
$router->get('/pagar-total', [CajaController::class, 'viewPagoTotal']);
$router->get('/consultar-avanzados', [CajaController::class, 'getAvanzados']);
$router->get('/consultar-condonaciones', [CajaController::class, 'getCondonaciones']);
$router->get('/consultar-condonaciones-listado', [CajaController::class, 'getListadoCondonaciones']);
$router->post('/deshacer-condonacion', [CajaController::class, 'deshacerCondonacion']);
$router->get('/adicionales', [CajaController::class, 'getPagosAdicionales']);
$router->post('/pago-parcial', [CajaController::class, 'pagoCostosAdicionales']);
$router->get('/historial-recibos', [CajaController::class, 'getRecibos']);

$router->get('/crear-corte', [CajaController::class, 'crearCorte']);
$router->post('/crear-corte', [CajaController::class, 'crearCorte']);
$router->get('/solicitar-arqueo', [CajaController::class, 'solicitarArqueo']);
$router->get('/arqueos', [CajaController::class, 'arqueo']);
$router->post('/eliminar-corte', [CajaController::class, 'eliminarCorte']);

$router->post('/cancelar-recibo', [CajaController::class, 'cambiarEstadoRecibo']);

// Actions Notificaciones
$router->get('/notificaciones', [NotificacionesController::class, 'index']);
$router->get('/lecturas', [NotificacionesController::class, 'lecturas']);
$router->get('/agenda', [NotificacionesController::class, 'agenda']);
$router->get('/agendalec', [NotificacionesController::class, 'agendalec']);
$router->get('/notifications', [GenericasController::class, 'notificaciones']);
$router->get('/medids', [GenericasController::class, 'medidos']);
$router->get('/formularioagenda', [NotificacionesController::class, 'formularioagenda']);
$router->get('/formularioagendalec', [NotificacionesController::class, 'formularioagendalec']);
$router->get('/api/tiposNotificacion', [GenericasController::class, 'tipo_notificacion']);
$router->get('/consulta-not', [NotificacionesController::class, 'constultanot']);
$router->get('/consulta-lec', [NotificacionesController::class, 'consultalec']);
$router->get('/api/notificaciones', [NotificacionesController::class, 'notificaciones']);
$router->get('/api/medidos', [NotificacionesController::class, 'consultarMedidos']);
$router->get('/api/medidores', [GenericasController::class, 'medidoresapi']);


$router->post('/notificaciones', [NotificacionesController::class, 'index']);
$router->post('/lecturas', [NotificacionesController::class, 'lecturas']);
$router->post('/notificaciones-registro', [NotificacionesController::class, 'guardarNotificacion']);
$router->post('/notificaciones-registrolec', [NotificacionesController::class, 'guardarLectura']);
$router->post('/notificaciones/eliminar', [NotificacionesController::class, 'eliminarNotificacion']);
$router->post('/medids/eliminar', [NotificacionesController::class, 'eliminarNotificacionLectura']);
$router->post('/notificaciones/agenda', [NotificacionesController::class, 'guardarReporteNotificacion']);
$router->post('/notificaciones/registro-extra', [NotificacionesController::class, 'guardarExtraNotificacion']);
$router->post('/api/notificaciones/agenda-lec', [NotificacionesController::class, 'guardarReporteLectura']);
$router->post('/actualizar-lectura', [NotificacionesController::class, 'actualizarLectura']);
$router->post('/meses-lecturas', [NotificacionesController::class, 'obtenerMesesConLectura']);
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
$router->get('/pdf/notificaciones', [PDFController::class, 'notificaciones']);
$router->get('/pdf/not-realizadas', [PDFController::class, 'notRealizadas']);



//OTROS
$router->get('/api/categorias', [GenericasController::class, 'categorias']);
$router->get('/api/incidencias', [GenericasController::class, 'incidenciasCat']);
$router->post('/api/incidencias', [GenericasController::class, 'incidenciasCat']);
$router->get('/api/prioridades', [GenericasController::class, 'prioridadesRep']);
$router->get('/api/materiales', [GenericasController::class, 'materialesRep']);
$router->get('/api/unidades', [GenericasController::class, 'unidadesRep']);
$router->get('/api/colonias', [GenericasController::class, 'colonias']);
$router->get('/api/zonas', [GenericasController::class, 'zonas']);
$router->get('/cuentas-adicionales', [GenericasController::class, 'cuentasAdicionales']);
$router->get('/api/tipotoma', [GenericasController::class, 'tipotoma']);
$router->get('/api/tipoconsumo', [GenericasController::class, 'tipoconsumo']);
$router->get('/api/medido', [GenericasController::class, 'medido']);


$router->comprobarRutas();
