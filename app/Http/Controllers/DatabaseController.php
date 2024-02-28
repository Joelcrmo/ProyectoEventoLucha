<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function connect()
    {
        // Obtener los datos de conexión desde el archivo .env
        $dbConnection = env('DB_CONNECTION');
        $dbHost = env('DB_HOST');
        $dbPort = env('DB_PORT');
        $dbDatabase = env('DB_DATABASE');
        $dbUsername = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');

        // Configurar la conexión a la base de datos
        config([
            'database.connections.'.$dbConnection => [
                'driver' => $dbConnection,
                'host' => $dbHost,
                'port' => $dbPort,
                'database' => $dbDatabase,
                'username' => $dbUsername,
                'password' => $dbPassword,
            ]
        ]);
    }
}
