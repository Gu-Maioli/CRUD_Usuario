<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Repositories\LogradouroRepository;
use App\Repositories\UsersRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logradouros = new LogradouroRepository();
        
        $users = new Users();
        $users = $users->getAllUsers();

        // formatar Logradouro
        foreach($users as $user){
            $user->logradouro = $logradouros->makeLogradouro($user);
        }
        
        return view('form', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            // se for para editar o User
            $id = $request->input(['user_id']);
            if(isset($id)){
                $this->edit($request);
            }

            // logradouro
            $repLogradouro = new LogradouroRepository();
            $id_log = $repLogradouro->save($request);

            // user
            $repUser = new UsersRepository();
            $repUser->save($request, $id_log);

            return response()->json(['success' => true, 'msg' => 'Salvo com sucesso!']);
        } catch(Exception $e){
            return response()->json(['success' => false, 'msg' => 'Erro ao Salvar!'.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    
    public function edit(Request $request)
    {
        try
        {
            // logradouro
            $repLogradouro = new LogradouroRepository();
            $repLogradouro->save($request);

            // user
            $repUser = new UsersRepository();
            $repUser->save($request, null);

            return response()->json(['success' => true, 'msg' => 'Salvo com sucesso!']);
        } catch(Exception $e){
            return response()->json(['success' => false, 'msg' => 'Erro ao Salvar!'.$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users $users)
    {
        //
    }

    public function destroy($user_id)
    {
        try
        {
            $repUser = new UsersRepository();
            
            // exclui o logradouro e User
            $repUser->destroyUser($user_id);

            return response()->json(['success' => true, 'msg' => 'Usuário Excluido com Sucesso!']);
        } catch(Exception $e){
            return response()->json(['success' => false, 'msg' => 'Não foi Possivel Excluir o Usuário!'.$e->getMessage()]);
        }
    }

    public function getUser($id)
    {
        $users = new Users();
        $users = $users->getUser($id);

        return response()->json(['success' => true, 'user' => json_decode($users)]);
    }
}
