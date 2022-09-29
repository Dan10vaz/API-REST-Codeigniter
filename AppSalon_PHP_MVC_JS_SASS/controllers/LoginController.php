<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $router->render('auth/login');
    }

    public static function logout()
    {
        echo "Desde logout";
    }

    public static function olvide(Router $router)
    {
        $router->render('auth/olvide-password', []);
    }

    public static function recuperar()
    {
        echo "Desde recuperar";
    }

    public static function crear(Router $router)
    {

        $usuario = new Usuario($_POST);

        //Alertas de errores vacias 
        $alertas = [];
        //preguntamos si hay una solicitud al servidor de tipo POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario->sincronizar($_POST);
            //VALIDAMOS EL USUARIO Y LO GUARDAMOS EN ALERTAS PARA PASARLO A LA VISTA
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que alertas este vacio para ver si paso la validacion
            if (empty($alertas)) {
                //verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    //Si no esta registrado lo registramos
                    //hashear el password
                    $usuario->hashPassword();

                    //generar un token unico
                    $usuario->crearToken();

                    //Enviamos email con token para confirmar cuenta
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion();

                    debuguear($usuario);
                }
            }
        }

        $router->render('auth/crear-cuenta', ['usuario' => $usuario, 'alertas' => $alertas]);
    }
}
