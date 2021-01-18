
<?php
session_start();

require 'functions.php';
require '../connect/connect.php';

foreach ($_POST as $key => $value){
    echo "{$key} = {$value}\r\n";
}

//Ambinete de Keep Value
$etapa = $_SESSION['etapa'];

//retornar ao inicio
 $retornar = $_POST['retornar'];	

if($etapa == 1){
    $_SESSION["count"]=1;
    //Destruir valor a selecionar campos escondidos (linha133)
    if(isset($_POST['tipo_de_cliente'])){
        $_SESSION['tipo_de_cliente']='1';
        $_SESSION['checkbox_Client']='checked';			
        //Mantem checado						 
        // verifica se já tem cliente
        if(!isset($_POST['cliente_id'])){
            //Não foi selecionado um cliente
            $cliente_id = "";            
        }else{
            //Cliente selecionado seta varivel par ao stament
            $cliente_id = mysqli_real_escape_string($link, $_POST['cliente_id']);
            #$_SESSION['cliente_id']=$cliente_id;
        }
    }else{
        $_SESSION['tipo_de_cliente']='0';
        $_SESSION['checkbox_Client']='';		
        //Caso checkbox desmarcado cadastrar o cliente
        $cliente_nome = mysqli_real_escape_string($link, $_POST['cliente_nome']);
        $_SESSION['cliente_nome']=$cliente_nome;
        $cliente_site = mysqli_real_escape_string($link, $_POST['cliente_site']);
        $_SESSION['cliente_site']=$cliente_site;
        $cliente_responsavel = mysqli_real_escape_string($link, $_POST['cliente_responsavel']);
        $_SESSION['cliente_responsavel']=$cliente_responsavel;
        $cliente_logo = $_FILES['cliente_logo'];
        $_SESSION['cliente_logo']=$cliente_logo;
        
        if(isset($_POST['newClient'])){
            unset($_SESSION['cliente_nome']);
            unset($_SESSION['cliente_site']);
            unset($_SESSION['cliente_responsavel']);
            unset($_SESSION['cliente_logo']);
            unset($_SESSION['cliente_id']);

            $cliente_nome='';
            $cliente_site='';
            $cliente_responsavel ='';
            $cliente_logo ='';
        }
        if($_SESSION['cliente_id']>1){
            $cliente_id=$_SESSION['cliente_id'];
        }elseif((strlen($cliente_nome))>1){
            $cliente_id = add_cliente($cliente_nome, $cliente_site, $cliente_responsavel, $cliente_logo);
        }else{
            $cliente_id=0;
        }
        #$_SESSION['cliente_id'] = $cliente_id;
    }    
    
    // Pega dados gerais
    $evento_nome = mysqli_real_escape_string($link, $_POST['evento_nome']);
    $_SESSION['evento_nome']=$evento_nome;
    $evento_data = mysqli_real_escape_string($link, $_POST['evento_data']);
    $_SESSION['evento_data']=$evento_data;
    $evento_hora = mysqli_real_escape_string($link, $_POST['evento_hora']);
    $_SESSION['evento_hora']=$evento_hora;
    
    $_SESSION['msg'] = strlen($evento_nome)>1;
    $_SESSION['cliente_id']=$cliente_id;

    if(isset($_POST['newEvent'])){
        unset($_SESSION['evento_nome']);
        unset($_SESSION['evento_data']);
        unset($_SESSION['evento_hora']);
        unset($_SESSION['evento_id']);

        $evento_nome='';
        $evento_data='';
        $evento_hora='';
    }

    // insere o novo evento e retorna id
    if((strlen($evento_nome))>1){
        if($_SESSION['evento_id']==0){
            $evento_id = add_evento($cliente_id, $evento_nome, $evento_data, $evento_hora);
            $_SESSION['evento_id'] = $evento_id;
            $_SESSION['msg']='Atribuindo ID';
        }else{            
             $evento_id=$_SESSION['evento_id'];
             $_SESSION['msg']= $_SESSION['evento_id']."***".$evento_id;
             replace_evento($cliente_id, $evento_nome, $evento_data, $evento_hora, $evento_id);
        }
    }
    
    // muda etapa e redireciona conforme q validade dos dados
    if($evento_id=="" || ((strlen($evento_nome))<1) || ($cliente_id<1)){

        $_SESSION['invalid']=1;
        $_SESSION['etapa'] = 1;     
    }else{
        $_SESSION['etapa'] = 2;
        $_SESSION['fail'] = 0;
    }
}
# Fecha Etapa 1
// Adiciona convidados e personalização
# Abre Etapa 2
if($etapa == 2){    

    $evento_id = $_SESSION['evento_id'];

    $get_convidados = get_convidados($evento_id);
    $_SESSION['list_convidados'] = array();
    
    $i = 0;
    if ($get_convidados->num_rows > 0) {
        while($row = $get_convidados->fetch_assoc()) { 
            $_SESSION['list_convidados'][$i] = $row;
            $i++;
        }
    }    
    
    if(!isset($_GET['f'])){
        $f = "";
    } else{
        $f = mysqli_real_escape_string($link, $_GET['f']);
    }
    if($f == 'add'){
        $convidados_nome = mysqli_real_escape_string($link, $_POST['convidados_nome']);
        $convidados_curriculo = mysqli_real_escape_string($link, $_POST['convidados_curriculo']);
        $convidados_bio = mysqli_real_escape_string($link, $_POST['convidados_bio']);
        $convidados_foto = $_FILES['convidados_foto'];
        $add_convidado = add_convidado($evento_id, $convidados_nome, $convidados_curriculo, $convidados_bio, $convidados_foto);
        if($add_convidado == 1){
            $get_convidados = get_convidados($evento_id);
            $_SESSION['list_convidados'] = array();
            
            $i = 0;
            if ($get_convidados->num_rows > 0) {
                while($row = $get_convidados->fetch_assoc()) { 
                    $_SESSION['list_convidados'][$i] = $row;
                    $i++;
                }
            }
        }
        
    } else if($f == 'edit'){
        $edit_convidados_nome = mysqli_real_escape_string($link, $_POST['edit_convidados_nome']);
        $edit_convidados_curriculo = mysqli_real_escape_string($link, $_POST['edit_convidados_curriculo']);
        $edit_convidados_bio = mysqli_real_escape_string($link, $_POST['edit_convidados_bio']);
        $edit_convidados_id = mysqli_real_escape_string($link, $_POST['edit_convidados_id']);
        if($_FILES['edit_convidados_foto']['size'] == 0){
            $edit_convidados_foto = 0;
        } else {
            $edit_convidados_foto = $_FILES['edit_convidados_foto'];
        }
        $edit_convidado = edit_convidado($edit_convidados_id, $edit_convidados_nome, $edit_convidados_curriculo, $edit_convidados_foto, $edit_convidados_bio);
        if($edit_convidado == 1){
            $get_convidados = get_convidados($evento_id);
            $_SESSION['list_convidados'] = array();
            
            $i = 0;
            if ($get_convidados->num_rows > 0) {
                while($row = $get_convidados->fetch_assoc()) { 
                    $_SESSION['list_convidados'][$i] = $row;
                    $i++;
                }
            }
        }
        
    } else if($f == 'del'){
        $del_convidados_id = mysqli_real_escape_string($link, $_POST['del_convidados_id']);
        $del_convidado = del_convidado($del_convidados_id);
        if($del_convidado == 1){
            $get_convidados = get_convidados($evento_id);
            $_SESSION['list_convidados'] = array();
            
            $i = 0;
            if ($get_convidados->num_rows > 0) {
                while($row = $get_convidados->fetch_assoc()) { 
                    $_SESSION['list_convidados'][$i] = $row;
                    $i++;
                }
            }
        }
    } else {
        $personalizacao_bg = $_FILES['personalizacao_bg'];
        $personalizacao_logo = $_FILES['personalizacao_logo'];
        $personalizacao_cor1 = mysqli_real_escape_string($link, $_POST['personalizacao_cor1']);
        $personalizacao_cor2 = mysqli_real_escape_string($link, $_POST['personalizacao_cor2']);

        // var_dump($_SESSION);

        if((isset($_POST['tipo_de_convidados'])) && (count($_SESSION['list_convidados'])>0)){
            $tipo_de_convidados = mysqli_real_escape_string($link, $_POST['tipo_de_convidados']);
        } else {
            $tipo_de_convidados = 0;
        }
        $add_personalizacao = add_personalizacao($evento_id, $personalizacao_bg, $personalizacao_logo, $personalizacao_cor1, $personalizacao_cor2, $tipo_de_convidados);
        if($add_personalizacao == 1){
            if($retornar =="1"){
                $_SESSION['etapa']=$_SESSION['etapa']-1;
                #$_SESSION['msg']=$_SESSION['etapa']."retornar";      
                header('Location: ../install/');
            }
            else{
                $_SESSION['etapa'] = 3;
                //unset($_SESSION['list_convidados']);
                $evento_id = $_SESSION['evento_id'];
                $result  = get_config($evento_id);
                $insert_linha_configuracao = insert_linha_configuracao($evento_id, $result);
            }           
            
        }
    }
}

