<?php 

namespace App\Repositories;

use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\DB;

class UsersRepository extends RepositoryBase
{
    public function __construct()
    {
        parent::__construct(new Users());
    }

    public function save($request, $id_log){
        try
        {
            $user = new Users();
            $id = $request->input(['user_id']);
            
            DB::beginTransaction();

            if(isset($id))
            {
                $user = Users::find($id);
                $user = $this->makeObj($user, $request);
                
                $user->update();
            }
            else{
                $user->fill($this->makeObjUser($request, $id_log));
                $user->save();
            }

            DB::commit();

        } catch(Exception $e){
            DB::rollBack();
            throw new Exception(''.$e->getMessage());
        }
    }

    public function getUser($id){
        return Users::getUser($id);
    }

    public function destroyUser($user_id){

        try
        {
            DB::beginTransaction();

            $repLogradouro = new LogradouroRepository();
            $repUser = new UsersRepository();

            $user = Users::getUser($user_id);
            $logradouro = $repLogradouro->getLogradouro($user_id);
            if(isset($user) && isset($logradouro))
            {
                $user->delete();
                $logradouro->delete();
            }
            else{
                throw new Exception('error');
            }

            DB::commit();
            return response()->json(['success' => true, 'msg' => 'Usuário Excluido com Sucesso!']);

        } catch(Exception $e){
            DB::rollBack();
            throw new Exception(''. $e->getMessage());
        }
    }

    public function makeObj($obj, $request)
    {
        $obj->nome = $request->input(['nome']) ?? '';
        $obj->data_nascimento = $request->input(['data_nasc']) ?? '';
        $obj->cpf = $request->input(['cpf']) ?? '';
        $obj->email = $request->input(['email']) ?? '';

        return $obj;
    }

    public function makeObjUser($request, $id_log){
        return [
            'nome' => $request->input(['nome']) ?? '',
            'data_nascimento' => $request->input(['data_nasc']) ?? '',
            'cpf' => $request->input(['cpf']) ?? '',
            'email' => $request->input(['email']) ?? '',
            'logradouro_id'  => $id_log
        ];
    }
}