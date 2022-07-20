<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*DEVUELVE DATOS*/
//Route::post('/listarPersonal', 'PersonalController@index');
//ROUTES COLEGIO
Route::post('/listarColegio', 'ColegioController@index');
Route::post('/registrarColegio', 'ColegioController@registrarColegio');
Route::put('/editarColegio', 'ColegioController@updateColegio');
Route::put('/desactivarColegio', 'ColegioController@desactivarColegio');
Route::put('/activarColegio', 'ColegioController@activarColegio');
Route::get('/selectColegios','ColegioController@selectColegio');
Route::post('/datosColegio', 'ColegioController@datosColegio');

//FIN ROUTES COLEGIO

//ROUTES NIVEL
Route::get('/selectNiveles','NivelController@selectNivel');
Route::post('/nivelesColegio','NivelController@selectBuscarNivel');
//FIN ROUTES NIVEL

//ROUTES CURSO
Route::get('/selectCursos','CursoController@selectCurso');
Route::post('/cursosColegio','CursoController@selectBuscarCurso');
Route::post('/paralelosColegio','CursoController@selectBuscarParalelo');
Route::post('/estudiantesCurso','EstudianteCursosController@estudiantesCurso');


// Route::post('/cursosColegio','CursoController@cursosColegio');
//FIN ROUTES CURSO

//ROUTES ESTUDIANTE
Route::post('/listarEstudiante', 'EstudianteController@index');
Route::post('/registrarEstudiante', 'EstudianteController@registrarEstudiante');
Route::put('/editarEstudiante', 'EstudianteController@updateEstudiante');
//FIN ROUTES ESTUDIANTE

//ROUTES ESTUDIANTE
Route::put('/designarEstudiante', 'EstudianteCursosController@designarEstudiante');

//FIN ROUTES ESTUDIANTE

//ROUTES CAMPO
Route::post('/campoNivel','CampoController@selectBuscarCampo');
//FIN ROUTES CAMPO

//ROUTE AREA
Route::post('/areaCampo','AreaController@selectBuscarArea');
//FIN ROUTE AREA

//REPORTES SISTEMA
Route::get('/reporteListarEstudiantes','ReporteController@listadoEstudiantes');
//FIN REPORTES SISTEMA



//SELECT DINAMICOS
Route::get('/destinos_nivel1/selectDestinos_nivel1', 'DestinosNivel1Controller@selectDestinosNivel1');
Route::get('/destinos_nivel2/selectDestinos_nivel2', 'DestinosNivel2Controller@selectDestinosNivel2');
Route::get('/destinos_nivel2/selectbuscarDestinos_nivel2', 'DestinosNivel2Controller@selectbuscarDestinosNivel2');
Route::get('/destinos_nivel3/selectDestinos_nivel3', 'DestinosNivel3Controller@selectDestinosNivel3');
Route::get('/destinos_nivel3/selectbuscarDestinos_nivel3', 'DestinosNivel3Controller@selectbuscarDestinosNivel3');
Route::get('/destinos_nivel4/selectDestinos_nivel4', 'DestinosNivel4Controller@selectDestinosNivel4');
Route::get('/destinos_nivel4/selectbuscarDestinos_nivel4', 'DestinosNivel4Controller@selectbuscarDestinosNivel4');
//FIN SELECTS DINAMICOS
//BUSCADOR CON SELECT
Route::get('/listarCargos','CargosController@ListarCargos');
//FIN BUSCADOR CON SELECT
//REPORTE FPDF
//Route::get('/reporte', 'ReporteDestinosController@createPDF');
//REPORTE DOMPDF
Route::get('/reporteIndividual','ReportesDestinosController@ReporteIndividualDestinos');
Route::get('/certificadoIndividual','ReportesDestinosController@CertificadoIndividualDestinos');
//FIN REPORTE
Route::post('/datosPersonal','PersonalDatosController@index');

Route::get('/{optional?}', function () {
    return view('app');
})->name('basepath')
   ->where('optional','.*');

