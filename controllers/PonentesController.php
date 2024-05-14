<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Ponente;
use MVC\Router;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class PonentesController {
    public static function index(Router $router){
        if(!is_admin()){
            header('Location: /login');
        }
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual<1){
            header('Location: /admin/ponentes?page=1');
        }
        $registros_por_pagina = 10;

        $total = Ponente::total();

        $paginacion = new Paginacion($pagina_actual,
                                     $registros_por_pagina,
                                     $total);

        // debuguear($paginacion);

        $ponentes = Ponente::all();

        $router->render('admin/ponentes/index', [
            'titulo' => "Ponentes / Conferencistas",
            'ponentes' => $ponentes
        ]);
    }

    public static function crear(Router $router){
        if(!is_admin()){
            header('Location: /login');
        }
        $alertas = [];
        $ponente = new Ponente;
        $redes = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/speakers';
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0755, true);
                }
                $manager = new ImageManager(Driver::class);
                $imagen_png = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800)->toPng();
                $imagen_webp = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800)->toWebp(80);
                //$imagen_avif = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800)->toAvif(80);

                $nombre_imagen = md5( uniqid( rand(), true ) ); 
                $_POST['imagen'] = $nombre_imagen;
            } 
            $redes = $_POST['redes'];
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            // Guardar datos del POST en el objeto ponente
            $ponente->sincronizar($_POST);
            // Validar la información proveniente del formulario
            $alertas = $ponente->validar();
            // Guardar el registro
            if(empty($alertas)){
                // Guardar las imágenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                //$imagen_avif->save($carpeta_imagenes . '/' . $nombre_imagen . '.avif');
                // Guardar en la BD
                $resultado = $ponente->guardar();
                // Redireccionar al usuario
                if($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/crear', [
            'titulo' => "Registrar Ponente",
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => $redes
        ]);
    }

    public static function editar(Router $router){
        if(!is_admin()){
            header('Location: /login');
        }
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /admin/ponentes');
        }
        // Obtener Ponente a editar
        $ponente = Ponente::find($id);
        if(!$ponente) {
            header('Location: /admin/ponentes');
        }
        $redes = json_decode($ponente->redes, associative:true);
        $imagen_actual = $ponente->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer imagen en caso de que el usuario haya decidido subir una nueva imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/speakers';

                $manager = new ImageManager(Driver::class);
                $imagen_png = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800)->toPng();
                $imagen_webp = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800)->toWebp(80);
                //$imagen_avif = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800)->toAvif(80);

                $nombre_imagen = md5( uniqid( rand(), true ) ); 
                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $imagen_actual;
            }
            $redes = $_POST['redes'];
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            $ponente->sincronizar($_POST);
            $alertas = $ponente->validar();

            if(empty($alertas)) {
                if(isset($nombre_imagen)){
                    // Guardar las imágenes
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                    //$imagen_avif->save($carpeta_imagenes . '/' . $nombre_imagen . '.avif');

                    // Eliminar imagenes anteriores
                    $formatos_imagenes = ['.png', '.webp'];
                    foreach($formatos_imagenes as $formato):
                        $existeArchivo = file_exists($carpeta_imagenes . '/' . $imagen_actual . $formato);
                        if($existeArchivo):
                            unlink($carpeta_imagenes . '/' . $imagen_actual . $formato);
                        endif;      
                    endforeach; 
                }
                $resultado = $ponente->guardar();
                if($resultado){
                    header('Location: /admin/ponentes');
                }
            }

        }

        $router->render('admin/ponentes/editar', [
            'titulo'=>'Actualizar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'imagen_actual' => $imagen_actual,
            'redes' => $redes 
        ]);
    }

    public static function eliminar() {
        if(!is_admin()){
            header('Location: /login');
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id) {
                header('Location: /admin/ponentes');
            }
            // Obtener Ponente a editar
            $ponente = Ponente::find($id);
            if(!$ponente) {
                header('Location: /admin/ponentes');
            }
            // Eliminar ponente
            $carpeta_imagenes = '../public/img/speakers';
            $imagen_actual = $ponente->imagen;
            $resultado = $ponente->eliminar();
            if($resultado){
                // Eliminar imagenes anteriores
                $formatos_imagenes = ['.png', '.webp'];
                foreach($formatos_imagenes as $formato):
                    $existeArchivo = file_exists($carpeta_imagenes . '/' . $imagen_actual . $formato);
                    if($existeArchivo):
                        unlink($carpeta_imagenes . '/' . $imagen_actual . $formato);
                    endif;      
                endforeach;
                header('Location: /admin/ponentes');
            }
        }
    }
}