<?php
defined('BASEPATH') or exit('No direct script access allowed');

// EMAILS
// define('EMAIL_CCO', 'miguellhdez@hotmail.com,miguellhdez@gmail.com,mhernandez@athanconsultores.com,luissanchez@athanconsultores.com');

class Emails
{
    private static $configuracion;

    public function __construct(){
        self::$configuracion= array(
            'protocol'    => 'mail',
            'smtp_host'   => 'sub5.mail.dreamhost.com',
            'smtp_port'   => 465,
            'smtp_user'   => 'info@omivende.com',
            'smtp_pass'   => 'Somospaz01.',
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'smtp_crypto' => 'ssl',
            'newline'     => "\r\n",
      );

    }// __construct()


    public static function get_terminosycondiciones(){
        return "
                <tr>
                <td colspan=2 style='padding-top: 40px ; width: 30%; text-align: center; color: #656565;'> Términos y condiciones </td>
                </tr>
                <tr height='35'>
                <td colspan='2' style='padding: 0px 10px;'>
                  <ul>
                    <li>Omivende no acepta depósitos via OXXO, 7-Eleven o cualquier tienda de conveniencia.</li>
                    <li>Omivende no se hace responsable de transacciones realizadas con el propietario o contratante.</li>
                  <ul>
                </td>
                </tr>
        ";
    }// get_terminosycondiciones()

    public static function send($destinatario, $arr_datos, $titulo, $cuerpo, $tycondiciones, $contexto){
      // echo "<pre>"; print_r($arr_datos); die();
        $email = ($destinatario != "")?$destinatario:$arr_datos['Correo electrónico'];

        $texto   = ($cuerpo == "" || $cuerpo == NULL) ? "Soporte Omi vende" : $cuerpo;
        $message = "";
        $message .= "
                <html>
                <body>
                    <table align='center' bgcolor='#e0e0e0' width='100%' border='0' cellpadding='0' cellspacing='0' style='padding: 20px; font-family:Verdana, Geneva, sans-serif;'>
                        <tr>
                            <td>
                                <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width: 650px; background-color: #004dc1; font-family: Verdana, Geneva, sans-serif; border-radius: 5px; border: 1px solid #004dc1; -webkit-box-shadow: 0px 2px 4px #a1a1a1;'>
                                    <thead>
                                        <tr height='80'>
                                        <th colspan='2' style='background-color: #004dc1; border-bottom: solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color: #ffffff; font-size: 30px;'> {$texto} </th>
                                        </tr>
                                    </thead>
                                    <tbody align='justify' style='color #777; background-color: #f8f8f8; font-family: Verdana, Geneva, sans-serif;'>";
                                    foreach ($arr_datos as $key => $value) {
                                        $message .= "<tr height='35'>
                                                          <td style='padding: 0px 10px; width: 30%; text-align: right; color: #656565;'>{$key}: </td>
                                                          <td style='padding: 0px 10px;'> {$value}</td>
                                                    </tr>";
                                    }
        $message .= "
                  <tr height='35'>
                    <td colspan='2' style='padding: 30px 10px; text-align: center;'>
                    <a href=".URL_OMI." style='text-decoration: none; color: #ffffff; padding: 5px 10px; border-radius: 5px; border: 1px solid #004dc1; cursor: pointer; background: #004dc1; -webkit-box-shadow: 0px 2px 4px #a1a1a1;'>Ir a Omi vende</a>
                    </td>
                  </tr>
                  ";
        $message .= ($tycondiciones)? self::get_terminosycondiciones():"";
        $message .="

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>
        ";
        // echo $message; die();
        //cargamos la libreria email de ci
        $contexto->load->library("email");

        //cargamos la configuración para enviar con gmail
        $contexto->email->initialize(self::$configuracion);

        $contexto->email->from('info@omivende.com', 'Soporte Omi vende: '.$titulo);
        $contexto->email->to($email);
        $contexto->email->bcc(EMAIL_CCO);
        $contexto->email->subject($texto);
        $contexto->email->message($message);
        return $contexto->email->send();
    }// send()


