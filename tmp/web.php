Route::get('/posts', [PostController::class, 'index'])->name("posts");
Route::get('/posts/new', [PostController::class, 'new'])->middleware('role:' . UserRole::Moderator)->name("posts.new");
Route::get('/posts/import', [PostController::class, 'import'])->middleware('role:' . UserRole::Moderator)->name("posts.import");
Route::get('/posts/{post}', [PostController::class, 'show'])->name("post");
Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->middleware('role:' . UserRole::Moderator)->name("post.edit");
Route::get('/posts/delete/{post}', [PostController::class, 'delete'])->middleware('role:' . UserRole::Moderator)->name("post.delete");


Route::get('/admin/post', [PostController::class, 'create'])
    ->middleware('role:' . UserRole::Moderator)
    ->name("admin.post.create");

Route::post('/admin/post/create', [PostController::class, 'store'])
    ->middleware('role:' . UserRole::Moderator)
    ->name("admin.post.creating");


