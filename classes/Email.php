<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'fc5e9543bcd32a';
        $mail->Password = '87ca33a4b3e869';

        $mail->setFrom('cuentas.uptask@gmail.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu Cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . '</strong> Has creado tu cuenta en UpTask, ahora solo debes confirmarla en el siguiente enlace</p>';
        $contenido .= "<p>Presiona aquí: <a href='http:/192.168.100.2:3000/confirmar?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= '<p>Si tu no solicitaste este email puedes ignorarlo';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        $mail->send();
    }

    public function enviarInstrucciones() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'fc5e9543bcd32a';
        $mail->Password = '87ca33a4b3e869';

        $mail->setFrom('cuentas.uptask@gmail.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablecer Contraseña';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . '</strong> Has solicitado cambiar tu contraseña en UpTask, solo debes dar click en el siguiente enlace</p>';
        $contenido .= "<p>Presiona aquí: <a href='http:/192.168.100.2:3000/reestablecer?token=" . $this->token . "'>Reestablecer Contraseña</a></p>";
        $contenido .= '<p>Si tu no solicitaste este email puedes ignorarlo';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        $mail->send();
    }

    public function enviarConfirmacionCambio() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'fc5e9543bcd32a';
        $mail->Password = '87ca33a4b3e869';

        $mail->setFrom('cuentas.uptask@gmail.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Cambio de Email';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . '</strong> Has solicitado cambiar tu email de UpTask, para validar este cambio debes confirmar tu email en el siguiente enlace</p>';
        $contenido .= "<p>Presiona aquí: <a href='http:/192.168.100.2:3000/cambio-correo?token=" . $this->token . "'>Cambiar Email</a></p>";
        $contenido .= '<p>Si tu no solicitaste este cambio puedes ignorar este email.';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        $mail->send();
    }
}