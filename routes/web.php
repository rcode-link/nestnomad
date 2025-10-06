<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

//Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/', function () {

    $lang = session("lang", 'en');
    App::setLocale($lang);
    view()->share([
        'lanuage' => $lang,
    ]);
    return view('landing.index');
})->name('landing');

Route::get('/lang/{lang}', function ($lang) {
    $languages = config('app.available_locales');
    session(['lang' => isset($languages[$lang]) ? $lang : config('app.locale')]);


    return redirect()->back();

})->name('lang');

# Route::view('dashboard', 'dashboard')
#     ->middleware(['auth', 'verified'])
#     ->name('dashboard');
#
# Route::middleware(['auth'])->group(function () {
#     Route::redirect('settings', 'settings/profile');
#
#     Route::get('settings/profile', Profile::class)->name('settings.profile');
#     Route::get('settings/password', Password::class)->name('settings.password');
#     Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
# });
#
# require __DIR__.'/auth.php';
