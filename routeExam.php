use App\Http\Controllers\TokenController;

Route::get('/token/balance', [TokenController::class, 'getBalance']);
