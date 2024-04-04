<?php

use App\Models\Comment;
use App\Models\Course;
use App\Models\Image;
use App\Models\Module;
use App\Models\Permission;
use App\Models\User;
use App\Models\Preference;
use App\Models\Tag;
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

/// many to many


Route::get('/many-to-many-polymorphic', function(){
    // $user = User::first();

    // Tag::create(['name' => 'tag1', 'color' => 'red']);
    // Tag::create(['name' => 'tag2', 'color' => 'ped']);
    // Tag::create(['name' => 'tag3', 'color' => 'ced']);


   $tag = Tag::where('name', 'tag3')->first();


    dd($tag->users);
});





//one to many polymorphic


Route::get('/one-to-many-polymorphic', function (){
    // $course = Course::first();
    // $course->comments()->create([
    //     'subject' => 'Novo comentario',
    //     'content' => 'Curso muito massa!!'
    // ]);

    // dd($course->comments);

    $comment = Comment::find(1);
    dd($comment->commentable);
});






// one to one polymorphicf

Route::get('/one-to-one-polymorphic', function () {
    $user = User::first();
    $data = ['path' => 'path/nome-image-2png'];


    if ($user->image) {
        $user->image->update($data);
    } else {
        $user->image()->create($data);
    }


    dd($user->image);
});




//Many to many

Route::get('/Many-to-many', function () {
    $user = User::with('permissions')->find(1);

    $permission = Permission::find(1);
    $user->permissions()->save($permission);

    $user->refresh();

    dd($user->permissions);
});




//One to many

Route::get('/One-to-many', function () {
    $course = Course::create(['name' => 'Curso de laravel']);
    $course = Course::with('modules.lessons')->first();

    dd($course);

    echo $course->name;
    echo '<br>';
    foreach ($course->modules as $module) {
        echo "Modulo {$module->name} <br>";

        foreach ($module->lessons as $lesson) {

            echo "Aula {$lesson->name} <br>";
        }
    }
    $data = [
        'name' => 'Modulo 001'
    ];

    $course->modules()->create($data);

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
