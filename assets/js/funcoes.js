function buscaAgendamento(){
    var data = {
        metodo: 'buscaAgendamentos'
        };
    $.ajax({
        url: 'metodos.php',
        type: 'POST',
        async: false,
        data:data,
        success: function (retorno) {           
            $("#agendamentos").html(retorno);
        },
        error: function (erro){
                
            }
        });
}
function ConcluirAtendimento(id){
    Swal.fire({
        title: "Concluir",
        text: "Você deseja concluir esse atendimento?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim"
      }).then((result) => {
        if (result.isConfirmed) {
            var data = {
                metodo: 'concluirAgendamentos',
                id:id
                };
            $.ajax({
                url: 'metodos.php',
                type: 'POST',
                async: false,
                data:data,
                success: function (retorno) { 
                    if(retorno  == 1){
                        buscaAgendamento();
                        Swal.fire({
                            title: "Concluido!",
                            text: "Atendimento concluido com sucesso.",
                            icon: "success"
                        });
                    }          
                   
                },
                error: function (erro){
                        
                }
            });
        }
      });
    return;
}
function cancelarAgendamento(id){
    Swal.fire({
        title: "Concluir",
        text: "Você deseja concluir esse atendimento?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim"
        }).then((result) => {
        if (result.isConfirmed) {
            var data = {
                metodo: 'cancelarAgendamentos',
                id:id
                };
            $.ajax({
                url: 'metodos.php',
                type: 'POST',
                async: false,
                data:data,
                success: function (retorno) { 
                    if(retorno  == 1){
                        buscaAgendamento();
                        Swal.fire({
                            title: "Cancelado!",
                            text: "Atendimento Cancelado com sucesso.",
                            icon: "success"
                        });
                    }          
                    
                },
                error: function (erro){
                        
                }
            });
        }
        });
    return;
}
function logar(){
    var data = {
        usuario: $("#usuario").val(),
        senha:$("#senha").val()
        };
    $.ajax({
        url: 'logar.php',
        type: 'POST',
        async: false,
        data:data,
        success: function (retorno) { 
            if(retorno == '') {                
                window.location.href='dashboard.php';
            }else{
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: retorno,
                  });
            }        
        },
        error: function (erro){
                
            }
        });
}
function listarClientes(){
    var data = {
        metodo: 'listarClientes'
        };
    $.ajax({
        url: 'metodos.php',
        type: 'POST',
        async: false,
        data:data,
        success: function (retorno) {      
            $("#clientes").html(retorno);
        },
        error: function (erro){
                
            }
        });
}
function listarServicos(){
    var data = {
        metodo: 'listarServicos'
        };
    $.ajax({
        url: 'metodos.php',
        type: 'POST',
        async: false,
        data:data,
        success: function (retorno) {           
            $("#servicos").html(retorno);
        },
        error: function (erro){
                
            }
        });
}
function listarProfissionais(){
    var data = {
        metodo: 'listarProfissionais'
        };
    $.ajax({
        url: 'metodos.php',
        type: 'POST',
        async: false,
        data:data,
        success: function (retorno) {           
            $("#profissionais").html(retorno);
        },
        error: function (erro){
                
            }
        });
}
function buscaHorarioDisponivel(){
    if($("#dataAgendamento").val() == ''){
        $("#profissionais").val('');
        Swal.fire({
            icon: "error",
            title: "Atenção!",
            text: "Você precisa selecionar uma data antes de selecionar o barbeiro!",
        });
        return false;
    }
    var data = {
        metodo: 'horarioDisponivel',
        idProfissional:$("#profissionais").val(),
        dataSelecionada:$("#dataAgendamento").val(),
        };
    $.ajax({
        url: 'metodos.php',
        type: 'POST',
        async: false,
        data:data,
        success: function (retorno) {
            $("#horaInicio").html(retorno);
        },
        error: function (erro){
                
            }
        });
}
function validaObrigatorios(idFormulario) {       
    var contaVazios = 0;
    $("#"+idFormulario).find(".obrigatorio").each(function(){
        if (this.value == '') {
          contaVazios++;
          $(this).css('border','1px solid #ff0a0a');
          
        }else{
          $(this).css('border','1px solid green');
        }
    });
      
      
    if (contaVazios > 0) {
        $(this).css('border','1px solid #ff0a0a');
        Swal.fire({
            icon: "error",
            title: "Atenção!",
            text: "Você precisa preencher todos os campos obrigatórios!",
        });
      return false;
    
    }else{
        agendar(idFormulario);
    }
  }

function agendar(formulario){
    var form = $('#'+formulario).val(this);
    var formdata = false;

    if (window.FormData){
        formdata = new FormData(form[0]);
    }

    $.ajax({
        url: 'metodos.php',
        type: 'POST',
        data: formdata ? formdata : form.serialize(),
        cache: false,
        contentType: false,
        processData: false,
        success: function(result) {
            if(result == 1){
                    $('#'+formulario+ " input[type=date]").val("");
                    $('#'+formulario+' select').val("");
                    $('#'+formulario+ " input[type=text]").val("");
                    
                    Swal.fire({
                        icon: "success",
                        title: "Atenção!",
                        text: "Cadastro realizado com sucesso!",
                    });
                    
                }else if (result == 0){
                    
                    Swal.fire({
                        icon: "error",
                        title: "Atenção!",
                        text: "Erro no cadastro tente novamente!",
                    });
                }
                else{
                  alert(data);
                }
        }
    });
    return false;

}
function limpaCampos(){
    $('#profissionais').val('');
    $("#horaInicio").html('');

}
function buscaComissoes(){
    $("#comissoes").html('');
    var data = {
        metodo: 'calcularComissao',
        idProfissional:$("#profissionais").val(),
        dataSelecionada:$("#dataComissao").val(),
        };
    $.ajax({
        url: 'metodos.php',
        type: 'POST',
        async: false,
        data:data,
        success: function (retorno) {
            $("#comissoes").html(retorno);
        },
        error: function (erro){
                
            }
        });
}
function calculaComissoes(){
    $("#comissoes").html('');
    var data = {
        metodo: 'calcularComissao',
        idProfissional:$("#profissionais").val(),
        dataSelecionada:$("#dataComissao").val(),
        };
    $.ajax({
        url: 'metodos.php',
        type: 'POST',
        async: false,
        data:data,
        success: function (retorno) {
            $("#comissoes").html(retorno);
        },
        error: function (erro){
                
            }
        });
}
function buscaClientes(){
    var data = {
        metodo: 'buscaClientes'
        };
    $.ajax({
        url: 'metodos.php',
        type: 'POST',
        async: false,
        data:data,
        success: function (retorno) {           
            $("#tabelaClientes").html(retorno);
        },
        error: function (erro){
                
            }
        });
}