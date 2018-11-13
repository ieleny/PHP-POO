// VARIAVEIS GLOBAIS
// Tempo para exibir o de alerta de sucesso em ms (0 = nao fecha)
var tempAlertSuccess = 5000;
var tempAlertError = 0; 
var tempAlertWarning = 0;
var tempAlertInfo = 0;

var lastTimeOut; // Guarda a ultima funcao em timeout

var ajaxConsulta;

var fullScreen;

function Paginacao(Pagina, NumPaginas, filtro,Sistema){
    $.ajax({        
        type:"POST",
        url: '../../Modulos/Ajax/AjaxPaginacao.php',
        cache: false,
        dataType: 'text',
        data: {'Pagina':Pagina,'NumPaginas':NumPaginas,'filtro':filtro,'Sistema':Sistema},
        success: function(data)
        {            
            $("#Paginacao").html(data);
        }
    });
}

// Modo full screen
function activeFullScreen(){
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
}

// Realizar logout da sessÃ£o de usuÃ¡rio
function logout() {
    $.ajax({
        type: "POST",
        url: '../Controller/logout.php',
        cache: false,
        dataType: 'text',
        data: {},
        error: function () {
            var msg = 'Houve um problema ao realizar o logout. Por favor, tente novamente!';
            printMessageWithTime(msg, 'danger', tempAlertError);
        },
        success: function (data) {
            if (data.includes('@GensysError:')) { // em caso de exception no PHP
                msg = '<strong>Falha! </strong>' + data.replace('@GensysError:', '');
                printMessageWithTime(msg, 'danger', tempAlertError);
            } else {
                window.location.replace("./Login.php");
            }
        }
    });
}

$("#btnCreate").click(function(){
//    $('#CamposForm').reset();
    loadAllRequiredInput();
});

// RETORNA HTML DE UM MODAL DE ALERTA
function getAlertModal(titulo, mensagem, functionsOnClick, nameBtn){
    return '<div class="modal fade" id="importItemModal" role="dialog" data-backdrop="static">\n\
                <div class="modal-dialog modal-sm">\n\
                    <div class="modal-content">\n\
                        <div class="modal-header">\n\
                            <button type="button" class="close" data-dismiss="modal">&times;</button>\n\
                            <h4 class="">' + titulo +'</h4>\n\
                        </div>\n\
                        <div class="modal-body">\n\
                            <p>' + mensagem + '</p>\n\
                        </div>\n\
                        <div class="modal-footer">\n\
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>\n\
                            <button type="button" class="btn btn-warning" onclick="' + functionsOnClick + '">' + nameBtn + '</button>\n\
                        </div>\n\
                    </div>\n\
                </div>\n\
            </div>';
}

// FUNCAO PARA EXIBIR ALERTA COM TEMPORIZADOR
function printMessageWithTime(msg, type, time){
    clearTimeout(lastTimeOut); // Apaga funcao de timeout caso exista
    // adiciona ao topo a mensagem com o efeito de fade
    $('#notify').html(getAlertMessage(msg, type));
    $("#msg-notify").hide();
    $("#msg-notify").fadeIn(200);
    if(time > 0){
        lastTimeOut = setTimeout(function(){
            $('#msg-notify').fadeOut(300, function(){
               $(this).remove();
           });
        }, time);
    }
}

// FUNCAO PARA ATRIBUIR "oninvalid" A TODOS INPUTS E SELECTS
$('body').ready(function(){
    loadOnInvalid();
});

function loadOnInvalid(){
    var inputs = $('input');
    for(var x = 0; x < inputs.length; x++){
        inputs[x].setAttribute('oninvalid', 'onInvalidInput(this)');
    }
    var selects = $('select');
    for(var x = 0; x < selects.length; x++){
        selects[x].setAttribute('oninvalid', 'onInvalidInput(this)');
    }
}

