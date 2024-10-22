<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * optei por utilizar o sistema de resource do laravel 
     * Usando o php artisan create:controller UserController --resource
     * Com este comando ele gerou todas as rotas de forma automática
     * só sendo necessário adicionar uma linha ao arquivo /routes/web.php
     * A função index eu usei para exibir a listagem de usuários
     */
    public function index()
    {
        $users = User::all();
        return view('home', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Criei a função formValidate() para usar tanto no store quanto no update
        // ela está no final da classe
        $errors = array();
        $errors = $this->formValidate($request);
        if (count($errors))
            return back()->with('errors', $errors);
        else {
            if (strlen($request->birth_date) == 10) {
                $date = explode('/', $request->birth_date);
                if (count($date) == 3) {
                    $db_date = $date[2] . '-' . $date[1] . '-' . $date[0];
                    if (!strtotime($db_date)) {
                        $errors = ['A data informada é inválida'];
                        return back()->with('errors', $errors);
                    } else if (date($db_date) > date('Y-m-d', time())) {
                        $errors = ['Você precisa informar uma data do passado'];
                        return back()->with('errors', $errors);
                    }
                }

            } else {
                $errors = ['A data informada é inválida'];
                return back()->with('errors', $errors);
            }

            User::create([
                "name" => $request->name,
                "cpf" => $request->cpf,
                "email" => $request->email,
                "birth_date" => $db_date,
                "phone" => $request->phone,
                'password' => bcrypt($request->password),
            ]);
            return redirect('/');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $errors = array();
        $errors = $this->formValidate($request, 'update');
        if (count($errors))
            return back()->with('errors', $errors);
        else {
            if (strlen($request->birth_date) == 10) {
                $date = explode('/', $request->birth_date);
                if (count($date) == 3) {
                    $db_date = $date[2] . '-' . $date[1] . '-' . $date[0];
                    if (!strtotime($db_date)) {
                        $errors = ['A data informada é inválida'];
                        return back()->with('errors', $errors);
                    } else if (date($db_date) > date('Y-m-d', time())) {
                        $errors = ['Você precisa informar uma data do passado'];
                        return back()->with('errors', $errors);
                    }
                }

            } else {
                $errors = ['A data informada é inválida'];
                return back()->with('errors', $errors);
            }

            if (isset($request->password)) {
                User::where('id', $id)->update([
                    "name" => $request->name,
                    "cpf" => $request->cpf,
                    "email" => $request->email,
                    "birth_date" => $db_date,
                    "phone" => $request->phone,
                    'password' => bcrypt($request->password),
                ]);
            } else {
                User::where('id', $id)->update([
                    "name" => $request->name,
                    "cpf" => $request->cpf,
                    "email" => $request->email,
                    "birth_date" => $db_date,
                    "phone" => $request->phone,
                ]);
            }

            return redirect('/');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/');
    }


    public function formValidate(Request $request, $update = null)
    {
        $errors = array();
        if (!isset($request->name)) {
            array_push($errors, 'O campo nome é obrigatório');
        }
        if (!isset($request->cpf)) {
            array_push($errors, 'O campo CPF é obrigatório');
        }
        if (!isset($request->email)) {
            array_push($errors, 'O campo e-mail é obrigatório');
        } else if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'O campo e-mail é inválido');
        }
        if (!isset($request->birth_date)) {
            array_push($errors, 'O campo data de nascimento é obrigatório');
        }
        if (!isset($request->phone)) {
            array_push($errors, 'O campo telefone é obrigatório');
        }
        
        // Se estiver editando ignoramos as verificações abaixo
        if (!$update) {
            if (!isset($request->password)) {
                array_push($errors, 'O campo senha é obrigatório');
            }
            $emailUser = User::where('email', $request->email)->get();
            if (count($emailUser))
                array_push($errors, 'O e-mail informado já está cadastrado no nosso banco de dados');
            $cpfUser = User::where('cpf', $request->cpf)->get();
            if (count($cpfUser))
                array_push($errors, 'O cpf informado já está cadastrado no nosso banco de dados');
        }

        return $errors;
    }

}
