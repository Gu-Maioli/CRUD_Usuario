<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
    <title>Document</title>
</head>
    <body style="background-color: rgb(205, 214, 214); font-family: arial">
      <script src="{{asset('js/users.js')}}"></script>
        <div class="container col-md-12" style="margin-top: 10px; margin-left: 10px;">
          <div class="col-md-12 align-self-center">

            <div class="row offset-md-6">
              <h2>Cadastro de Usuário</h2>
            </div>
            <br>
            {!! Form::open(['url' => url('/index'), 'method' => 'GET', 'id' => 'form-id']) !!}
              @csrf
              
              <div class="row offset-md-3">
                <div class="col-md-6">
                  {!! Form::label('nome', 'Nome', ['class' => 'form-label']) !!}
                  {!! Form::text('nome', null, ['class' => 'form-control', 'id' => 'nome']) !!}
                </div>
                <div class="col-md-3">
                  {!! Form::label('data_nasc', 'Data de Nascimento', ['class' => 'form-label']) !!}
                  {!! Form::date('data_nasc', null, ['class' => 'form-control', 'id' => 'data_nasc-id']) !!}
                </div>
                <div class="col-md-3">
                  {!! Form::label('cpf', 'CPF', ['class' => 'form-label']) !!}
                  {!! Form::text('cpf', null, ['class' => 'form-control', 'id' => 'cpf-id']) !!}
                </div>
              </div>
                  
              <div class="row offset-md-3">
                <div class="col-md-4">
                  {!! Form::label('email', 'E-Mail', ['class' => 'form-label']) !!}
                  {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email-id']) !!}
                </div>
                <div class="col-md-5">
                  {!! Form::label('rua', 'Rua', ['class' => 'form-label']) !!}
                  {!! Form::text('rua', null, ['class' => 'form-control', 'id' => 'rua-id']) !!}
                </div>
                  <div class="col-md-3">
                    {!! Form::label('numero', 'N°', ['class' => 'form-label']) !!}
                    {!! Form::number('numero', null, ['class' => 'form-control', 'id' => 'num-id']) !!}
                  </div>
                </div>

                <div class="row offset-md-3">
                  <div class="col-md-3">
                    {!! Form::label('bairro', 'Bairro', ['class' => 'form-label']) !!}
                    {!! Form::text('bairro', null, ['class' => 'form-control', 'id' => 'bairro-id']) !!}
                  </div>
                  <div class="col-md-5">
                    {!! Form::label('complemento', 'Complemento', ['class' => 'form-label']) !!}
                    {!! Form::text('complemento', null, ['class' => 'form-control', 'id' => 'complemento-id']) !!}
                  </div>
                  <div class="col-md-4">
                    {!! Form::label('cidade', 'Cidade', ['class' => 'form-label']) !!}
                    {!! Form::text('cidade', null, ['class' => 'form-control', 'id' => 'cidade-id']) !!}
                  </div>
                </div>
                  <br><br>
                  <div class="row">
                    <div class="col-md-6 offset-md-6">
                    <button type="submit" id="salvar-id" class="btn btn-success">Salvar</button>
                    <a id="cancelar-id" onclick="cancelar()" class="btn btn-danger">Cancelar</a>
                  </div>
                  </div>
                  <br>
                  {!! Form::hidden('user_id', isset($user->user_id) ? $user->user_id : null, ['id' => 'user_id']) !!}
                  {!! Form::hidden('log_id', isset($user->logradouro_id) ? $user->logradouro_id : null, ['id' => 'log_id']) !!}
                  <table id="table-id" style="width: 100%; text-align: center;" class="table table-striped col-md-10 offset-1">
                    <thead>
                      <tr style="white-space: nowrap;">
                        <th style="width: 25%;">Nome</th>
                        <th style="width: 10%;">CPF</th>
                        <th style="width: 20%;">E-mail</th>
                        <th style="width: 10%;">Data de Nascimento</th>
                        <th style="width: 20%;">Logradouro</th>
                        <th style="width: 10%;">Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
                        <tr style="white-space: nowrap;">
                          <td>
                            {{$user->nome}}
                          </td>
                          <td>
                            {{$user->cpf}}
                          </td>
                          <td>
                            {{$user->email}}
                          </td>
                          <td>
                            {{$user->data_nascimento}}
                          </td>
                          <td>
                            {{$user->logradouro}}
                          </td>
                          <td class="sticky-col first-col">
                            <button type="button" class="btn btn-primary" id="edit_{{$user->user_id}}" onclick="editarUser('{{$user->user_id}}')">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brush-fill" viewBox="0 0 16 16">
                                <path d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.067 6.067 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.118 8.118 0 0 1-3.078.132 3.659 3.659 0 0 1-.562-.135 1.382 1.382 0 0 1-.466-.247.714.714 0 0 1-.204-.288.622.622 0 0 1 .004-.443c.095-.245.316-.38.461-.452.394-.197.625-.453.867-.826.095-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.201-.925 1.746-.896.126.007.243.025.348.048.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.176-2.67 6.18-6.206 9.117-8.104a.5.5 0 0 1 .596.04z"/>
                              </svg>
                            </button>
                            <button type="button" class="btn btn-danger" id="excluir-{{$user->user_id}}" onclick="excluirUser('{{$user->user_id}}')">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bucket-fill" viewBox="0 0 16 16">
                                <path d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5zm1.005 0a4.5 4.5 0 0 1 8.945 0H3.527z"/>
                              </svg></button>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
              {!! Form::close() !!}
          </div>
        </div>
        <script>
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        // salvar usuario
          $('form[id="form-id"]').submit(function(){
            event.preventDefault();
            $.ajax({
                url: $(location).attr('href') + 'store',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'JSON',
                success: function(data){
                    if(data.success){
                        swal({
                            title: "Usuário Salvo!",
                            text: data.msg,
                            type: "success",
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                    else{
                        swal({
                            title: "",
                            text: data.msg,
                            type: "error",
                            timer: 5000,
                            showConfirmButton: true
                        });
                    }
                }
            })
            location.reload();
        });
        </script>
    </body>
</html>