function loadGroupInputPhone(input, faType){
    var valueClass = 'fa fa-' + faType;
    input.setAttribute('type', 'tel');
    var copiaInput = input.cloneNode();
    var divPai = document.createElement('DIV');
    var divInput = document.createElement('DIV');
    divInput.setAttribute('class', 'input-group');
    var span = document.createElement('SPAN');
    span.setAttribute('class', 'input-group-addon');
    var i = document.createElement('I');
    i.setAttribute('class', valueClass);
    i.setAttribute('aria-hidden', 'true');
    span.appendChild(i);
    divInput.appendChild(span);
    divInput.append(copiaInput);
    divPai.appendChild(divInput);
    $(input).replaceWith(divPai.innerHTML);
    if(faType === 'mobile-phone'){
        $("#"+input.id).mask("(99)99999-9999");
        $("#"+input.id).attr('minlength', '14');
        $("#"+input.id).attr('placeholder', '(99)99999-9999');
    }else{
        $("#"+input.id).mask("(99)9999-9999");
        $("#"+input.id).attr('minlength', '13');
        $("#"+input.id).attr('placeholder', '(99)9999-9999');
    }
}

function loadGroupInputNumber(input, faType){
    var valueClass = 'fa fa-' + faType;
    input.setAttribute('type', 'number');
    input.setAttribute('step', '0.01');
    input.setAttribute('min', '0');
    var copiaInput = input.cloneNode();
    var divPai = document.createElement('DIV');
    var divInput = document.createElement('DIV');
    divInput.setAttribute('class', 'input-group');
    var span = document.createElement('SPAN');
    span.setAttribute('class', 'input-group-addon');
    var i = document.createElement('I');
    i.setAttribute('class', valueClass);
    i.setAttribute('aria-hidden', 'true');
    span.appendChild(i);
    divInput.appendChild(span);
    divInput.append(copiaInput);
    divPai.appendChild(divInput);
    $(input).replaceWith(divPai.innerHTML);
}

function loadGroupInputDay(input, faType){
    var valueClass = 'fa fa-' + faType;
    input.setAttribute('type', 'number');
    input.setAttribute('max', '31');
    input.setAttribute('min', '1');
    var copiaInput = input.cloneNode();
    var divPai = document.createElement('DIV');
    var divInput = document.createElement('DIV');
    divInput.setAttribute('class', 'input-group');
    var span = document.createElement('SPAN');
    span.setAttribute('class', 'input-group-addon');
    var i = document.createElement('I');
    i.setAttribute('class', valueClass);
    i.setAttribute('aria-hidden', 'true');
    span.appendChild(i);
    divInput.appendChild(span);
    divInput.append(copiaInput);
    divPai.appendChild(divInput);
    $(input).replaceWith(divPai.innerHTML);
}

function loadGroupInputDate(input, faType, type){
    var valueClass = 'fa fa-' + faType;
    input.setAttribute('type', type);
    var copiaInput = input.cloneNode();
    var divPai = document.createElement('DIV');
    var divInput = document.createElement('DIV');
    divInput.setAttribute('class', 'input-group');
    var span = document.createElement('SPAN');
    span.setAttribute('class', 'input-group-addon');
    var i = document.createElement('I');
    i.setAttribute('class', valueClass);
    i.setAttribute('aria-hidden', 'true');
    span.appendChild(i);
    divInput.appendChild(span);
    divInput.append(copiaInput);
    divPai.appendChild(divInput);
    $(input).replaceWith(divPai.innerHTML);
}

