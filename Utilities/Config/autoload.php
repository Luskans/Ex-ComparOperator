<?php

function chargerClasse($classname)
{
    // require __DIR__ . '/../../Model/Repository/' . $classname . '.php';
    // require __DIR__ . '/../../Model/Entity/' . $classname . '.php';
    if ($classname === 'Manager') {
        // require $_SERVER['DOCUMENT_ROOT'] . '/Ex-ComparOperator/Model/Repository/' . $classname . '.php';
        require $_SERVER['DOCUMENT_ROOT'] . '/Model/Repository/' . $classname . '.php';
    } else {
        // require $_SERVER['DOCUMENT_ROOT'] . '/Ex-ComparOperator/Model/Entity/' . $classname . '.php';
        require $_SERVER['DOCUMENT_ROOT'] . '/Model/Entity/' . $classname . '.php';
    }
}

spl_autoload_register('chargerClasse');