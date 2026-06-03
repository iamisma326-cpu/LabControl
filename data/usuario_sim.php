<?php
// Capa de datos "fake" para el usuario que está logueado.
// Funciona igual que practicantes_sim.php: vive en la sesión del navegador
// y trae un usuario demo precargado (alumno, docente o jefe de soporte)
// para que las páginas del panel puedan leer su nombre, iniciales, etc.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ─── Usuarios demo precargados ─── */

function sim_usuarios_demo()
{
    return [
        'alumno' => [
            'rol'       => 'Alumno',
            'nombres'   => 'Alejandro',
            'apellidos' => 'Martínez Quispe',
            'dni'       => '71234567',
            'correo'    => 'alejandro.martinez@istpargentina.edu.pe',
            'telefono'  => '987 654 321',
        ],
        'docente' => [
            'rol'       => 'Docente',
            'nombres'   => 'Diana Carolina',
            'apellidos' => 'Vargas Llanos',
            'dni'       => '987321654',
            'correo'    => 'diana.vargas@istpargentina.edu.pe',
            'telefono'  => '987 654 321',
        ],
        'jefe_soporte' => [
            'rol'       => 'Jefe de Soporte',
            'nombres'   => 'Administrador',
            'apellidos' => '',
            'dni'       => '',
            'correo'    => '',
            'telefono'  => '',
        ],
    ];
}

// Junta nombre y apellido en un solo texto (ej. "Alejandro Martínez").
// Si hay varios nombres o varios apellidos, se queda con el primero de cada uno.
function sim_nombre_completo($u)
{
    $partes = explode(' ', trim($u['nombres']));
    $apell  = explode(' ', trim($u['apellidos']));

    if (isset($partes[0])) {
        $primero = $partes[0];
    } else {
        $primero = '';
    }

    if (isset($apell[0])) {
        $apell1 = $apell[0];
    } else {
        $apell1 = '';
    }

    return trim($primero . ' ' . $apell1);
}

// Saca las iniciales a partir del nombre y el apellido
// (ej. "Alejandro Martínez" → "AM").
function sim_iniciales($u)
{
    $apell   = trim($u['apellidos']);
    $nombres = explode(' ', trim($u['nombres']));

    if (isset($nombres[0])) {
        $primer_nombre = $nombres[0];
    } else {
        $primer_nombre = '';
    }

    $ini = strtoupper(substr($primer_nombre, 0, 1));

    if ($apell != '') {
        $apellidos = explode(' ', $apell);
        $ini = $ini . strtoupper(substr($apellidos[0], 0, 1));
    } else {
        $ini = $ini . strtoupper(substr($primer_nombre, 1, 1));
    }

    return $ini;
}

/* ─── Inicio y lectura de sesión ─── */

// Carga al usuario demo del rol que le pidas. Si ya hay una sesión
// abierta para ese mismo rol, no la toca.
function sim_iniciar_sesion($rol)
{
    if (isset($_SESSION['sim']['usuario']['rol_key'])
        && $_SESSION['sim']['usuario']['rol_key'] === $rol) {
        return;
    }

    $demo = sim_usuarios_demo();
    if (!isset($demo[$rol])) {
        // Rol desconocido: no hacemos nada.
        return;
    }

    $u = $demo[$rol];
    $_SESSION['sim']['usuario'] = [
        'rol_key'   => $rol,
        'rol'       => $u['rol'],
        'nombres'   => $u['nombres'],
        'apellidos' => $u['apellidos'],
        'nombre'    => sim_nombre_completo($u),
        'iniciales' => sim_iniciales($u),
        'dni'       => $u['dni'],
        'correo'    => $u['correo'],
        'telefono'  => $u['telefono'],
    ];
}

// Devuelve los datos del usuario que está logueado en este momento.
function sim_usuario_actual()
{
    if (isset($_SESSION['sim']['usuario'])) {
        return $_SESSION['sim']['usuario'];
    } else {
        return [];
    }
}