if($etapa == 3){
    $evento_id = $_SESSION['evento_id'];
    #$insert_linha_configuracao = insert_linha_configuracao($evento_id);
    
    if(!isset($_GET['f'])){
        $f = "";
    } else{
        $f = mysqli_real_escape_string($link, $_GET['f']);
	}

    if(isset($_POST['interacao_perguntas'])){
        $interacao_perguntas = 1;
        $_SESSION['interacao_perguntas']=1;
    }
    else{
        $interacao_perguntas = 0;
        $_SESSION['interacao_perguntas']=0;
    }

    $interacao_codigo = mysqli_real_escape_string($link, $_POST['interacao_codigo']);
    $_SESSION['interacao_codigo']=$interacao_codigo;
    $transmissao_player1 = mysqli_real_escape_string($link, $_POST['transmissao_player1']);
    $_SESSION['transmissao_player1']=$transmissao_player1;
    $transmissao_player2 = mysqli_real_escape_string($link, $_POST['transmissao_player2']);
    $_SESSION['transmissao_player2']=$transmissao_player2;
    $transmissao_traducao = mysqli_real_escape_string($link, $_POST['transmissao_traducao']);
    $_SESSION['transmissao_traducao']=$transmissao_traducao;
    $add_interacao_tranmissao = add_interacao($evento_id, $interacao_perguntas, $interacao_codigo);
    $add_transmissao = add_transmissao($evento_id, $transmissao_player1, $transmissao_player2, $transmissao_traducao);
    
    if(isset($_POST['tipo_de_interacao'])){
        if((strlen($transmissao_player1))>1 && (strlen($interacao_codigo))>1 && $retornar != "1"){
            $_SESSION['etapa'] = 4;
            $_SESSION['invalid']=0;
        }else if($retornar =="1"){
            $_SESSION['etapa']=$_SESSION['etapa']-1;
            $_SESSION['msg']=$_SESSION['etapa'];      
            header('Location: ../install/');             
        }else{
            $_SESSION['invalid']=1;
        }
    }else{
        if((strlen($transmissao_player1))>1){
            $_SESSION['etapa'] = 4;
            $_SESSION['invalid']=0;
        }else if($retornar =="1"){
            $_SESSION['etapa']=$_SESSION['etapa']-1;
            $_SESSION['msg']=$_SESSION['etapa'];      
            header('Location: ../install/');             
        }else{
            $_SESSION['invalid']=1;
        }
    }
    
}

