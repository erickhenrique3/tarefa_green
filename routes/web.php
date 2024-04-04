<?php

use App\Models\Course;
use App\Models\Module;
use App\Models\User;
use App\Models\Preference;
use Illuminate\Support\Facades\Route;

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

//One to many

Route::get('/One-to-many', function(){
    //  $course = Course::create(['name'=> 'Curso de laravel']);
    $course = Course::with('modules.lessons')->first();

    dd($course);

      echo $course->name;
      echo '<br>';
      foreach($course->modules as $module){
      echo "Modulo {$module->name} <br>";

        foreach($module->lessons as $lesson){
        echo "Aula {$lesson->name} <br>";
        
        }
      }
    $data = [
        'name' => 'Modulo 001'
    ];

    // $course->modules()->create($data);

    //  $course->modules()->get();
    // Module::find(2)->update();
    $modules = $course->modules;

    

    dd($modules);
});















//one-to-onee//
Route::get('/one-to-one', function () {
    $user = User::first();
    
    $data = [
        'background_color' => '#0000',
    ];


    if ($user->preference) {
        $user->preference()->update($data);
    } else {
        $user->preference()->create($data);
    }


    $user->refresh();


    dd($user->preference);
});


Route::get('/', function () {
    return view('welcome');
});
