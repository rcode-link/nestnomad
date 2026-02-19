<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\Property;
use Illuminate\Http\Request;
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

Route::get('/properties', function () {
    $lang = session("lang", 'en');
    App::setLocale($lang);
    view()->share([
        'lanuage' => $lang,
    ]);
    return view('landing.properties');
})->name('properties');

Route::get('/properties/{property}', function (Property $property) {
    abort_unless($property->public, 404);

    $lang = session("lang", 'en');
    App::setLocale($lang);
    view()->share([
        'lanuage' => $lang,
    ]);
    $property->load('media');
    return view('landing.property-show', compact('property'));
})->name('properties.show');

Route::get('/terms', function () {
    $lang = session("lang", 'en');
    App::setLocale($lang);
    view()->share(['lanuage' => $lang]);
    return view('landing.terms');
})->name('terms');

Route::get('/privacy', function () {
    $lang = session("lang", 'en');
    App::setLocale($lang);
    view()->share(['lanuage' => $lang]);
    return view('landing.privacy');
})->name('privacy');

Route::post('/app/tour-completed', function (Request $request) {
    $request->user()->update(['tour_completed' => true]);

    return response()->json(['status' => 'ok']);
})->middleware(['web', 'auth'])->name('tour.completed');

Route::get('/app/tour-restart', function (Request $request) {
    $request->user()->update(['tour_completed' => false]);

    return redirect('/app');
})->middleware(['web', 'auth'])->name('tour.restart');

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