if($etapa == 4){

    $evento_id = $_SESSION['evento_id'];
    if(isset($_POST['tipo_de_cadastro'])){
        $cadastro= new stdClass;    
        $cadastro->nome=isset($_POST['campo_nome'])?1:null;
        $_SESSION['campo_nome'] = $cadastro->nome;
        $cadastro->sobrenome= isset($_POST['campo_sobrenome'])?1:null;
        $_SESSION['campo_sobrenome'] = $cadastro->sobrenome;
        $cadastro->email= isset($_POST['campo_email'])?1:null;
        $_SESSION['campo_email'] = $cadastro->email;
        $cadastro->telefone= isset($_POST['campo_telefone'])?1:null;
        $_SESSION['campo_telefone'] = $cadastro->telefone;
        $cadastro->celular= isset($_POST['campo_celular'])?1:null;
        $_SESSION['campo_celular'] = $cadastro->celular;
        $cadastro->empresa=  isset($_POST['campo_empresa'])?1:null;
        $_SESSION['campo_empresa'] = $cadastro->empresa;
        $cadastro->cargo= isset($_POST['campo_cargo'])?1:null;
        $_SESSION['campo_cargo'] = $cadastro->cargo;
        $cadastro->especialidade= isset($_POST['campo_especialidade'])?1:null;
        $_SESSION['campo_especialidade'] = $cadastro->especialidade;
        $cadastro->ufcrm= isset($_POST['campo_ufcrm'])?1:null;
        $_SESSION['campo_ufcrm'] = $cadastro->ufcrm;
        $cadastro->senha= isset($_POST['campo_senha'])?1:null; 
        $_SESSION['campo_senha'] = $cadastro->senha;       
        
        if($cadastro->senha == 1){
            $cadastro->senha_padrao= isset($_POST['senha_padrao'])? 1 :null;
            $_SESSION['senha_padrao'] = $cadastro->senha_padrao;   
            $cadastro->senha_aleatoria= isset($_POST['senha_aleatoria'])? 1 :null;
            $_SESSION['senha_aleatoria'] = $cadastro->senha_aleatoria;   
            $cadastro->senha_campo= isset($_POST['senha_campo'])? $_POST['senha_campo'] :null;
            $_SESSION['senha_campo'] = $cadastro->senha_campo;   
        }

        if($cadastro->ufcrm == 1){
            $cadastro->valida_crm= isset($_POST['valida_crm'])?1:null;
            $_SESSION['valida_crm'] = $cadastro->valida_crm; 
        }

        if($cadastro->email == 1){
            $cadastro->valida_email= isset($_POST['valida_email'])?1:null;
            $_SESSION['valida_email'] = $cadastro->valida_email;    
        }

        if($retornar =="1"){
            $_SESSION['etapa']=$_SESSION['etapa']-1;
            $_SESSION['msg']=$_SESSION['etapa']."retornar";      
            header('Location: ../install/');
        }else if($cadastro->senha_padrao != 1){                      
            //foreach($cadastro as $propName => $propValue ){    
                //if (($propValue == "1")){ 
                if (isset($_POST['campo_nome']) || isset($_POST['campo_sobrenome']) || isset($_POST['campo_email']) || isset($_POST['campo_telefone']) || isset($_POST['campo_empresa']) || isset($_POST['campo_celular']) || isset($_POST['campo_cargo']) || isset($_POST['campo_especialidade']) || isset($_POST['campo_ufcrm']) || isset($_POST['campo_senha'])){     
                    $_SESSION['msg']=$propValue;             
                    $_SESSION['etapa'] =5;
                    $_SESSION['invalid']=0;
                    $cadastroJson=json_encode($cadastro);
                    add_cadastro($evento_id,$cadastroJson); 
                }else{
                    $_SESSION['invalid']=1;
                    $_SESSION['etapa'] =4;
                }
            //}
        }else{
            if($cadastro->senha_campo != null){
                $_SESSION['etapa'] =5;
                $_SESSION['invalid']=0;
                $cadastroJson=json_encode($cadastro);
                add_cadastro($evento_id,$cadastroJson);  
            }else{
                $_SESSION['invalid']=2;
                $_SESSION['etapa'] =4;
            }            
        }
    }else{
        if($retornar =="1"){
            $_SESSION['etapa']=$_SESSION['etapa']-1;
            $_SESSION['msg']=$_SESSION['etapa']."retornar";      
            header('Location: ../install/');
        }else{                      
            $_SESSION['etapa'] = 5;
            $_SESSION['invalid'] = 0;
            $cadastroJson = 0;
            add_cadastro($evento_id, $cadastroJson); 
        }
    }
}

