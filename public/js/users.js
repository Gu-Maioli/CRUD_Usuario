var userEdit = [];

function excluirUser(id)
{
    event.preventDefault();
    swal({
        title: 'Excluir',
        html: 'Deseja Excluir o Usuário?',
        type: 'warning',
        showLoaderOnConfirm: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        showCancelButton: true,
        closeOnConfirm: true,
    }).then((result) => {
        if(result){
            $.ajax({
                url: $(location).attr('href') + 'destroy/' + id,
                type: 'POST',
                data: {id:id},
                dataType: 'JSON',
                success: function(data){
                    if(data.success){
                        swal({
                            title: "Usuário Excluido!",
                            text: data.msg,
                            type: "success",
                            showConfirmButton: true
                        });
                    }
                    else{
                        swal({
                            title: "",
                            text: data.msg,
                            type: "error",
                            showConfirmButton: true
                        });
                    }
                    setTimeout(function(){ location.reload() }, 2000);
                }
            })
        }
    });
}

function cancelar()
{
    makeUserToEdit('');
    location.reload();
}

function makeUserToEdit(user)
{
    $('#user_id').val(user["user_id"]);
    $('#log_id').val(user["logradouro_id"]);
    $('#nome').val(user["nome"]);
    $('#data_nasc-id').val(user["data_nascimento"]);
    $('#cpf-id').val(user["cpf"]);
    $('#email-id').val(user["email"]);
    $('#rua-id').val(user["rua"]);
    $('#bairro-id').val(user["bairro"]);
    $('#num-id').val(user["numero"]);
    $('#cidade-id').val(user["cidade"]);
    $('#complemento-id').val(user["complemento"]);
}

function getUser(id)
{
    $.ajax({
        url: $(location).attr('href') + 'getUser/' + id,
        type: 'GET',
        data: {id:id},
        dataType: 'JSON',
        success: function(data){
            if(data.success){
                var user = data.user;
                makeUserToEdit(user);
            }
            else{
                swal({
                    title: "Erro",
                    text: "Não foi Possivel Editar",
                    type: "error",
                    showConfirmButton: true
                });
            }
        }
    })
}

function editarUser(id){
    getUser(id);
}