// $(document).ready(function(){
//     var inputMoney = document.querySelectorAll('input.input-money');
//     var inputPercent = document.querySelectorAll('input.input-percent');
//     var inputPhone = document.querySelectorAll('input.input-phone');
//     var inputMobilePhone = document.querySelectorAll('input.input-mobile-phone');
//     var inputFax = document.querySelectorAll('input.input-fax');
//     var inputDay = document.querySelectorAll('input.input-day');
//     var inputDate = document.querySelectorAll('input.input-date');
//     var inputDatetime = document.querySelectorAll('input.input-datetime');
//     for(var x = 0; x < inputMoney.length; x++){
//         loadGroupInputNumber(inputMoney[x], 'money');
//     }
//     for(var x = 0; x < inputPercent.length; x++){
//         loadGroupInputNumber(inputPercent[x], 'percent');
//     }
//     for(var x = 0; x < inputPhone.length; x++){
//         loadGroupInputPhone(inputPhone[x], 'phone');
//     }
//     for(var x = 0; x < inputMobilePhone.length; x++){
//         loadGroupInputPhone(inputMobilePhone[x], 'mobile-phone');
//     }
//     for(var x = 0; x < inputFax.length; x++){
//         loadGroupInputPhone(inputFax[x], 'fax');
//     }
//     for(var x = 0; x < inputDay.length; x++){
//         loadGroupInputDay(inputDay[x], 'calendar');
//     }
//     for(var x = 0; x < inputDate.length; x++){
//         loadGroupInputDate(inputDate[x], 'calendar', 'date');
//     }
//     for(var x = 0; x < inputDatetime.length; x++){
//         loadGroupInputDate(inputDatetime[x], 'calendar', 'datetime-local');
//     }
// });

// FUNCAO PARA CARREGAR AUTOMATICAMENTE O CODIGO DO PARTICIPANTE PARA TABELA CLIENTE E FORNECEDOR
function loadIdParticipante(numDoc, classe){
    if($("#codigoparticipante").val() !== ''){
        return;
    }
    $.ajax({
        type: "POST",
        url: "../../Modulos/Sessao/Controlador/Dispatcher.php",
        cache: false,
        dataType: 'text',
        data: {'classe':classe, 'acao':'getInsertIdParticipante', 'genericParams':numDoc},
        success: function(data){
            $("#codigoparticipante").val(data);
        }
    });
}

function getAlertMessage(message, type){
    // monta o css da mensagem para que fique flutuando na frente de todos elementos da pagina
    var cssMessage = "display: block; position: fixed; top: 35px; left: 20%; right: 20%; width: 50%; padding-top: 10px; z-index: 9999";
    var cssInner = "margin: 0 auto; box-shadow: 1px 1px 5px black;";
    // Retorna a div com a mensagem
    return '<div id="msg-notify" style="' + cssMessage + '">\n\
                <div class="alert alert-'+type+' alert-dismissable" style="'+cssInner+'">\n\
                    <a class="close" id="closeAlert" data-dismiss="alert" href="#">X</a>\n\
                    <span>' + message + '</span>\n\
                </div>\n\
            </div>';
}

