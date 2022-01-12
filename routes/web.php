<?php
use App\Book;
use App\User;
use Illuminate\Http\Request;
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
    return view('welcome');
});


Route::get('/addbook', function (Request $request) {
	
        $book = Book::create($request->all());
		$book->save();

        return response()->json($book, 200);
    
    
});


Route::get('/updatebook/{id}', function ($id,Request $request) {
    try
	{
		$book=Book::find($id);
		if ($book==null)
			throw new Exception("Null");
		$book->bookname=$request["bookname"];
		$book->price=$request["price"];
        $book->save();

        return response()->json($book, 200);
	}
	catch(Exception $e)
	{
		return response()->json("Error", 200);
	}
		
    });
	




Route::get('/delbook/{id}', function ($id) {
    try
	{
		$book=Book::find($id);
		if ($book==null)
			throw new Exception("Null");
        $book->delete();

        return response()->json($book, 200);
	}
	catch(Exception $e)
	{
		return response()->json("Error", 200);
	}
		
    });
	
	
Route::get('/book', function () {
	$book =new Book();
	$book->bookname="Champak";
	$book->price=1000;
	$book->save();
    return view('book');
});

Route::post('/all', function () {
	    return "post";//book::all();
});
Route::get('/alljson', function () {
	;
    return response()->json(book::all(),200);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
