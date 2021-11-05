<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPemasukanController;
use App\Http\Controllers\JenisPengeluaranController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\TinyUploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidasiController;
use Carbon\Carbon;
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
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::post('generate-in-out-chart/{req_profit?}', [DashboardController::class, 'getInOutChart'])->name('chart_in_out');
        Route::post('chart_yearly', [DashboardController::class, 'getChartYearly'])->name('chart_yearly');
        Route::get('get-kamar-kosong-chart', [DashboardController::class, 'getKamarChart'])->name('empty_room');
    });

    Route::group(['prefix' => 'kost', 'as' => 'kost.'], function () {
        Route::get('/', [KostController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:owner'], function () {
            Route::get('create', [KostController::class, 'create'])->name('create');
            Route::post('store', [KostController::class, 'store'])->name('store');
            Route::get('edit/{kost}', [KostController::class, 'edit'])->name('edit');
            Route::patch('update/{kost}', [KostController::class, 'update'])->name('update');
            Route::delete('destroy/{kost}', [KostController::class, 'destroy'])->name('destroy');
        });
        
        Route::get('kamar/{kost}', [KostController::class, 'getKamar'])->name('kamar');
        Route::get('show/{kost}', [KostController::class, 'show'])->name('show');
        Route::get('datatable', [KostController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'kamar', 'as' => 'kamar.'], function () {
        Route::get('/', [KamarController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:owner,manager'], function () {
            Route::get('create/{kost}', [KamarController::class, 'create'])->name('create');
            Route::post('store/{kost}', [KamarController::class, 'store'])->name('store');
            Route::get('edit/{kamar}', [KamarController::class, 'edit'])->name('edit');
            Route::patch('update/{kamar}', [KamarController::class, 'update'])->name('update');
            Route::delete('destroy/{kamar}', [KamarController::class, 'destroy'])->name('destroy');
        });

        Route::get('datatable/{kost_id?}', [KamarController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'jenis-pemasukan', 'as' => 'jenis_pemasukan.'], function () {
        Route::get('/', [JenisPemasukanController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:manager'], function () {
            Route::get('create', [JenisPemasukanController::class, 'create'])->name('create');
            Route::post('store', [JenisPemasukanController::class, 'store'])->name('store');
            Route::get('edit/{jenis_pemasukan}', [JenisPemasukanController::class, 'edit'])->name('edit');
            Route::patch('update/{jenis_pemasukan}', [JenisPemasukanController::class, 'update'])->name('update');
            Route::delete('destroy/{jenis_pemasukan}', [JenisPemasukanController::class, 'destroy'])->name('destroy');
        });

        Route::get('datatable', [JenisPemasukanController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'jenis-pengeluaran', 'as' => 'jenis_pengeluaran.'], function () {
        Route::get('/', [JenisPengeluaranController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:owner,manager'], function () {
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
        Route::get('get-nama-kamar/{penyewa}', [PenyewaController::class, 'getNamaKamar'])->name('get_nama_kamar');
        Route::get('get-sewa/{penyewa}', [PenyewaController::class, 'getSewa'])->name('get_sewa');
        Route::get('create', [PenyewaController::class, 'create'])->name('create');
        Route::get('show/{penyewa}', [PenyewaController::class, 'show'])->name('show');
        Route::post('store', [PenyewaController::class, 'store'])->name('store');
        Route::get('edit/{penyewa}', [PenyewaController::class, 'edit'])->name('edit');
        Route::patch('update/{penyewa}', [PenyewaController::class, 'update'])->name('update');
        Route::delete('destroy/{penyewa}', [PenyewaController::class, 'destroy'])->name('destroy');

        // Route::group(['middleware' => 'role:owner,manager'], function () {
        // });

        Route::get('datatable/{status?}', [PenyewaController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('edit/profile/{user}', [UserController::class, 'edit'])->name('edit.profile');
        Route::patch('update/profile/{user}', [UserController::class, 'update'])->name('update.profile');
        
        Route::group(['middleware' => 'role:owner'], function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('store', [UserController::class, 'store'])->name('store');
            Route::get('edit/{user}', [UserController::class, 'edit'])->name('edit');
            Route::patch('update/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('destroy/{user}', [UserController::class, 'destroy'])->name('destroy');
            Route::get('datatable', [UserController::class, 'datatable'])->name('datatable');
        });

    });

    Route::group(['prefix' => 'sewa', 'as' => 'sewa.'], function () {
        Route::get('/', [SewaController::class, 'index'])->name('index');

        // Route::group(['middleware' => 'role:owner'], function () {
            Route::get('create/{penyewa?}', [SewaController::class, 'create'])->name('create');
            Route::get('get-nama-sewa/{penyewa}', [SewaController::class, 'getSewaByPenyewa'])->name('get_nama_penyewa');
            Route::post('store', [SewaController::class, 'store'])->name('store');
            Route::get('edit/{sewa}', [SewaController::class, 'edit'])->name('edit');
            Route::get('keluar/{sewa}', [SewaController::class, 'edit'])->name('keluar');
            Route::patch('update/{sewa}', [SewaController::class, 'update'])->name('update');
            Route::patch('keluar/update/{sewa}', [SewaController::class, 'update'])->name('keluar.update');
            Route::delete('destroy/{sewa}', [SewaController::class, 'destroy'])->name('destroy');
        // });

        Route::get('datatable/{status?}', [SewaController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'pemasukan', 'as' => 'pemasukan.'], function () {
        Route::get('/', [PemasukanController::class, 'index'])->name('index');

        Route::group(['middleware' => 'role:manager,pegawai'], function () {
            Route::get('create', [PemasukanController::class, 'create'])->name('create');
            Route::post('store', [PemasukanController::class, 'store'])->name('store');
            Route::get('edit/{pemasukan}', [PemasukanController::class, 'edit'])->name('edit');
            Route::patch('update/{pemasukan}', [PemasukanController::class, 'update'])->name('update');
        });

        Route::group(['middleware' => 'role:manager,pegawai'], function () {
            Route::delete('destroy/{pemasukan}', [PemasukanController::class, 'destroy'])->name('destroy');
        });

        Route::get('datatable/{status?}', [PemasukanController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'pengeluaran', 'as' => 'pengeluaran.'], function () {
        Route::get('/', [PengeluaranController::class, 'index'])->name('index');

        // Route::group(['middleware' => 'role:owner'], function () {
            Route::get('create', [PengeluaranController::class, 'create'])->name('create');
            Route::post('store', [PengeluaranController::class, 'store'])->name('store');
            Route::get('edit/{pengeluaran}', [PengeluaranController::class, 'edit'])->name('edit');
            Route::patch('update/{pengeluaran}', [PengeluaranController::class, 'update'])->name('update');
            Route::delete('destroy/{pengeluaran}', [PengeluaranController::class, 'destroy'])->name('destroy');
        // });

        Route::get('datatable/{status?}', [PengeluaranController::class, 'datatable'])->name('datatable');
    });

    Route::group(['prefix' => 'validasi', 'as' => 'validasi.'], function () {
        Route::get('/{active_tab?}', [ValidasiController::class, 'index'])->name('index');
        Route::patch('update-status-sewa/{sewa}', [ValidasiController::class, 'validasiSewa'])->name('sewa');
        // Route::patch('update-status-penyewa/{penyewa}/{status}', [ValidasiController::class, 'validasiPenyewa'])->name('penyewa');
        Route::patch('update-status-pemasukan/{pemasukan}', [ValidasiController::class, 'validasiPemasukan'])->name('pemasukan');
        // Route::patch('update-status-pengeluaran/{pengeluaran}/{status}', [ValidasiController::class, 'validasiPengeluaran'])->name('pengeluaran');
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

