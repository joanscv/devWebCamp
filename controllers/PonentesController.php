<?php

namespace Controllers;

use Model\Ponente;
use MVC\Router;
//use Intervention\Image\ImageManager;
//use Intervention\Image\Drivers\Gd\Driver;
//use Intervention\Image\Drivers\Imagick\Driver;


///////////////////////
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Encoders\GifEncoder;

class PonentesController {
    public static function index(Router $router){
        $router->render('admin/ponentes/index', [
            'titulo' => "Ponentes / Conferencistas"
        ]);
    }
    public static function crear(Router $router){

        //session_start();
        //isAuth();

        $alertas = [];
        $ponente = new Ponente;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $manager = new ImageManager(Driver::class);
            $imagen_png = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800)->encode(new AutoEncoder(quality:80));
            $imagen_webp = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800)->encode(new WebpEncoder(quality:80));

            debuguear("Hey Jude");

            // Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/speakers';
                /*if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0755, true);
                }*/
                /*$manager = new ImageManager(Driver::class);
                $imagen_png = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800)->toPng();
                //$imagen_webp = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800)->toWebp(80);
                $imagen_avif = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800)->toAvif(80);*/

                $nombre_imagen = md5( uniqid( rand(), true ) ); 
                $_POST['imagen'] = $nombre_imagen;
            } 
            debuguear( json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES) );
            // Guardar datos del POST en el objeto ponente
            $ponente->sincronizar($_POST);
            // Validar la información proveniente del formulario
            $alertas = $ponente->validar();
            // Guardar el registro
            if(empty($alertas)){
                // Guardar las imágenes
                //$imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                //$imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');

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
            'ponente' => $ponente
        ]);
    }
}