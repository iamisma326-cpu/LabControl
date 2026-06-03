<?php
// Capa de datos "fake" para los practicantes y sus asistencias.
// Todo vive en la sesión del navegador (no hay base de datos todavía).
// Apenas entras por primera vez, te siembra un par de practicantes y
// un par de asistencias de muestra para que las páginas no estén vacías.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['sim']) || !is_array($_SESSION['sim'])) {
    $_SESSION['sim'] = [];
}

// Practicantes de muestra (solo la primera vez).
if (!isset($_SESSION['sim']['practicantes'])) {
    $_SESSION['sim']['practicantes'] = [
        ['id' => 1, 'codigo' => 'P001', 'nombres' => 'Juan Carlos', 'apellidos' => 'Pérez Gómez',     'dni' => '71234567', 'horario_entrada' => '08:00:00', 'horario_salida' => '17:00:00', 'tam_emb' => 128, 'activo' => 1],
        ['id' => 2, 'codigo' => 'P002', 'nombres' => 'Ana María',   'apellidos' => 'López Sánchez',   'dni' => '76543218', 'horario_entrada' => '09:00:00', 'horario_salida' => '18:00:00', 'tam_emb' => 0,   'activo' => 1],
        ['id' => 3, 'codigo' => 'P003', 'nombres' => 'Pedro',       'apellidos' => 'García Martínez', 'dni' => '78901234', 'horario_entrada' => '08:30:00', 'horario_salida' => '17:30:00', 'tam_emb' => 128, 'activo' => 1],
    ];
}

// Asistencias de muestra (solo la primera vez).
if (!isset($_SESSION['sim']['asistencias'])) {
    $_SESSION['sim']['asistencias'] = [
        ['id' => 1, 'practicante_id' => 1, 'fecha' => date('Y-m-d'),                       'hora_entrada' => '08:15:00', 'hora_salida' => null,       'estado' => 'presente'],
        ['id' => 2, 'practicante_id' => 2, 'fecha' => date('Y-m-d'),                       'hora_entrada' => '09:05:00', 'hora_salida' => '13:00:00', 'estado' => 'completa'],
        ['id' => 3, 'practicante_id' => 3, 'fecha' => date('Y-m-d', strtotime('-1 day')), 'hora_entrada' => '08:30:00', 'hora_salida' => '17:30:00', 'estado' => 'completa'],
    ];
}

if (!isset($_SESSION['sim']['next_practicante_id'])) {
    $_SESSION['sim']['next_practicante_id'] = 4;
}
if (!isset($_SESSION['sim']['next_asistencia_id'])) {
    $_SESSION['sim']['next_asistencia_id'] = 4;
}

// ─── Para leer datos ───

function sim_practicantes()
{
    return $_SESSION['sim']['practicantes'];
}

function sim_asistencias()
{
    return $_SESSION['sim']['asistencias'];
}

// Busca un practicante por id. Si no está, devuelve null.
function sim_practicante($id)
{
    foreach ($_SESSION['sim']['practicantes'] as $p) {
        if ((int)$p['id'] == $id) {
            return $p;
        }
    }
    return null;
}

// ─── Para guardar datos ───
// Estas funciones devuelven un array:
//   éxito  -> ['ok' => true,  'practicante' => [...] ]
//   error  -> ['ok' => false, 'error' => 'mensaje' ]

// Crea un practicante nuevo. Revisa que no falten datos y que el DNI
// o el código no estén repetidos.
function sim_crear_practicante($d)
{
    $requeridos = ['codigo', 'nombres', 'apellidos', 'dni'];
    foreach ($requeridos as $campo) {
        if (!isset($d[$campo]) || trim($d[$campo]) == '') {
            return ['ok' => false, 'error' => "El campo '$campo' es obligatorio."];
        }
    }

    foreach ($_SESSION['sim']['practicantes'] as $p) {
        if ($p['dni'] == $d['dni']) {
            return ['ok' => false, 'error' => 'El DNI ya está registrado.'];
        }
        if ($p['codigo'] == $d['codigo']) {
            return ['ok' => false, 'error' => 'El código ya está registrado.'];
        }
    }

    // Horarios con valor por defecto si vienen vacíos.
    if (trim($d['horario_entrada']) != '') {
        $entrada = $d['horario_entrada'];
    } else {
        $entrada = '08:00:00';
    }
    if (trim($d['horario_salida']) != '') {
        $salida = $d['horario_salida'];
    } else {
        $salida = '17:00:00';
    }

    $nuevo = [
        'id'              => $_SESSION['sim']['next_practicante_id'],
        'codigo'          => trim($d['codigo']),
        'nombres'         => trim($d['nombres']),
        'apellidos'       => trim($d['apellidos']),
        'dni'             => trim($d['dni']),
        'horario_entrada' => $entrada,
        'horario_salida'  => $salida,
        'tam_emb'         => 0,
        'activo'          => 1,
    ];
    $_SESSION['sim']['next_practicante_id'] = $_SESSION['sim']['next_practicante_id'] + 1;

    $_SESSION['sim']['practicantes'][] = $nuevo;
    return ['ok' => true, 'practicante' => $nuevo];
}