    public static function send_email_codigo($contexto, $email, $codigo)
    {
        $email_admin = $contexto->Usuario_model->recupera_mail_admin();
        $texto       = "Solicitud de recuperación de contraseña";
        $link        = URL_OMI."/login/recuperar_contrasena";
        $message = "
      <html>
      <body>
        <table align='center' bgcolor='#e0e0e0' width='100%' border='0' cellpadding='0' cellspacing='0' style='padding: 20px; font-family:Verdana, Geneva, sans-serif;'>
          <tr>
            <td>
            <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width: 650px; background-color: #004dc1; font-family: Verdana, Geneva, sans-serif; border-radius: 5px; border: 1px solid #004dc1; -webkit-box-shadow: 0px 2px 4px #a1a1a1;'>
              <thead>
                <tr height='80'>
                <th colspan='2' style='background-color: #004dc1; border-bottom: solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color: #ffffff; font-size: 30px;'> {$texto} </th>
                </tr>
              </thead>
              <tbody align='justify' style='color #777; background-color: #f8f8f8; font-family: Verdana, Geneva, sans-serif;'>
              <tr height='35'>
                <td style='padding: 0px 10px; width: 30%; text-align: right; color: #656565;'>Correo:</td>
                <td style='padding: 0px 10px;'>{$email}</td>
              </tr>
              <tr height='35'>
                <td style='padding: 0px 10px; width: 30%; text-align: right; color: #656565;'>Código:</td>
                <td style='padding: 0px 10px;'>{$codigo}</td>
              </tr>
              <tr height='35'>
                <td colspan='2' style='padding: 30px 10px; text-align: center;'>
                <a href='{$link}' style='text-decoration: none; color: #ffffff; padding: 5px 10px; border-radius: 5px; border: 1px solid #004dc1; cursor: pointer; background: #004dc1; -webkit-box-shadow: 0px 2px 4px #a1a1a1;'>Ir a Omivende a recuperar mi contraseña</a>
                </td>
              </tr>
              </tbody>
            </table>
            </td>
          </tr>
        </table>
        </body>
                </html>
    ";

        //cargamos la libreria email de ci
        $contexto->load->library("email");
        //configuracion
        $config_mail = Utilerias::$emailconf;
        //cargamos la configuración para enviar con gmail
        $contexto->email->initialize(self::$configuracion);
        $contexto->email->from('info@omivende.com', 'Soporte Omi vende');
        $contexto->email->to($email);
        $contexto->email->cc($email_admin);
        $contexto->email->bcc(EMAIL_CCO);
        $contexto->email->subject($texto);
        $contexto->email->message($message);
        return $contexto->email->send(); // retorna boolean
    } // send_email_codigo()

    public static function send_email_actualizaciondatos($contexto, $arr_datos, $textopersonalizado)
    {
        $email_admin     = $contexto->Usuario_model->recupera_mail_admin();
        $subject         = $textopersonalizado;
        $link            = URL_OMI;
        $email           = $arr_datos["email"];
        $nombre_completo = $arr_datos["nombre"] . " " . $arr_datos["paterno"] . " " . $arr_datos["materno"];
        $usuario         = $arr_datos["username"];
        $contrasena      = $arr_datos["clavev"];
        $tipodecuenta    = $arr_datos["tipocuenta"];
        $message         = "
                <html>
                <body>
                    <table align='center' bgcolor='#e0e0e0' width='100%' border='0' cellpadding='0' cellspacing='0' style='padding: 20px; font-family:Verdana, Geneva, sans-serif;'>
                        <tr>
                            <td>
                                <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width: 650px; background-color: #004dc1; font-family: Verdana, Geneva, sans-serif; border-radius: 5px; border: 1px solid #004dc1; -webkit-box-shadow: 0px 2px 4px #a1a1a1;'>
                                    <thead>
                                        <tr height='80'>
                                        <th colspan='2' style='background-color: #004dc1; border-bottom: solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color: #ffffff; font-size: 30px;'> {$textopersonalizado} </th>
                                        </tr>
                                    </thead>
                                    <tbody align='justify' style='color #777; background-color: #f8f8f8; font-family: Verdana, Geneva, sans-serif;'>
                                        <tr height='35'>
                                            <td style='padding: 0px 10px; width: 30%; text-align: right; color: #656565;'>Tipo de cuenta:</td>
                                            <td style='padding: 0px 10px;'>{$tipodecuenta}</td>
                                        </tr>
                                        <tr height='35'>
                                            <td style='padding: 0px 10px; width: 30%; text-align: right; color: #656565;'>Nombre:</td>
                                            <td style='padding: 0px 10px;'>{$nombre_completo}</td>
                                        </tr>
                                        <tr height='35'>
                                            <td style='padding: 0px 10px; width: 30%; text-align: right; color: #656565;'>Correo:</td>
                                            <td style='padding: 0px 10px;'>{$email}</td>
                                        </tr>
                                        <tr height='35'>
                                            <td style='padding: 0px 10px; width: 30%; text-align: right; color: #656565;'>Usuario:</td>
                                            <td style='padding: 0px 10px;'>{$usuario}</td>
                                        </tr>
                                        <tr height='35'>
                                            <td style='padding: 0px 10px; width: 30%; text-align: right; color: #656565;'>Contrasena actual:</td>
                                            <td style='padding: 0px 10px;'>{$contrasena}</td>
                                        </tr>
                                        <tr height='35'>
                                            <td colspan='2' style='padding: 30px 10px; text-align: center;'>
                                            <a href={$link} style='text-decoration: none; color: #ffffff; padding: 5px 10px; border-radius: 5px; border: 1px solid #004dc1; cursor: pointer; background: #004dc1; -webkit-box-shadow: 0px 2px 4px #a1a1a1;'>Ir a Omi vende</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>
                ";
        //cargamos la libreria email de ci
        $contexto->load->library("email");
        //configuracion
        $config_mail = Utilerias::$emailconf;
        //cargamos la configuración para enviar con gmail
        $contexto->email->initialize($config_mail);
        $contexto->email->from('info@omivende.com', 'Soporte Omi vende');
        $contexto->email->to($email);
        $contexto->email->cc($email_admin);
        $contexto->email->bcc(EMAIL_CCO);
        $contexto->email->subject($subject);
        $contexto->email->message($message);
        return $contexto->email->send(); // retorna boolean
    } // send_email_actualizaciondatos()




