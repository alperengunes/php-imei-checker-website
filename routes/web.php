<?php

use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Tags\Url;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('hakkimizda',function (){
    return view('hakkimizda');
});
Route::get('apple-imei-sorgula',function (){
    return view('sayfalar.apple-imei-sorgula');
});
Route::get('huawei-imei-sorgula',function (){
    return view('sayfalar.huawei-imei-sorgula');
});
Route::get('samsung-imei-sorgula',function (){
    return view('sayfalar.samsung-imei-sorgula');
});
Route::get('nokia-imei-sorgula',function (){
    return view('sayfalar.nokia-imei-sorgula');
});
Route::get('sitemap',function (){
    $appUrl = env('APP_URL');
    return \Spatie\Sitemap\Sitemap::create()
        ->add(Url::create($appUrl)
            ->setLastModificationDate(\Carbon\Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(1))
        ->add(Url::create($appUrl.'hakkimizda')
            ->setLastModificationDate(\Carbon\Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(1))
        ->add(Url::create($appUrl.'apple-imei-sorgula')
            ->setLastModificationDate(\Carbon\Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(1))
        ->add(Url::create($appUrl.'huawei-imei-sorgula')
            ->setLastModificationDate(\Carbon\Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(1))
        ->add(Url::create($appUrl.'samsung-imei-sorgula')
            ->setLastModificationDate(\Carbon\Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(1))
        ->add(Url::create($appUrl.'nokia-imei-sorgula')
            ->setLastModificationDate(\Carbon\Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(1))
        ->writeToFile(storage_path('sitemap.xml'));
});
