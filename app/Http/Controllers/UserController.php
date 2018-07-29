<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{

    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {

        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = $this->userService->getPaginate();

        return view ('user.list', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param  \App\User $user
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->name = $request->getUserName();
        $user->email = $request->getUserEmail();

        $user->save();

        return redirect()
            ->route('user.index')
            ->with('status', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()
            ->route('user.index')
            ->with('status', 'User deleted successfully!');
    }
}
