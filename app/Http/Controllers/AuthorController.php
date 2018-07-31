<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Author;
use App\Http\Requests\AuthorRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $authors = Author::all();

        return view('author.list', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorRequest $request
     * @return RedirectResponse
     */
    public function store(AuthorRequest $request): RedirectResponse
    {
        Author::create([
            'first_name' => $request->getFirstname(),
            'last_name' => $request->getLastname(),
        ]);

        return redirect()
            ->route('author.index')
            ->with('status', 'Author created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Author $author
     * @return View
     */
    public function edit(Author $author): View
    {

        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AuthorRequest $request
     * @param Author $author
     * @return RedirectResponse
     */
    public function update(AuthorRequest $request, Author $author): RedirectResponse
    {
        $author->first_name = $request->getFirstName();
        $author->last_name = $request->getLastName();
        $author->save();
        return redirect()
            ->route('author.index')
            ->with('status', 'Updated successfully!');
    }
}

