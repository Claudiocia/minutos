<?php

namespace App\Http\Controllers;

use App\Forms\UserForm;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Jetstream;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if($search == null){
            $users = User::orderBy('name', 'ASC')->paginate(15);
            return view('admin.users.index', compact('users'));
        }else{
            $users = User::where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%')
                ->paginate(15);
            return view('admin.users.index', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function dashboardAdmin()
    {
        $numassin = Cliente::whereSigned(2)->count();
        //dd($teste);
        return view('dashboard', compact('numassin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $form = \FormBuilder::create(UserForm::class,[
            'url' => route('admin.users.store'),
            'method' => 'POST',
        ]);
        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $form = \FormBuilder::create(UserForm::class);
        $data = $form->getFieldValues();
        //dd($data);
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
        ], [
            'role.required' => 'Selecione se o novo usuário é Administrador',
        ])->validate();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make('secret'),
        ]);

        $request->session()->flash('msg', 'Usuário Criado com sucesso');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return View
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return View
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create(UserForm::class, [
            'url' => route('admin.users.update', [ 'user' => $user->id]),
            'method' => 'PUT',
            'model' => $user,
            'data' => ['id' => $user->id],
        ]);

        return view('admin.users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $form = \FormBuilder::create(UserForm::class);
        $data = $form->getFieldValues();
        //dd($data);
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required'],
        ], [
            'role.required' => 'Selecione se o usuário é Administrador',
        ])->validate();

        $user->fill($data);
        $user->save();

        $request->session()->flash('msg', 'Usuário atualizado com sucesso!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  User $user
     * @return RedirectResponse
     */
    public function destroy(Request  $request, User $user)
    {
        $user->delete();
        $request->session()->flash('msg', 'Usuário deletado com sucesso');
        return redirect()->route('admin.users.index');
    }
}
