<?php

namespace Controllers;

use Classes\Email;
use Model\Proyecto;
use Model\Usuario;
use MVC\Router;

class DashboardController {
    public static function index(Router $router) {
        isAuth();

        $proyectos = Proyecto::belongsTo('propietarioID', $_SESSION['id']);

        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos
        ]);
    }

    public static function crear_proyecto(Router $router) {
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);

            $alertas = $proyecto->validarProyecto();

            if(empty($alertas)) {
                $proyecto->url = md5(uniqid());
                $proyecto->propietarioID = $_SESSION['id'];

                $resultado = $proyecto->guardar();

                if($resultado) {
                    header('Location: /proyecto?url=' . $proyecto->url);
                }
            }
        }

        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas
        ]);
    }

    public static function proyecto(Router $router) {
        isAuth();

        $url = $_GET['url'];
        if(!$url) header('Location: /dashboard');

        $proyecto = Proyecto::where('url', $url);

        if($proyecto->propietarioID !== $_SESSION['id']) {
            header('Location: /dashboard');
        }

        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->proyecto
        ]);
    }

    public static function perfil(Router $router) {
        isAuth();
        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPerfil();

            if(empty($alertas)) {
                
                $existeUsuario = Usuario::where('email', $usuario->email);
                $usuarioDB = Usuario::where('id', $usuario->id);

                if($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    Usuario::setAlerta('error', 'Este email ya se encuentra en uso');

                } else {

                    if($usuarioDB->email !== $usuario->email) {
                        $usuario->crearToken();
                        $usuario->emailTemp = $usuario->email;
                        $usuario->email = $usuarioDB->email;
                        
                        $resultado = $usuario->guardar();
    
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarConfirmacionCambio();

                        if($resultado) {
                            Usuario::setAlerta('exito', 'Hemos enviado instrucciones a tu email para realizar el cambio');
    
                        }
                    } else {
                        $_SESSION['nombre'] = $usuario->nombre;

                        $usuario->guardar();

                        Usuario::setAlerta('exito', 'Guardado Correctamente');
                    }
                }
                $alertas = $usuario->getAlertas();
            }
        }

        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function cambiar_correo(Router $router) {
        $alertas = [];
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no valido');

        } else {
            $usuario->email = $usuario->emailTemp;
            $usuario->emailTemp = null;
            $usuario->token = null;
            unset($usuario->password2);

            $_SESSION['email'] = $usuario->email;
            
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Email Actualizado Correctamente');
        }

        $alertas = Usuario::getAlertas();

        $router->render('dashboard/cambio-correo', [
            'titulo' => 'Email Actualizado Correctamente',
            'alertas' => $alertas
        ]);
       
    }

    public static function cambiar_password(Router $router) {
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::find($_SESSION['id']);
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarPasswordNueva();
            
            if(empty($alertas)) {
                $usuario->password = $usuario->password_nuevo;
                unset($usuario->password_actual);
                unset($usuario->password_nuevo);
                unset($usuario->password2);

                $usuario->hashPassword();

                $resultado = $usuario->guardar();

                if($resultado) {
                    Usuario::setAlerta('exito', 'Contraseña Guardada Correctamente');
                }
            }
            $alertas = $usuario->getAlertas();
            
        }
        $router->render('dashboard/cambiar-password', [
            'titulo' => 'Cambiar Contraseña',
            'alertas' => $alertas
        ]);
    }
}