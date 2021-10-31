<?php 

namespace App\Repositories;

use App\Models\Logradouro;
use Exception;
use Illuminate\Support\Facades\DB;

class LogradouroRepository extends RepositoryBase
{
    public function __construct()
    {
        parent::__construct(new Logradouro());
    }

    public function save($request){
        try
        {
            $logradouro = new Logradouro();
            $log_id = $request->input(['log_id']);
            
            DB::beginTransaction();

            if(isset($log_id)){
                $logradouro = Logradouro::find($log_id);
                $logradouro = $this->makeObj($logradouro, $request);
                $logradouro->update();
            }
            else{
                $logradouro->fill($this->makeObjLogradouro($request));
                $logradouro->save();
            }            
            
            DB::commit();

        } catch(Exception $e){
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return $logradouro->id;
    }

    public function getLogradouro($id){
        return Logradouro::getLogradouro($id);
    }

    public function makeObj($obj, $request){
        $obj->rua = $request->input(['rua']) ?? '';
        $obj->bairro = $request->input(['bairro']) ?? '';
        $obj->complemento = $request->input(['complemento']) ?? '';
        $obj->numero = $request->input(['numero']) ?? '';
        $obj->cidade = $request->input(['cidade']) ?? '';

        return $obj;
    }

    public function makeObjLogradouro($request){
        return [
                'rua' => $request->input(['rua']) ?? '',
                'bairro' => $request->input(['bairro']) ?? '',
                'complemento' => $request->input(['complemento']) ?? '',
                'numero' => $request->input(['numero']) ?? '',
                'cidade' => $request->input(['cidade']) ?? ''
                ];
    }

    public function makeLogradouro($obj){
        // Rua - n°, Bairro. Cidade
        return ($obj->rua.' - N°:'.$obj->numero.', '.$obj->bairro.'. '.$obj->cidade);
    }
}