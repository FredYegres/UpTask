<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado', 'emailTemp'];

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? null;
        $this->password_actual = $args['password_actual'] ?? null;
        $this->password_nuevo = $args['password_nuevo'] ?? null;
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->emailTemp = $args['emailTemp'] ?? '';
    }

    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email es invalido';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        return self::$alertas;
    }

    public function validarCuentaNueva() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        if($this->password && strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe ser mayor a 6 caracteres';
        }

        if(strlen($this->password) >= 6 && $this->password !== $this->password2) {
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        return self::$alertas;
    }

    public function validarEmail() {

        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email es invalido';
        }

        return self::$alertas;
    }

    public function validarPassword() {

        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        if($this->password && strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe ser mayor a 6 caracteres';
        }

        if(strlen($this->password) >= 6 && $this->password !== $this->password2) {
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        return self::$alertas;
    }

    public function validarPasswordNueva() {
        $resultado = password_verify($this->password_actual, $this->password);

        if(!$resultado) {
            self::$alertas['error'][] = 'Contraseña invalida';
        } else {
            if(!$this->password_nuevo) {
                self::$alertas['error'][] = 'La contraseña es obligatoria';
            }
    
            if($this->password_nuevo && strlen($this->password_nuevo) < 6) {
                self::$alertas['error'][] = 'La contraseña debe ser mayor a 6 caracteres';
            }
    
            if(strlen($this->password_nuevo) >= 6 && $this->password_nuevo !== $this->password2) {
                self::$alertas['error'][] = 'Las contraseñas no coinciden';
            }
        }

        return self::$alertas;
    }

    public function validarPerfil() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email es invalido';
        }

        return self::$alertas;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = md5(uniqid());
    }
}