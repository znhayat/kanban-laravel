<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Aquí és on Laravel 11 configura tota l’aplicació.
// És com el “punt de partida” on li dic què ha de carregar i com.
return Application::configure(basePath: dirname(__DIR__))

    // Aquí configuro totes les rutes de l’app.
    // Li dic on estan les rutes web, les de consola i fins i tot la ruta de "health".
    ->withRouting(
        web: __DIR__.'/../routes/web.php',          // Les rutes normals del projecte
        commands: __DIR__.'/../routes/console.php', // Les comandes d’artisan personalitzades
        health: '/up',                              // Ruta per comprovar si el servidor està viu
    )

    // Aquí configuro el middleware de l’app.
    // És com dir-li: “vale, quan et demanin això, fes passar la petició per aquí”.
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            // Aquí creo un àlies perquè pugui fer servir "role" a les rutes
            // en comptes de posar tota la classe sencera. Més curt i més mono.
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })

    // Aquí podria configurar com Laravel gestiona les excepcions.
    // No hi poso res perquè de moment no necessito res especial.
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    // I finalment, aquí és on Laravel crea l’aplicació amb tot el que he configurat.
    ->create();
