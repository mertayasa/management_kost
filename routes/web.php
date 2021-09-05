<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPembayaranController;
use App\Http\Controllers\JenisPengeluaranController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\TinyUploadController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::post('tiny-image-upload', [TinyUploadController::class, 'uploadImage']);
    Route::post('filepond-image-upload', [FilePondUploadController::class, 'uploadImage']);

    Route::get('/datatable', function () {
        return view('example.datatable');
    });
    
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::group(['prefix' => 'kost', 'as' => 'kost.'], function () {
        Route::get('/', [KostController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:admin'], function () {
            Route::get('create', [KostController::class, 'create'])->name('create');
            Route::post('store', [KostController::class, 'store'])->name('store');
            Route::get('edit/{kost}', [KostController::class, 'edit'])->name('edit');
            Route::patch('update/{kost}', [KostController::class, 'update'])->name('update');
            Route::delete('destroy/{kost}', [KostController::class, 'destroy'])->name('destroy');
        });
        
        Route::get('datatable', [KostController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'kamar', 'as' => 'kamar.'], function () {
        Route::get('/', [KamarController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:admin'], function () {
            Route::get('create', [KamarController::class, 'create'])->name('create');
            Route::post('store', [KamarController::class, 'store'])->name('store');
            Route::get('edit/{kamar}', [KamarController::class, 'edit'])->name('edit');
            Route::patch('update/{kamar}', [KamarController::class, 'update'])->name('update');
            Route::delete('destroy/{kamar}', [KamarController::class, 'destroy'])->name('destroy');
        });

        Route::get('datatable', [KamarController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'jenis_pembayaran', 'as' => 'jenis_pembayaran.'], function () {
        Route::get('/', [JenisPembayaranController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:admin'], function () {
            Route::get('create', [JenisPembayaranController::class, 'create'])->name('create');
            Route::post('store', [JenisPembayaranController::class, 'store'])->name('store');
            Route::get('edit/{jenis_pembayaran}', [JenisPembayaranController::class, 'edit'])->name('edit');
            Route::patch('update/{jenis_pembayaran}', [JenisPembayaranController::class, 'update'])->name('update');
            Route::delete('destroy/{jenis_pembayaran}', [JenisPembayaranController::class, 'destroy'])->name('destroy');
        });

        Route::get('datatable', [JenisPembayaranController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'jenis_pengeluaran', 'as' => 'jenis_pengeluaran.'], function () {
        Route::get('/', [JenisPengeluaranController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:admin'], function () {
            Route::get('create', [JenisPengeluaranController::class, 'create'])->name('create');
            Route::post('store', [JenisPengeluaranController::class, 'store'])->name('store');
            Route::get('edit/{jenis_pengeluaran}', [JenisPengeluaranController::class, 'edit'])->name('edit');
            Route::patch('update/{jenis_pengeluaran}', [JenisPengeluaranController::class, 'update'])->name('update');
            Route::delete('destroy/{jenis_pengeluaran}', [JenisPengeluaranController::class, 'destroy'])->name('destroy');
        });

        Route::get('datatable', [JenisPengeluaranController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'penyewa', 'as' => 'penyewa.'], function () {
        Route::get('/', [PenyewaController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:admin'], function () {
            Route::get('create', [PenyewaController::class, 'create'])->name('create');
            Route::post('store', [PenyewaController::class, 'store'])->name('store');
            Route::get('edit/{penyewa}', [PenyewaController::class, 'edit'])->name('edit');
            Route::patch('update/{penyewa}', [PenyewaController::class, 'update'])->name('update');
            Route::delete('destroy/{penyewa}', [PenyewaController::class, 'destroy'])->name('destroy');
        });

        Route::get('datatable', [PenyewaController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'sewa', 'as' => 'sewa.'], function () {
        Route::get('/', [SewaController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:admin'], function () {
            Route::get('create', [SewaController::class, 'create'])->name('create');
            Route::post('store', [SewaController::class, 'store'])->name('store');
            Route::get('edit/{sewa}', [SewaController::class, 'edit'])->name('edit');
            Route::patch('update/{sewa}', [SewaController::class, 'update'])->name('update');
            Route::delete('destroy/{sewa}', [SewaController::class, 'destroy'])->name('destroy');
        });

        Route::get('datatable', [PenyewaController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'pembayaran', 'as' => 'pembayaran.'], function () {
        Route::get('/', [PembayaranController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:admin'], function () {
            Route::get('create', [PembayaranController::class, 'create'])->name('create');
            Route::post('store', [PembayaranController::class, 'store'])->name('store');
            Route::get('edit/{pembayaran}', [PembayaranController::class, 'edit'])->name('edit');
            Route::patch('update/{pembayaran}', [PembayaranController::class, 'update'])->name('update');
            Route::delete('destroy/{pembayaran}', [PembayaranController::class, 'destroy'])->name('destroy');
        });

        Route::get('datatable', [PembayaranController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'pengeluaran', 'as' => 'pengeluaran.'], function () {
        Route::get('/', [PengeluaranController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:admin'], function () {
            Route::get('create', [PengeluaranController::class, 'create'])->name('create');
            Route::post('store', [PengeluaranController::class, 'store'])->name('store');
            Route::get('edit/{pengeluaran}', [PengeluaranController::class, 'edit'])->name('edit');
            Route::patch('update/{pengeluaran}', [PengeluaranController::class, 'update'])->name('update');
            Route::delete('destroy/{pengeluaran}', [PengeluaranController::class, 'destroy'])->name('destroy');
        });

        Route::get('datatable', [PengeluaranController::class, 'datatable'])->name('datatable');
    });

});


Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