// PARA ABRIR UM MODAL POR CIMA DE OUTRO
$(document).ready(function () {
    $(document).on('show.bs.modal', '.modal', function () {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
    $(document).on('hide.bs.modal', '.modal', function () {
        $('.modal').css({'overflow-y':'scroll', 'white-space':'nowrap'});
    });
});

function clearDataModal(form){
    $('#'+form).each(function(){
        $(this).find(':input').val('');
    });
}

// FUNCAO PARA CARREGAR ATRIBUTOS PARA UM INPUT OBRIGATORIO
function loadAllRequiredInput(){
    var inputText = document.getElementsByClassName('requiredText');
    var inputNumber = document.getElementsByClassName('requiredNumber');
    var inputEmail = document.getElementsByClassName('requiredEmail');
    var inputAlphanumeric = document.getElementsByClassName('requiredAlphanumeric');
    // Insere atributos nas tags de id = requiredText
    if(inputText.length){        
        for(var x = 0; x < inputText.length; x++){
            inputText[x].setAttribute('required', true);
            inputText[x].setAttribute('pattern', '[a-zA-Z\s]+$');
            inputText[x].setAttribute('title', 'Por favor, preencha apenas com letras.');
        }
    }
    // Insere atributos nas  tags de id = requiredNumber
    if(inputNumber.length){
        for(var x = 0; x < inputNumber.length; x++){
            inputNumber[x].setAttribute('required', true);
            inputNumber[x].setAttribute('pattern', '[0-9]+$');
            inputNumber[x].setAttribute('title', 'Por favor, preencha apenas com n&uacute;meros.');
        }
    }
    // Insere atributos nas  tags de id = requiredEmail
    if(inputEmail.length){
        for(var x = 0; x < inputEmail.length; x++){
            inputEmail[x].setAttribute('required', 'required');
            inputEmail[x].setAttribute('pattern', '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$');
            inputEmail[x].setAttribute('title', 'Por favor, preencha em um formato v&aacute;lido de e-mail.');
        }
    }
    // Insere atributos nas  tags de id = requiredAlphanumeric
    if(inputAlphanumeric.length){
        for(var x = 0; x < inputAlphanumeric.length; x++){
            inputAlphanumeric[x].setAttribute('required', 'required');
            inputAlphanumeric[x].setAttribute('pattern', '[a-zA-Z0-9\s]+$');
            inputAlphanumeric[x].setAttribute('title', 'Caracteres permitidos: n&uacute;meros, letras e espa&ccedil;os.');
        }
    }    
};

// FUNCAO PARA RECARREGAR UM COMBO BOX
function reloadCombo(campo,sessaoCombo, atributo, value){
    $.ajax({        
        type:"POST",
        url: '../../Modulos/Ajax/AjaxComboBox.php',
        cache: false,
        dataType: 'text',
        data: {'sessaoCombo':sessaoCombo,'atributo':atributo, 'value':value},
        success: function(data){
            var first = $('#'+campo).find('select').find('option')[0];
            $('#'+campo).find('select').html(data);
            $('#'+campo).find('select').prepend(first);
        },
        error: function(){
            printMessageWithTime("N&atilde;o foi poss&iacute;vel atualizar este combo box.", 'danger', tempAlertError);
        }
    });
}

//FUNCAO PARA OS INPUTS
function FuncaoGeralInput(id,NomeModal,Acao){
    //ENVIAR INFORMACOES PARA OS CAMPOS
    $('#acao').val(Acao);
    $('#id').val(id);
    $('.modal-title').html(NomeModal);
    //REMOVER A DESABILITACAO DOS INPUTS 
    /* $('input').removeAttr('readonly',false); */
    $('#salvar').show();
}

//FUNCAO QUE EXIBE UMA TELA INTERNA NA DIV 'page-content-wrapper'
function FuncaoTelaAnexa(acao,classe,idregistro){
    
    $("#LabelTitulo").html(classe);

    var PageUrl = "";
   //ATRIBUI A VARIAVEL "PageUrl" A NOVA URL DA PAGINA QUE SERIA ABERTA A DEPENDER DA ACAO
    if(acao==='create'){
        PageUrl = window.location.pathname+"itens"+"?registroID="+idregistro+"&acao=create";
    }else{
        if(acao==='update'){
        PageUrl = window.location.pathname+"itens"+"?registroID="+idregistro+"&acao=update";
        }else {
            //SE FOR ACAO "visualize":
            PageUrl = window.location.pathname+"itens"+"?registroID="+idregistro+"&acao=visualize"; 
        }
    }
    AjaxChamarTelaAnexa(acao,classe,idregistro,PageUrl);
    
}
function AjaxChamarTelaAnexa(acao,classe,idregistro,PageUrl){
    $.ajax({        
        type:"POST",
        url: "../../Modulos/Ajax/AjaxTelaAnexa.php",
        cache: false,
        dataType: 'text',
        data: {'acao':acao ,'classe':classe,'idregistro':idregistro},
        success: function(data){
            //MUDA A URL DA PAGINA:
            window.history.pushState(null, null, PageUrl);
            //MUDA O CONTEUDO DA DIV '#page-content-wrapper' PARA A NOVA PAGINA RETORNADA NO 'AjaxTelaAnexa.php'
            $('#content').hide(210, function(){
                $('#content').html(data);
                $('#content').show(210);
            });
        },
        error: function(){
            printMessageWithTime("Não foi possível encontrar os dados solicitados.", 'danger', tempAlertError);
        }
    });
}

// FUNCAOO PARA EXIBIR UMA ABA DE MODAL
function showTab(idAba){
    if(!idAba)
        return;
    // DESATIVA A ABA EM EXIBICAO
    $('li.active').removeClass('active');
    $('a[aria-expanded="true"]').attr('aria-expanded', 'false');
    $('div.tab-pane.fade.in.active').removeClass('in active');
    // ATIVA A NOVA ABA
    $('#'+idAba).addClass('in active');
    $('a[href="#'+idAba+'"]').parent('li').addClass('active');
    $('a[href="'+idAba+'"]').attr('aria-expanded', 'true');;
}

// FUNCAO PARA EXIBIR MENSAGEM DE ERRO EM INPUT INVALIDO
function onInvalidInput(input){
    if($("#CamposForm").find('#' + input.id).length){
        var idAba = $(input).closest('.tab-pane').attr('id');
        showTab(idAba);
        var msg = 'N&atilde;o foi poss&iacute;vel salvar! Por favor, preencha corretamente o campo requerido.';
        printMessageWithTime(msg, 'danger', tempAlertError);
    }
}

function AjaxManipulacoDados(classe, recno, acao){
    return $.ajax({           
        type:"POST",
        url: '../../Modulos/Sessao/Controlador/Dispatcher.php',
        cache: false,
        dataType: 'text',
        data: {'acao':acao,'recno':recno,'classe':classe,'form':$("#CamposForm").serializeArray()},
        error: function(){
            var msg = 'Houve um problema no envio dos dados. Por favor, tente novamente!';
            printMessageWithTime(msg, 'danger', tempAlertError);
        },
        success: function(data){
            if(data.includes('@GensysError:')){
                var msg = data.replace('@GensysError:', '');
                printMessageWithTime(msg, 'danger', tempAlertError);
            }else{
                if(acao === 'delete'){
                    $('#msg-notify').remove();
                    $('#btnDeleteModal').remove();
                    $('#closeModalDelete').attr('onclick', 'location.reload()');
                    $('#btnCancelarDelete').attr('onclick', 'location.reload()');
                    $('#btnCancelarDelete').text('Fechar');
                    $('#deleteModal .modal-body').css('background-color','#d4edda');
                    $('#pBodyModalDelete').html('A&ccedil;&atilde;o realizada com sucesso!');
                    $('#pBodyModalDelete').css('color','#155724');
                }else if(acao === 'create'){
                    $('#saveModal').modal('show');
                    $('#btnAddSaveModal').click(function(){
                        resetModal('#Modal');
                        $('#saveModal').modal('hide');
                    });
                    $('#btnEditSaveModal').click(function(){
                        $("#id").val((acao === 'update') ? recno : data);
                        $("#acao").val('update');
                        $('#saveModal').modal('hide');
                    });
                    $('#btnCloseSaveModal').click(function(){
                        location.reload();
                    });
                }else if(acao === 'update'){
                    printMessageWithTime('A&ccedil;&atilde;o realizada com sucesso!', 'success', tempAlertSuccess);
                }
            }
        }
    });
}
//FUNCAO ALTERNATIVA PARA PERSONALIZAR A FUNCAO DE SUCCESS:
function CustomAjaxManipulacoDados(classe, recno, acao){
    return $.ajax({           
        type:"POST",
        url: '../../Modulos/Sessao/Controlador/Dispatcher.php',
        cache: false,
        dataType: 'text',
        data: {'acao':acao,'recno':recno,'classe':classe,'form':$("#CamposForm").serializeArray()},
        error: function(){
            var msg = 'Houve um problema no envio dos dados. Por favor, tente novamente!';
            printMessageWithTime(msg, 'danger', tempAlertError);
        }
    });
}
//FUNCAO PARA ZERAR TODOS OS CAMPOS DA MODAL REFERENCIADA PELO ID (idmodal)
function resetModal(idmodal){
    $(idmodal).find('input').val('');
    $(idmodal).find('select').val('');
    $(idmodal).find('textarea').val('');
    $(idmodal).find('table tbody').html('');
}

function resetModalItensMovimento(idmodal,campo_preco) {
    $('#id_estoque').val('').trigger('chosen:updated');
    $(idmodal).find('#desconto').val('');
    $(idmodal).find('#saldo').val('0.00');
    $(idmodal).find('#vldesconto').val('');
    $(idmodal).find(campo_preco).val('');
    $(idmodal).find('#total').val('');
}

// FUNï¿½ï¿½O PARA Dï¿½ STOP NO EVENTO DO SUBMIT DO FORMULï¿½RIO DE BUSCA DO MODAL CLIENTE (PARA A Pï¿½GINA Nï¿½O SER REDIRECIONADA)
$('body').delegate("form",'submit',function(e){
    e.preventDefault();
});

//FUNï¿½ï¿½O PARA CONSULTAR O BANCO DE DADOS
function AjaxConsulta(recno,classe,acao){
    var form = $("#CamposForm").serializeArray();
    ajaxConsulta = $.ajax({
        type:"POST",
        url: "../../Modulos/Sessao/Controlador/Dispatcher.php",
        cache: false,
        dataType: 'json',
        async: false,
        data: {'form':form,'classe': classe,'recno':recno,'acao':acao},
        success: function(data){
            if(data['erro'] && data.erro.includes('@GensysError:')){
                var msg = 'N&atilde;o foi poss&iacute;vel recuperar os dados desse registro. ';
                printMessageWithTime(msg + data.erro.replace('@GensysError:', ''), 'danger', tempAlertError);
            }else{
                //VARIAVEL
                //FUNï¿½ï¿½O FOR EACH PARA RELACIONAR O ARRAY VALORES A COLUNA NAME
                form.forEach(function(coluna,indice){
                    $('#'+coluna.name).val(data[indice]);
                });
                //DESABILITAR PARA VISUALIZAR
                if(acao === 'retrieveByRecno'){
                    //DESABILITAR TODOS OS INPUTS E SELECTS
                    $('.input-sm').attr('readonly', true);
                    $('select').attr('disabled', true);
                    $('textarea').attr('disabled', true);
                    $('.input-sm').css('background-color', 'white');
                    $('textarea').css('background-color', 'white');
                    $('#salvar').hide();
                }else{
                    $('select').removeAttr('disabled');
                    $('textarea').removeAttr('disabled', true);
                    $('#salvar').show();
                }
            }
        }, error: function(data){
            printMessageWithTime(data.responseText, 'danger', tempAlertError);
        }
    });
}

//FUNCAO PARA QUE OS CAMPOS SEJAM DESABILITADOS
function GerarCamposForm(names,values){
        //FOR PARA INSERIR FAZER A CONSULTA
        for(var i=0; i < names.length;i++){
            //ENVIAR OS DADOS PARA OS CAMPOS
            $('#'+names[i]).val(values[i]);
        }

}

//Filtro Geral
function FiltrarForm(frm, sistema){
    if (frm.txtFiltro.value === ""){
            alert("Digite filtro para busca.");
            frm.txtFiltro.focus();
            frm.txtFiltro.style.backgroundColor='#B9DCFF';
            return false;
    }
    frm.action = "?filtro="+frm.txtFiltro.value;
    frm.submit();
}

function TodosForm(frm, sistema){

    $.ajax({
        type:"POST",
        url:"index.php",
        cache: false,
        dataType: 'text',
        data: {'filtro':null},
        error: function(data){
            frm.submit();
        },
        success: function(data){
            //PARA DAR REFRESH NA PAGINA DEPOIS QUE SALVA
            frm.action = "./" + sistema;
            frm.submit();
        }

    });
}

function TodosFormInternas(frm, sistema){

    $.ajax({
        type:"POST",
        url:"AberturaNovaJanelaModal.php",
        cache: false,
        dataType: 'text',
        data: {'filtro':null},
        error: function(data){
            alert('Erro ao realizar a a&ccedil;ao.');
            frm.action = "AberturaNovaJanelaModal.php?pagina=1&Sistema="+sistema;
            frm.submit();
        },
        success: function(data){
            //PARA DAR REFRESH NA PAGINA DEPOIS QUE SALVA
            frm.txtFiltro.value = '';
            frm.action = "AberturaNovaJanelaModal.php?pagina=1&Sistema="+sistema;
            frm.submit();
        }

    });
}

function Filtrar(filtro,sistema){
    filtro.action = "?filtro="+filtro;
}

//CRIAR AJAX PARA REDIRECIONAR NO SUBMIT
function AjaxInserirCodigo(empresa){
    $.ajax({
        type:"POST",
        url: '../../Modulos/Ajax/AjaxInserirCodigo.php',
        cache: false,
        dataType: 'text',
        data: {'empresa':empresa},
        success: function(data){
            $('#codigo').val(data);
        }
     });
}

//CONSULTA AJAX DE MULTIPLAS TABELAS
function AjaxLista(recno,classe,lista,tabela,acao,IdPrecoHora,Valor,Campos,QuantidadeCampos){
    $.ajax({
        type:"POST",
        url: "../../Modulos/Ajax/AjaxListaItens.php",
        cache: false,
        dataType: 'text',
        data: {'classe': classe,'recno':recno,'tabela':tabela,'lista':lista,'acao':acao,'IdPrecoHora':IdPrecoHora,'valor':Valor,'campos':Campos,'QuantidadeCampos':QuantidadeCampos},
        success: function(data){
            if(acao === 'consultaDoItem'){
                var inputs = Valor.split(",");
                var resultado = data.split("?");
                resultado.forEach(function(valor,index){
                   $("#"+inputs[index]).val(valor);
                });
                ValorArray = IdPrecoHora;
                FuncaoHideShowCampos(lista);
            }else{
               $("#"+lista).html(data);
            }

        }
    });
}

//FUNCAO QUE MOSTRAR E OCULTA OS BUTï¿½ES DEPENDENDO DA CONSULTA
function FuncaoHideShowCampos(consulta){

    if(consulta === 'ConsultaDoItemPrecoHora'){
        $("#inserirPrecoHora").hide();
        $("#EditarPrecoHora2").show();
    }
    if(consulta === 'ConsultaDoItemUnidade'){
        $("#EditarUnidadeRelacional2").show();
        $("#inserirUnidadeRelacional").hide();
        $('#UnidadeRelacional').show();
    }
    if(consulta === 'ConsultaDoItemGrade'){
        $("#inserirGrade").hide();
        $("#EditarGrade2").show();
    }
}

//CONSULTA AJAX PARA CAMPOS 
function AjaxConsultaCampo(informacoes,campo,valor){
    $.ajax({
        type:'POST',
        url:'../../Modulos/Ajax/AjaxConsulta.php',
        cache: false,
        dataType: 'text',
        data: {'informacoes': informacoes,'campo':campo,'valor':valor},
        success: function(data){
            $("#"+campo).val(data);
        }
    }); 
}

//CONSULTA AJAX QUE CRIAR UM COMBO
function AjaxCriarCombo(campo,valor,pagina,NomeCombo,value,campoQuery){
    $.ajax({
        type:'POST',
        url:'../../Modulos/Ajax/AjaxCriarCombo.php',
        cache: false,
        dataType: 'text',
        data: {'campo': campo,'valor':valor,'pagina': pagina,'NomeCombo':NomeCombo,'value':value,'campoQuery':campoQuery},
        success: function(data){
            $("#"+campo).html(data);
        }
    }); 
}

function AjaxCarregarCombo(tipo,text){
    return $.ajax({
        type:'POST',
        url:'../../Modulos/Ajax/AjaxCarregarCombo.php',
        cache: false,
        dataType: 'text',
        asynch: false,
        data: {'tipo':tipo, 'text':text}
    }); 
}
function AjaxCarregarComboSelected(tipo,text,id){
    return $.ajax({
        type:'POST',
        url:'../../Modulos/Ajax/AjaxCarregarComboSelected.php',
        cache: false,
        dataType: 'text',
        asynch: false,
        data: {'tipo':tipo, 'text':text, 'id':id}
    }); 
}

function AjaxCarregamento(tabela,campo,id,valorId){
    return $.ajax({
        type:'POST',
        url:'../../Modulos/Ajax/AjaxCarregamento.php',
        cache: false,
        dataType: 'text',
        data: {'tabela':tabela,'campo':campo,'id':id,'valorId':valorId}
    });
}
 
function AjaxCarregarData(){
    return $.ajax({
        type:'POST',
        url:'../../Modulos/Ajax/AjaxCarregarData.php',
        data:{}
    });
    }
function AjaxRetornarComboCredor(){
    return $.ajax({
        type:'POST',
        url:'../../Modulos/Ajax/AjaxRetornarComboCredor.php',
        cache: false,
        dataType:'text',
        data:{}
    });
    }
function AjaxCarregarDoc(classe,id_empresa){
    return $.ajax({
        type:'POST',
        url:"../../Modulos/Sessao/Controlador/Dispatcher.php",
        cache: false,
        dataType: 'text',
        data: {'genericParams':id_empresa,'classe':classe,'acao':'getNumeroDocumento'}
    }); 
}

function AjaxGrupoConfiguracao(id){
    if(id == " "){
       $('#viewgp').removeAttr("data-target");
       $('#viewgp').attr("title","Selecione uma configuraÃ§Ã£o para visualizar");
   }else{
        $('#viewgp').attr("data-target","#grupoconfiguracaoModal");
        $('#viewgp').attr("title","Clique aqui para Visualizar as ConfiguraÃ§Ãµes");
    }

  $.ajax({
      type:'POST',
      url:'../../Modulos/Ajax/AjaxGrupoConfiguracao.php',
      cache:false,
      dataType:'json',
      data:{'id':id},
      success: function(data) {

          $('#tributaria').val(data['tributaria']);
          $('#icms').val(data['icms']);
          $('#tributariasimples').val(data['tributariasimples']);
          $('#classificacaofiscal').val(data['classificacaofiscal']);
          $('#reducaobase').val(data['reducaobase']);
          $('#mva').val(data['mva']);
          $('#piscst').val(data['piscst']);
          $('#piscstcompra').val(data['piscstcompra']);
          $('#naturezaVendaDentro').val(data['naturezaVendaDentro']);
          $('#naturezaVendaFora').val(data['naturezaVendaFora']);
          $('#naturezaCompraDentro').val(data['naturezaCompraDentro']);
          $('#naturezaCompraFora').val(data['naturezaCompraFora']);
          $('#naturezaClienteDentro').val(data['naturezaClienteDentro']);
          $('#naturezaClienteFora').val(data['naturezaClienteFora']);
          $('#naturezaFornecedorDentro').val(data['naturezaFornecedorDentro']);
          $('#naturezaFornecedorFora').val(data['naturezaFornecedorFora']);
          $('#naturezatransferenciaDentro').val(data['naturezatransferenciaDentro']);
          $('#naturezatransferenciaFora').val(data['naturezatransferenciaFora']);

      }

  })
}

//MANIPULACAO DE DADOS DA INSERCAO DO CABEÃ‡ALHO DAS TELAS DO MOVIMENTO
function manipulaDadosHeader(classe,id,acao,classe_tela_anexa){
    var Ajax = AjaxManipulacoDados(classe,id,acao);
    if(acao === 'create'){
        Ajax.success(function(data){
           $('#Modal').modal('hide');
           FuncaoTelaAnexa('create',classe_tela_anexa,data);
        });   
    }
}

$(document).ready(function(){
    var labels = document.querySelectorAll("label");
    var tr = document.querySelectorAll("td");
    var span = document.querySelectorAll("span");
    setTitle(labels);
    setTitle(tr);
    setTitle(span);

    function setTitle(campo){
        for (var i = 0; i < campo.length; i++) {
            var valor = $(campo[i]).text();
            $(campo[i]).attr("title",valor);
        }
    }
});

function AjaxGerarPreview(classe,indice){
    $.ajax({
        type:'POST',
        url: '../../Modulos/Ajax/AjaxGerarPDFGeral.php',
        cache: false,
        dataType: 'text',
        data: {'classe':classe,'indice':indice},
        success: function(data){
            window.open(data, '_blank', '');
            //$('#geracaoPDF').attr('src',data); 
        }
    }); 
}


