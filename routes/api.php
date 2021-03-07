<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/v1/ali/')->group(function () {
    Route::post('product/post-schema', [App\Http\Controllers\API\Ali\ProductPostSchemaController::class, 'post'])->name('ali_product_post_schema');
});