if($etapa == 5){
    $evento_id = $_SESSION['evento_id'];

    
    if(!isset($_GET['f'])){
        $f = "";
    } else{
        $f = mysqli_real_escape_string($link, $_GET['f']);
    }
    
    $login_campo= new stdClass;
    $login_campo->nome = isset($_POST['login_campo_nome']) ? 1 : null;
    $_SESSION['login_campo_nome'] = $login_campo->nome;
    $login_campo->sobrenome =isset($_POST['login_campo_sobrenome']) ? 1 : null;
    $_SESSION['login_campo_sobrenome'] = $login_campo->sobrenome;
    $login_campo->email = isset($_POST['login_campo_email']) ? 1 : null;
    $_SESSION['login_campo_email'] = $login_campo->email;
    $login_campo->telefone = isset($_POST['login_campo_telefone']) ? 1 : null;
    $_SESSION['login_campo_telefone'] = $login_campo->telefone;
    $login_campo->celular = isset($_POST['login_campo_celular']) ? 1 : null;
    $_SESSION['login_campo_celular'] = $login_campo->celular;
    $login_campo->empresa = isset($_POST['login_campo_empresa']) ? 1 : null;
    $_SESSION['login_campo_empresa'] = $login_campo->empresa;
    $login_campo->cargo = isset($_POST['login_campo_cargo']) ? 1 : null;
    $_SESSION['login_campo_cargo'] = $login_campo->cargo;
    $login_campo->especialidade =isset($_POST['login_campo_especialidade']) ? 1 : null;
    $_SESSION['login_campo_especialidade'] = $login_campo->especialidade;
    $login_campo->uf_crm = isset($_POST['login_campo_uf_crm']) ? 1 : null;
    $_SESSION['login_campo_uf_crm'] = $login_campo->uf_crm;
    $login_campo->senha = isset($_POST['login_campo_senha']) ? 1 : null;
    $_SESSION['login_campo_senha'] = $login_campo->senha;

    if($retornar =="1"){
        $_SESSION['etapa']=$_SESSION['etapa']-1;
        $_SESSION['msg']=$_SESSION['etapa']."retornar";      
        header('Location: ../install/');
    }else if (isset($_POST['login_campo_nome']) || isset($_POST['login_campo_sobrenome']) || isset($_POST['login_campo_email']) || isset($_POST['login_campo_telefone']) || isset($_POST['login_campo_empresa']) || isset($_POST['login_campo_celular']) || isset($_POST['login_campo_cargo']) || isset($_POST['login_campo_especialidade']) || isset($_POST['login_campo_uf_crm']) || isset($_POST['login_campo_senha'])){                
        $_SESSION['etapa'] =6;
        $_SESSION['invalid']=0;
        $loginJson=json_encode($login_campo);
        $add_login = add_login($evento_id, $loginJson); 
    }else{
        $_SESSION['invalid']=1;
        $_SESSION['etapa'] =5;
    }     
}

if($etapa == 6){
    $evento_id = $_SESSION['evento_id'];
    $texto_email_cadastro = mysqli_real_escape_string($link, $_POST['texto_email_cadastro']);
    $_SESSION['texto_email_cadastro']=$texto_email_cadastro;
    $texto_email_nova_senha = mysqli_real_escape_string($link, $_POST['texto_email_nova_senha']);
    $_SESSION['texto_email_nova_senha']=$texto_email_nova_senha;

    if((strlen($texto_email_cadastro))>1 && (strlen($texto_email_nova_senha))>1 && $retornar != "1"){
        $_SESSION['etapa'] = 7;
        add_mensagem($evento_id,$texto_email_cadastro,$texto_email_nova_senha);
    }else if($retornar =="1"){
        $_SESSION['etapa']=$_SESSION['etapa']-1;
        $_SESSION['msg']=$_SESSION['etapa'];      
        header('Location: ../install/');             
    }else{
        $_SESSION['invalid']=1;
    }
};

if($etapa == 7){
    // destroy the session
    session_destroy();
};

header('Location: ../install/');

?>
