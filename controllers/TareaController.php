<?php 

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController {
    public static function index() {
        $proyectoUrl = $_GET['url'];

        if(!$proyectoUrl) header('Location: /dashboard');

        $proyecto = Proyecto::where('url', $proyectoUrl);

        if(!$proyecto || $proyecto->propietarioID !== $_SESSION['id']) header('Location: /404');

        $tareas = Tarea::belongsTo('proyectoID', $proyecto->id);

        echo json_encode(['tareas' => $tareas]);
    }

    public static function crear() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $proyecto = Proyecto::where('url', $_POST['proyectoUrl']);

            if(!$proyecto || $proyecto->propietarioID !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al agregar la tarea'
                ];

                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $tarea->proyectoID = $proyecto->id;
            $resultado = $tarea->guardar();

            if($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $resultado['id'],
                    'mensaje' => 'Tarea creada correctamente',
                    'proyectoID' => $proyecto->id
                ];
            }

            echo json_encode($respuesta);
        }
    }

    public static function actualizar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $proyecto = Proyecto::where('url', $_POST['proyectoUrl']);

            if(!$proyecto || $proyecto->propietarioID !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al actualizar la tarea'
                ];

                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $tarea->proyectoID = $proyecto->id;
            $resultado = $tarea->guardar();

            if($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $tarea->id,
                    'proyectoID' => $proyecto->id,
                    'mensaje' => 'Actualizado Correctamente'
                ];
            }
            echo json_encode($respuesta);
        }
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
             
            $proyecto = Proyecto::where('url', $_POST['proyectoUrl']);

            if(!$proyecto || $proyecto->propietarioID !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al actualizar la tarea'
                ];

                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $resultado = $tarea->eliminar();

            if($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'mensaje' => 'Eliminado Correctamente'
                ];
            }
            echo json_encode($respuesta);
        }
    }
}