<?php
// Capa de datos "fake" para los equipos de los laboratorios.
// Todo vive en la sesión del navegador (no hay base de datos todavía).
// Cada equipo se ve así:
//   id, codigo, nombre, laboratorio (lab1/lab2/lab5), estado (operativo/mantenimiento/danado), activo (0/1)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['sim']) || !is_array($_SESSION['sim'])) {
    $_SESSION['sim'] = [];
}

// Valores iniciales (solo se crean la primera vez).
if (!isset($_SESSION['sim']['equipos'])) {
    $_SESSION['sim']['equipos'] = [];
}
if (!isset($_SESSION['sim']['next_equipo_id'])) {
    $_SESSION['sim']['next_equipo_id'] = 1;
}

// ─── Para leer datos ───

function sim_equipos()
{
    if (isset($_SESSION['sim']['equipos'])) {
        return $_SESSION['sim']['equipos'];
    } else {
        return [];
    }
}

// Busca un equipo por id. Si no está, devuelve null.
function sim_equipo($id)
{
    foreach ($_SESSION['sim']['equipos'] as $e) {
        if ((int)$e['id'] == $id) {
            return $e;
        }
    }
    return null;
}

// Cuenta cuántos equipos hay en cada estado (operativo, mantenimiento, danado)
// y el total. Sirve para los cuadritos de resumen del dashboard.
function sim_contar_por_estado()
{
    $conteo = ['total' => 0, 'operativo' => 0, 'mantenimiento' => 0, 'danado' => 0];
    foreach ($_SESSION['sim']['equipos'] as $e) {
        $conteo['total'] = $conteo['total'] + 1;
        if (isset($e['estado'])) {
            $est = $e['estado'];
        } else {
            $est = '';
        }
        if (isset($conteo[$est])) {
            $conteo[$est] = $conteo[$est] + 1;
        }
    }
    return $conteo;
}

// ─── Para guardar datos ───
// Estas funciones devuelven un array:
//   éxito  -> ['ok' => true,  'equipo' => [...] ]
//   error  -> ['ok' => false, 'error' => 'mensaje' ]

function sim_crear_equipo($d)
{
    $requeridos = ['codigo', 'nombre', 'laboratorio', 'estado'];
    foreach ($requeridos as $campo) {
        if (!isset($d[$campo]) || trim($d[$campo]) == '') {
            return ['ok' => false, 'error' => "El campo '$campo' es obligatorio."];
        }
    }

    $codigo = trim($d['codigo']);
    foreach ($_SESSION['sim']['equipos'] as $e) {
        if ($e['codigo'] == $codigo) {
            return ['ok' => false, 'error' => 'El código ya está registrado.'];
        }
    }

    if (!in_array($d['estado'], ['operativo', 'mantenimiento', 'danado'])) {
        return ['ok' => false, 'error' => 'Estado no válido.'];
    }
    if (!in_array($d['laboratorio'], ['lab1', 'lab2', 'lab5'])) {
        return ['ok' => false, 'error' => 'Laboratorio no válido.'];
    }

    $nuevo = [
        'id'          => $_SESSION['sim']['next_equipo_id'],
        'codigo'      => $codigo,
        'nombre'      => trim($d['nombre']),
        'laboratorio' => $d['laboratorio'],
        'estado'      => $d['estado'],
        'activo'      => 1,
    ];
    $_SESSION['sim']['next_equipo_id'] = $_SESSION['sim']['next_equipo_id'] + 1;

    $_SESSION['sim']['equipos'][] = $nuevo;
    return ['ok' => true, 'equipo' => $nuevo];
}

function sim_actualizar_equipo($id, $d)
{
    $requeridos = ['codigo', 'nombre', 'laboratorio', 'estado'];
    foreach ($requeridos as $campo) {
        if (!isset($d[$campo]) || trim($d[$campo]) == '') {
            return ['ok' => false, 'error' => "El campo '$campo' es obligatorio."];
        }
    }

    $idx = null;
    foreach ($_SESSION['sim']['equipos'] as $i => $e) {
        if ((int)$e['id'] == $id) {
            $idx = $i;
            break;
        }
    }
    if ($idx === null) {
        return ['ok' => false, 'error' => 'Equipo no encontrado.'];
    }

    $codigo = trim($d['codigo']);
    foreach ($_SESSION['sim']['equipos'] as $e) {
        if ((int)$e['id'] == $id) {
            continue;
        }
        if ($e['codigo'] == $codigo) {
            return ['ok' => false, 'error' => 'El código ya está registrado por otro equipo.'];
        }
    }

    if (!in_array($d['estado'], ['operativo', 'mantenimiento', 'danado'])) {
        return ['ok' => false, 'error' => 'Estado no válido.'];
    }
    if (!in_array($d['laboratorio'], ['lab1', 'lab2', 'lab5'])) {
        return ['ok' => false, 'error' => 'Laboratorio no válido.'];
    }

    $_SESSION['sim']['equipos'][$idx]['codigo']      = $codigo;
    $_SESSION['sim']['equipos'][$idx]['nombre']      = trim($d['nombre']);
    $_SESSION['sim']['equipos'][$idx]['laboratorio'] = $d['laboratorio'];
    $_SESSION['sim']['equipos'][$idx]['estado']      = $d['estado'];

    return ['ok' => true, 'equipo' => $_SESSION['sim']['equipos'][$idx]];
}

// Activa o desactiva el equipo (1 = activo, 0 = desactivado).
// Devuelve true si lo encontró, false si no.
function sim_toggle_equipo($id, $activo)
{
    foreach ($_SESSION['sim']['equipos'] as $i => $e) {
        if ((int)$e['id'] == $id) {
            if ($activo == 1) {
                $nuevo = 1;
            } else {
                $nuevo = 0;
            }
            $_SESSION['sim']['equipos'][$i]['activo'] = $nuevo;
            return true;
        }
    }
    return false;
}
