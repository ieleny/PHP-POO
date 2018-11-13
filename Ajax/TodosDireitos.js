$('#salvarDireitos').click(function(){
    saveDireitos();
}); 

function loadDireitos(classe){
    var ajax = loadCheckBoxTree('getDireitos1', '', classe);
    ajax.success(function(data){
        if(!data.includes('@GensysError:')){
            addToList(JSON.parse(data), null); 
        }
    });
}

// TRANSFORMA INPUTS EM UM ARRAY DE VALORES
function inputsToArray(inputs){
    var values = new Array();
    for(var x = 0; x < inputs.length; x++){
        values[x] = inputs[x].value;
    }
    return values;
}

// DEFINE SE UM INPUT FOI MODIFICADO E DEVE SER SALVO
function onClickCheckNode(input){
    if($(input).hasClass('save'))
        $(input).removeClass('save');
    else
        $(input).addClass('save');
}

// SALVA TODOS DIREITOS MODIFICADOS
function saveDireitos(){
    var inserts = $('#direitosForm input[type="checkbox"]:checked.save');
    var deletes = $('#direitosForm input[type="checkbox"].save').not(':checked');
    if(inserts.length > 0){
        var ajaxInsert = loadCheckBoxTree('addDireitos', inputsToArray(inserts), $('#direitoClass').val());
        ajaxInsert.success(function(data){
            console.log(data);
            if(data.includes('@GensysError:')){
                var msg = data.replace('@GensysError:', '');
                printMessageWithTime(msg, 'danger', tempAlertError);
            }else{
                printMessageWithTime('Ação realizada com sucesso!', 'success', tempAlertSuccess);
            }
        });
    }
    if(deletes.length > 0){
        var ajaxDelete = loadCheckBoxTree('removeDireitos', inputsToArray(deletes), $('#direitoClass').val());
        ajaxDelete.success(function(data){
            if(data.includes('@GensysError:')){
                var msg = data.replace('@GensysError:', '');
                printMessageWithTime(msg, 'danger', tempAlertError);
            }else{
                printMessageWithTime('Ação realizada com sucesso!', 'success', tempAlertSuccess);
            }
        });
    }
}

// Carrega uma lista de direitos
function loadCheckBoxTree(acao, genericParams, classe){
    return $.ajax({
        type:"POST",
        url:"../../Modulos/Sessao/Controlador/Dispatcher.php",
        cache: false,
        data: {'acao':acao, 'genericParams': genericParams, 'classe':classe}
    });
}

// Carrega listas e inputs para adicionar em uma �rvore
function extendSubTree(parents){
    var array = parents.split(',');
    var acao = 'getDireitos' + (array.length + 1).toString();
    var ajax = loadCheckBoxTree(acao, parents, $('#direitoClass').val());
    ajax.success(function(data){
        console.log(data);
        if(!data.includes('@GensysError:')){
            if(acao === 'getDireitos3' || acao === 'getDireitos4'){
                var retorno = JSON.parse(data);
                var names = getSubTreeNames(retorno.notInput);
                addToList(names, array[0]); 
                addInput(retorno.input, array[0]);
            }else{
                addToList(JSON.parse(data), array[0]); 
            }
        }else{
        }
    });
}

function getSubTreeNames(json){
    var names = new Array();
    for(var x = 0; x < json.length; x++){
        names[x] = json[x].name;
    }
    return names;
}