    public static function send_email_aviso($contexto, $asunto, $mensaje, $destinatarios)
    {
        $email_admin_arr = $contexto->Usuario_model->recupera_mail_admin();
        $email_admin = $email_admin_arr['email'];
        // $email_admin
        $link        = URL_OMI;
        $message = "
      <html>
      <body>
        <table align='center' bgcolor='#e0e0e0' width='100%' border='0' cellpadding='0' cellspacing='0' style='padding: 20px; font-family:Verdana, Geneva, sans-serif;'>
          <tr>
            <td>
            <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width: 650px; background-color: #004dc1; font-family: Verdana, Geneva, sans-serif; border-radius: 5px; border: 1px solid #004dc1; -webkit-box-shadow: 0px 2px 4px #a1a1a1;'>
              <thead>
                <tr height='80'>
                <th colspan='2' style='background-color: #004dc1; border-bottom: solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color: #ffffff; font-size: 30px;'> {$asunto} </th>
                </tr>
              </thead>
              <tbody align='justify' style='color #777; background-color: #f8f8f8; font-family: Verdana, Geneva, sans-serif;'>
              <tr height='35'>
                <td style='padding: 0px 10px;'>{$mensaje}</td>
              </tr>
              <tr height='35'>
                <td colspan='2' style='padding: 30px 10px; text-align: center;'>
                <a href='{$link}' style='text-decoration: none; color: #ffffff; padding: 5px 10px; border-radius: 5px; border: 1px solid #004dc1; cursor: pointer; background: #004dc1; -webkit-box-shadow: 0px 2px 4px #a1a1a1;'>Ir a Omivende</a>
                </td>
              </tr>
              </tbody>
            </table>
            </td>
          </tr>
        </table>
        </body>
                </html>
    ";

        //cargamos la libreria email de ci
        $contexto->load->library("email");
        //configuracion
        $config_mail = Utilerias::$emailconf;
        //cargamos la configuración para enviar con gmail
        $contexto->email->initialize(self::$configuracion);
        $contexto->email->from('info@omivende.com', 'Soporte Omi vende');
        $contexto->email->to($email_admin);
        // $contexto->email->cc($email_admin);
        // $contexto->email->bcc(EMAIL_CCO);
        $contexto->email->bcc($destinatarios);
        $contexto->email->subject($asunto);
        $contexto->email->message($message);
        return $contexto->email->send(); // retorna boolean
    } // send_email_aviso()


    public static function send_mail_uregistro($email, $datos, $textopersonalizado, $contexto){
        $texto   = ($textopersonalizado == "") ? "Gracias por su registro" : $textopersonalizado;
        $message = "";
        $tycond  = self::get_terminosycondiciones();
        $message .= "
                    <html><body>

                    <table align='center' bgcolor='#e0e0e0' width='100%' border='0' cellpadding='0' cellspacing='0' style='padding: 20px; font-family:Verdana, Geneva, sans-serif;'>
                        <tr>
                            <td>
                                <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width: 650px; background-color: #004dc1; font-family: Verdana, Geneva, sans-serif; border-radius: 5px; border: 1px solid #004dc1; -webkit-box-shadow: 0px 2px 4px #a1a1a1;'>
                                    <thead>
                                        <tr height='80'>
                                        <th colspan='2' style='background-color: #004dc1; border-bottom: solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color: #ffffff; font-size: 30px;'> {$texto} </th>
                                        </tr>
                                    </thead>
                                    <tbody align='justify' style='color #777; background-color: #f8f8f8; font-family: Verdana, Geneva, sans-serif;'>";
        foreach ($datos as $key => $value) {
            $message .= "<tr height='35'>
                                            <td style='padding: 0px 10px; width: 30%; text-align: right; color: #656565;'>{$key}: </td>
                                            <td style='padding: 0px 10px;'> {$value}</td>
                                        </tr>";
        }

        $message .= "
                                    <tr>
                                    <td colspan=2 style='padding-top: 40px ; width: 30%; text-align: center; color: #656565;'> Términos y condiciones </td>
                                    </tr>
                                    <tr height='35'>
                                    <td colspan='2' style='padding: 0px 10px;'> {$tycond} </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </body></html>
        ";
        // echo $message; die();
        //cargamos la libreria email de ci
        $contexto->load->library("email");

        //cargamos la configuración para enviar con gmail
        $contexto->email->initialize(self::$configuracion);

        $contexto->email->from('info@omivende.com', 'Soporte Omivende');
        $contexto->email->to($email);
        $contexto->email->bcc(EMAIL_CCO);
        $contexto->email->subject($texto);
        $contexto->email->message($message);
        $contexto->email->send();
    }


} // class Emails
