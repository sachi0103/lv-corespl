<?php



use App\Http\Controllers\Backend\AccountController;

use App\Http\Controllers\Backend\PackageController;

use App\Http\Controllers\Backend\PaymentController;

use App\Http\Controllers\Backend\ReportController;

use App\Http\Controllers\Backend\UsersController;

use App\Http\Controllers\Backend\PackagesController;

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
    return redirect()->route('welcome.php', md5($request->action) );
});
Route::get('/welcome/{id}', [App\Http\Controllers\Backend\DashboardController::class, 'welcome'])->name('welcome.php');
Route::get('/contactus', [App\Http\Controllers\AuthController::class, 'contact_us'])->name('contactus');
Route::post('/contactus/save', [App\Http\Controllers\AuthController::class, 'contact_us'])->name('contactus.save');
Route::post('/authenticate', [App\Http\Controllers\AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/user_verification/{id}/{cid}', [UsersController::class, 'verifyUser'])->name('user.verification');
    
Route::prefix('/call-recall')->middleware('auth')->name('admin.')->group(function () {

    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('user.profile');
    Route::post('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('user.profile');



    Route::get('/portal', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    Route::post('/reports', [ReportController::class, 'index'])->name('reports.index');

    Route::get('/account/user/{packageId}', [AccountController::class, 'show'])->name('accounts.user');



    Route::resource('/accounts', AccountController::class);

    Route::get('/accounts/add_minutes/{userid}', [AccountController::class, 'add_minutes'])->name('accounts.add_minutes');

    Route::get('/accounts/transaction/success/{userid}', [AccountController::class, 'success'])->name('accounts.transaction.success');

    Route::get('/accounts/transaction/success', [AccountController::class, 'success'])->name('accounts.transaction.success');

    Route::get('/accounts/transaction/cancel/{cpId}/{paymentId}/{puserid}/{userid}', [AccountController::class, 'cancel'])->name('accounts.transaction.cancel');

    Route::get('/accounts/transaction/cancel/{cpId}/{paymentId}/{puserid}', [AccountController::class, 'cancel'])->name('accounts.transaction.cancel');


    Route::post('/ajaxUniqueEmail', [AccountController::class, 'ajaxUniqueEmail'])->name('accounts.ajaxUniqueEmail');

    Route::post('/accounts/add_minutes', [AccountController::class, 'save_extra_minutes'])->name('accounts.save_minutes');

    Route::get('/accounts/renew_plan/{custpackageid}', [AccountController::class, 'renew_plan'])->name('accounts.renew_plan');

    Route::get('/accounts/renew_all_plan/{custpackageid}', [AccountController::class, 'all_user_plan_renew'])->name('accounts.renew_all_plan');

    Route::resource('/users', UsersController::class);

    Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
    Route::post('/users/update', [UsersController::class, 'update'])->name('users.update');
    Route::get('/users/removed/{id}', [UsersController::class, 'destory'])->name('users.destory');

    Route::post('/users/reassignPackage', [UsersController::class, 'reassignPackage'])->name('users.reassignPackage');

    Route::resource('/packages', PackagesController::class);

    Route::get('/packages/transaction/success', [PackagesController::class, 'success'])->name('packages.transaction.success');

    Route::get('/packages/transaction/cancel/{paymentId}', [PackagesController::class, 'cancel'])->name('packages.transaction.cancel');
    
});



Route::get('/array', function () {

    $countryDatabaseTable = public_path('backend\countries.sql');

    dd($countryDatabaseTable);

});