// Edita un practicante que ya existe. No toca el id, ni si está
// activo, ni el tamaño del embedding facial.
function sim_actualizar_practicante($id, $d)
{
    $requeridos = ['codigo', 'nombres', 'apellidos', 'dni'];
    foreach ($requeridos as $campo) {
        if (!isset($d[$campo]) || trim($d[$campo]) == '') {
            return ['ok' => false, 'error' => "El campo '$campo' es obligatorio."];
        }
    }

    $idx = null;
    foreach ($_SESSION['sim']['practicantes'] as $i => $p) {
        if ((int)$p['id'] == $id) {
            $idx = $i;
            break;
        }
    }
    if ($idx === null) {
        return ['ok' => false, 'error' => 'Practicante no encontrado.'];
    }

    $codigoNuevo = trim($d['codigo']);
    $dniNuevo    = trim($d['dni']);
    foreach ($_SESSION['sim']['practicantes'] as $p) {
        if ((int)$p['id'] == $id) {
            continue;
        }
        if ($p['dni'] == $dniNuevo) {
            return ['ok' => false, 'error' => 'El DNI ya está registrado por otro practicante.'];
        }
        if ($p['codigo'] == $codigoNuevo) {
            return ['ok' => false, 'error' => 'El código ya está registrado por otro practicante.'];
        }
    }

    if (trim($d['horario_entrada']) != '') {
        $entrada = $d['horario_entrada'];
    } else {
        $entrada = '08:00:00';
    }
    if (trim($d['horario_salida']) != '') {
        $salida = $d['horario_salida'];
    } else {
        $salida = '17:00:00';
    }

    $_SESSION['sim']['practicantes'][$idx]['codigo']          = $codigoNuevo;
    $_SESSION['sim']['practicantes'][$idx]['nombres']         = trim($d['nombres']);
    $_SESSION['sim']['practicantes'][$idx]['apellidos']       = trim($d['apellidos']);
    $_SESSION['sim']['practicantes'][$idx]['dni']             = $dniNuevo;
    $_SESSION['sim']['practicantes'][$idx]['horario_entrada'] = $entrada;
    $_SESSION['sim']['practicantes'][$idx]['horario_salida']  = $salida;

    return ['ok' => true, 'practicante' => $_SESSION['sim']['practicantes'][$idx]];
}

// Activa o desactiva al practicante (1 = activo, 0 = desactivado).
// Devuelve true si lo encontró, false si no.
function sim_toggle_practicante($id, $activo)
{
    foreach ($_SESSION['sim']['practicantes'] as $i => $p) {
        if ((int)$p['id'] == $id) {
            if ($activo == 1) {
                $nuevo = 1;
            } else {
                $nuevo = 0;
            }
            $_SESSION['sim']['practicantes'][$i]['activo'] = $nuevo;
            return true;
        }
    }
    return false;
}

// Marca la asistencia de hoy para un practicante.
// Si ya marcó entrada y no ha salido, le registra la salida (completa).
// Si no, le abre una nueva entrada (presente).
// Devuelve ['ok' => false, 'error' => ...] si el practicante no existe,
// o ['ok' => true, 'accion' => 'entrada'|'salida', 'hora' => ..., 'practicante' => ...].
function sim_marcar_asistencia($practicante_id)
{
    $practicante = sim_practicante($practicante_id);
    if (!$practicante) {
        return ['ok' => false, 'error' => 'Practicante no encontrado.'];
    }

    $hoy  = date('Y-m-d');
    $hora = date('H:i:s');

    // Busca un registro de hoy sin cerrar.
    foreach ($_SESSION['sim']['asistencias'] as $i => $a) {
        if ((int)$a['practicante_id'] == $practicante_id
            && $a['fecha'] == $hoy
            && empty($a['hora_salida'])) {
            $_SESSION['sim']['asistencias'][$i]['hora_salida'] = $hora;
            $_SESSION['sim']['asistencias'][$i]['estado']      = 'completa';
            return ['ok' => true, 'accion' => 'salida', 'hora' => $hora, 'practicante' => $practicante];
        }
    }

    // No había registro abierto: crea una entrada.
    $_SESSION['sim']['asistencias'][] = [
        'id'             => $_SESSION['sim']['next_asistencia_id'],
        'practicante_id' => $practicante_id,
        'fecha'          => $hoy,
        'hora_entrada'   => $hora,
        'hora_salida'    => null,
        'estado'         => 'presente',
    ];
    $_SESSION['sim']['next_asistencia_id'] = $_SESSION['sim']['next_asistencia_id'] + 1;

    return ['ok' => true, 'accion' => 'entrada', 'hora' => $hora, 'practicante' => $practicante];
}
