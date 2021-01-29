<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\BookCollection;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    public static $rules = [
        'title' => 'required|string',
        'author' => 'required|string',
        'editorial' => 'required|string',
        'year_edition' => 'required|numeric',
        'price' => 'required|numeric',
        'pages' => 'required|numeric',
        'synopsis' => 'required|string|max:255',
        'cover_page' => 'required|image|dimensions:min_width=200,min_height=200',
        'back_cover' => 'image|dimensions:min_width=200,min_height=200',
        'available' => 'required|boolean',
        'new' => 'required|boolean',
        'category_id'=>'required'
    ];

    public function index()
    {
       //$this->authorize('ViewAny',Book::class);

        return new BookCollection(Book::paginate(10));
    }

    public function show(Book $book)
    {
        //$this->authorize('View',Book::class);
        return response()->json(new BookResource($book), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, User $user)
    {
        //$this->authorize('create',$book);

        $request->validate(self::$rules, self::$messages);
//        $book = Book::create($request->all());
//        return response()->json($book,201);
        $book = new Book($request->all());
        $pathcp = $request->cover_page->store('public/books/cover_pages');
        $pathbc = $request->back_cover->store('public/books/back_cover');
        $book->cover_page = $pathcp;
        $book->back_cover = $pathbc;
        $book->save();
        //$book = $user->books()->save(new Book($request->all()));
        return response()->json(new BookResource($book), 201);
    }
    public function available(){
        return response()->json(BookResource::collection(Book::where('available', 1)->get()), 200);
    }
    public function update(Request $request, Book $book)
    {
        $this->authorize('update',$book);

        $request->validate(self::$rules, self::$messages);
        $book->update($request->all());
        return response()->json($book, 200);
    }

    public function delete(Book $book)
    {
        $this->authorize('delete',$book);

        $book->delete();
        return response()->json(null, 204);
    }

    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function showmybooks()
    {
        $user = Auth::user();
        return response()->json(BookResource::collection($user->books), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Category $category)
    {
        return response()->json(BookResource::collection($category->books), 200);
    }
}
