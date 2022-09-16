<?php



use App\Http\Controllers\Backend\AccountController;

use App\Http\Controllers\Backend\PackageController;

use App\Http\Controllers\Backend\PaymentController;

use App\Http\Controllers\Backend\ReportController;

use App\Models\Country;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

use PHPUnit\Framework\Constraint\Count;

use Illuminate\Http\Request;


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

    return redirect(route("login"));

});

Route::get('/account.php',function(Request $request) {
    return redirect()->route('welcome.php', ['id' => $request->id]);
});
Route::get('/welcome', [App\Http\Controllers\Backend\DashboardController::class, 'welcome'])->name('welcome.php');
Route::post('/authenticate', [App\Http\Controllers\AuthController::class, 'authenticate'])->name('authenticate');
Route::prefix('/call-recall')->middleware('auth')->name('admin.')->group(function () {



    Route::get('/portal', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    Route::get('/account/user/{packageId}', [AccountController::class, 'show'])->name('accounts.user');



    Route::resource('/accounts', AccountController::class);

    Route::get('/accounts/transaction/success', [AccountController::class, 'success'])->name('accounts.transaction.success');

    Route::get('/accounts/transaction/cancel/{cpId}/{paymentId}', [AccountController::class, 'cancel'])->name('accounts.transaction.cancel');

    Route::post('/ajaxUniqueEmail', [AccountController::class, 'ajaxUniqueEmail'])->name('accounts.ajaxUniqueEmail');

});



Route::get('/array', function () {

    $countryDatabaseTable = public_path('backend\countries.sql');

    dd($countryDatabaseTable);

});

