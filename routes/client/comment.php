<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::prefix('comment')->group(function(){
    Route::controller(CommentController::class)->group(function(){
        Route::post('/add', 'add')->name('comment.add');
        Route::post('/edit', 'edit')->name('comment.edit');
        Route::post('/delete', 'delete')->name('comment.delete');
    });
});
