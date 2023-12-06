<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//use breadcrumbs as Breadcrumbs;


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

Route::get('/', function () {
    //show the home page
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Route::get('/about', function () {
    //show the about page
    Breadcrumbs::for('about', function ($trail) {
        $trail->parent('home');
        $trail->push('About', route('about'));
    });
    return view('pages.about');
})->name('about');

Route::get('/pc', [App\Http\Controllers\MyPcController::class, 'index'])->name('pc');
Breadcrumbs::for('pc', function ($trail) {
    $trail->parent('home');
    $trail->push('PC', route('pc'));
});

Route::get('/history', function () {
    Breadcrumbs::for('history', function ($trail) {
        $trail->parent('home');
        $trail->push('History', route('history'));
    });
    //show the history page
    return view('pc/history');
})->name('history');

//use brands controller for brands
Route::resource('brands', App\Http\Controllers\BrandsController::class);

Route::get('/parttype/{parttype}', [App\Http\Controllers\ParttypeController::class, 'index'])->name('parttype');
Breadcrumbs::for('parttype', function ($trail, $parttype) {
    $trail->parent('home');
    $trail->push($parttype, route('parttype', $parttype));
});

Route::get('/component/{parttype}/{partID}', [App\Http\Controllers\PartsController::class, 'index'])->name('components');
Breadcrumbs::for('components', function ($trail, $parttype, $partID) {
    $trail->parent('home');
    $trail->push($parttype, route('parttype', $parttype));
    $componentName = App\Models\Parts::where('PartID', $partID)->first();
    $trail->push($componentName->Name, route('components', [$parttype, $partID]));
});


Route::delete('/product/{partID}', [App\Http\Controllers\PartsController::class, 'destroy'])->name('product.destroy');

Route::put('/product/{product}', [App\Http\Controllers\PartsController::class, 'update'])->name('product.update');

Route::put('/pc/{parttype}/{partID}', [App\Http\Controllers\MyPcController::class, 'remove'])->name('pc.remove');

Route::post('/addcomponent/{partID}', [App\Http\Controllers\PartsController::class, 'addtopc'])->name('addtopc');

//make route for profile page
Route::get('/shippingDetails', [App\Http\Controllers\ShippingDetailsController::class, 'index'])->name('shippingDetails');
Route::put('/shippingDetails/{shippingDetails}', [App\Http\Controllers\ShippingDetailsController::class, 'update'])->name('shippingDetails.update');
Breadcrumbs::for('shippingDetails', function ($trail) {
    $trail->parent('home');
    $trail->push('Shipping Details', route('shippingDetails'));
});