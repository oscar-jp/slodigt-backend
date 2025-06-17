<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController; // 👈 asegurate de importar
use App\Http\Controllers\RechargeController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\SupportChatController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\BusinessController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// 🟢 Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// 🔒 Rutas protegidas por token
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // ✅ Ruta para actualizar perfil
    Route::put('/profile', [UserController::class, 'update']);

    // Recargas y transferencias
    Route::post('/recharges', [RechargeController::class, 'store']);
    Route::post('/transfers', [TransferController::class, 'store']);

    // Gestión de negocios
    Route::get('/businesses', [BusinessController::class, 'index']);
    Route::get('/businesses/{business}', [BusinessController::class, 'show']);
    Route::middleware('role:business')->group(function () {
        Route::post('/businesses', [BusinessController::class, 'store']);
        Route::put('/businesses/{business}', [BusinessController::class, 'update']);

        Route::post('/businesses/{business}/roles', [\App\Http\Controllers\BusinessRoleController::class, 'store']);
        Route::put('/businesses/{business}/roles/{role}', [\App\Http\Controllers\BusinessRoleController::class, 'update']);
        Route::delete('/businesses/{business}/roles/{role}', [\App\Http\Controllers\BusinessRoleController::class, 'destroy']);
    });

    // Soporte y notificaciones
    Route::post('/support/chats', [SupportChatController::class, 'store']);
    Route::post('/support/chats/{chat}/messages', [SupportChatController::class, 'sendMessage']);
    Route::get('/notifications', [NotificationController::class, 'index']);
});

// 🔒 Rutas específicas por rol
Route::middleware(['auth:sanctum', 'role:user'])->get('/client/orders', function () {
    return response()->json(['message' => 'Client orders']);
});

Route::middleware(['auth:sanctum', 'role:business'])->get('/business/dashboard', function () {
    return response()->json(['message' => 'Business dashboard']);
});

Route::middleware(['auth:sanctum', 'role:delivery'])->get('/delivery/tasks', function () {
    return response()->json(['message' => 'Delivery tasks']);
});
