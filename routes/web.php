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
//  rutas login
Route::get('/', function () {
    return view('login');
})->name('login_usuario');

Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::post('/sesion', [App\Http\Controllers\LoginController::class, 'login'])->name('sesion');

// home estudiantes
Route::get('/inicio_estudiantes', function () {
    return view('home_estudiantes');
})->middleware('auth');


// rutas inicio
Route::get('/inicio', function () {
    return view('home');
})->name('inicio')->middleware('auth');

// rutas usuario
Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->middleware('auth')->name('usuarios');
Route::post('/usuarios/guardar', [App\Http\Controllers\UsuarioController::class, 'store'])->middleware('auth');
Route::post('/usuarios/eliminar', [App\Http\Controllers\UsuarioController::class, 'delete'])->middleware('auth');


// rutas alumno
Route::get('/alumnos', [App\Http\Controllers\AlumnoController::class, 'index'])->middleware('auth')->name('alumnos');
Route::post('/alumnos/guardar', [App\Http\Controllers\AlumnoController::class, 'store'])->middleware('auth');
Route::post('/alumnos/eliminar', [App\Http\Controllers\AlumnoController::class, 'delete'])->middleware('auth');

// rutas docente
Route::get('/docentes', [App\Http\Controllers\DocenteController::class, 'index'])->middleware('auth')->name('docentes');
Route::post('/docentes/guardar', [App\Http\Controllers\DocenteController::class, 'store'])->middleware('auth');
Route::post('/docentes/eliminar', [App\Http\Controllers\DocenteController::class, 'delete'])->middleware('auth');

// rutas materia
Route::get('/materias', [App\Http\Controllers\MateriaController::class, 'index'])->middleware('auth')->name('materias');
Route::post('/materias/guardar', [App\Http\Controllers\MateriaController::class, 'store'])->middleware('auth');
Route::post('/materias/eliminar', [App\Http\Controllers\MateriaController::class, 'delete'])->middleware('auth');

// rutas gestion
Route::get('/gestiones', [App\Http\Controllers\GestionController::class, 'index'])->middleware('auth')->name('gestiones');
Route::post('/gestiones/guardar', [App\Http\Controllers\GestionController::class, 'store'])->middleware('auth');
Route::post('/gestiones/eliminar', [App\Http\Controllers\GestionController::class, 'delete'])->middleware('auth');

// rutas cursos
Route::get('/cursos', [App\Http\Controllers\CursoController::class, 'index'])->middleware('auth')->name('cursos');
Route::post('/cursos/guardar', [App\Http\Controllers\CursoController::class, 'store'])->middleware('auth');
Route::post('/cursos/eliminar', [App\Http\Controllers\CursoController::class, 'delete'])->middleware('auth');

// rutas horarios
Route::get('/horarios', [App\Http\Controllers\HorarioController::class, 'index'])->middleware('auth')->name('horarios');
Route::post('/horarios/guardar', [App\Http\Controllers\HorarioController::class, 'store'])->middleware('auth');
Route::post('/horarios/eliminar', [App\Http\Controllers\HorarioController::class, 'delete'])->middleware('auth');

// rutas curso_gestion
Route::get('/cursogestion', [App\Http\Controllers\CursoGestionController::class, 'index'])->middleware('auth')->name('cursogestion');
Route::get('/cursogestion/frm_guardar', [App\Http\Controllers\CursoGestionController::class, 'frmGuardar'])->middleware('auth');
Route::post('/cursogestion/guardar', [App\Http\Controllers\CursoGestionController::class, 'store'])->middleware('auth');
Route::post('/cursogestion/eliminar', [App\Http\Controllers\CursoGestionController::class, 'delete'])->middleware('auth');
Route::post('/cursogestion/activar', [App\Http\Controllers\CursoGestionController::class, 'activar'])->middleware('auth');
Route::post('/cursogestion/desactivar', [App\Http\Controllers\CursoGestionController::class, 'desactivar'])->middleware('auth');


Route::get('/cursogestion/ver', [App\Http\Controllers\CursoGestionController::class, 'verCursos'])->middleware('auth');
Route::get('/cursogestion/editar', [App\Http\Controllers\CursoGestionController::class, 'verCursos'])->middleware('auth');
Route::post('/cursogestion/modificar', [App\Http\Controllers\CursoGestionController::class, 'editarCursos'])->middleware('auth');

// rutas materia gestion
Route::get('/materiagestion', [App\Http\Controllers\MateriaGestionController::class, 'index'])->middleware('auth')->name('materiagestion');
Route::post('/materiagestion/guardar', [App\Http\Controllers\MateriaGestionController::class, 'store'])->middleware('auth');
Route::get('/materiagestion/ver', [App\Http\Controllers\MateriaGestionController::class, 'verDetalle'])->middleware('auth');
Route::post('/materiagestion/modificar', [App\Http\Controllers\MateriaGestionController::class, 'modificarMateriaGestion'])->middleware('auth');
Route::get('/materiagestion/cursosgestion', [App\Http\Controllers\MateriaGestionController::class, 'verCursosGestion'])->middleware('auth');

// rutas inscripcion
Route::get('/inscripcion', [App\Http\Controllers\InscripcionController::class, 'index'])->middleware('auth')->name('inscripcion');
Route::post('/inscripcion/guardar', [App\Http\Controllers\InscripcionController::class, 'store'])->middleware('auth');
Route::get('/inscripcion2', [App\Http\Controllers\InscripcionController::class, 'index2'])->middleware('auth')->name('inscripcion2');
Route::get('/get_inscripciones', [App\Http\Controllers\InscripcionController::class, 'getInscripciones'])->middleware('auth');
Route::get('/get_alumnos', [App\Http\Controllers\InscripcionController::class, 'getAlumnos'])->middleware('auth');
Route::get('/get_cursogestiones', [App\Http\Controllers\InscripcionController::class, 'getCursogestiones'])->middleware('auth');
Route::post('/inscripcion/activar', [App\Http\Controllers\InscripcionController::class, 'activar'])->middleware('auth');
Route::post('/inscripcion/desactivar', [App\Http\Controllers\InscripcionController::class, 'desactivar'])->middleware('auth');









Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
