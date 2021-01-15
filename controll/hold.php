<?php 
isset($_SESSION['fail'])?$_SESSION['fail']=1:$_SESSION['fail']=0;
isset($_SESSION['invalid'])?$_SESSION['invalid']:$_SESSION['invalid']=0;
isset($_SESSION['etapa'])?$_SESSION['etapa']:$_SESSION['etapa']=1;
isset($_SESSION['list_convidados'])?$_SESSION['list_convidados']:$_SESSION['list_convidados']=0;
isset($_SESSION['cliente_id'])?$_SESSION['cliente_id']:$_SESSION['cliente_id']=0;
isset($_SESSION['evento_id'])?$_SESSION['evento_id']:$_SESSION['evento_id']=0;
isset($_SESSION['msg'])?$_SESSION['msg']:$_SESSION['msg']=0;
isset($_SESSION['retornar'])?$_SESSION['retornar']:$_SESSION['retornar']='0';
isset($_SESSION['checkbox_Client'])?$_SESSION['checkbox_Client']:$_SESSION['checkbox_Client']='checked';
isset($_SESSION['tipo_de_cliente'])?$_SESSION['tipo_de_cliente']:$_SESSION['tipo_de_cliente']='1';

//Client Hold
isset($_SESSION['cliente_nome'])?$_SESSION['cliente_nome']:$_SESSION['cliente_nome']='';
isset($_SESSION['cliente_site'])?$_SESSION['cliente_site']:$_SESSION['cliente_site']='';
isset($_SESSION['cliente_responsavel'])?$_SESSION['cliente_responsavel']:$_SESSION['cliente_responsavel']='';
isset($_SESSION['cliente_logo'])?$_SESSION['cliente_logo']:$_SESSION['cliente_logo']=[];

//Event Hold
isset($_SESSION['evento_nome'])?$_SESSION['evento_nome']:$_SESSION['evento_nome']='';
isset($_SESSION['evento_data'])?$_SESSION['evento_data']:$_SESSION['evento_data']='';
isset($_SESSION['evento_hora'])?$_SESSION['evento_hora']:$_SESSION['evento_hora']='';

//Interaction Hold
isset($_SESSION['interacao_codigo'])?$_SESSION['interacao_codigo']:$_SESSION['interacao_codigo']='';

//Transmission Hold
isset($_SESSION['transmissao_player1'])?$_SESSION['transmissao_player1']:$_SESSION['transmissao_player1']='';
isset($_SESSION['transmissao_player2'])?$_SESSION['transmissao_player2']:$_SESSION['transmissao_player2']='';
isset($_SESSION['transmissao_traducao'])?$_SESSION['transmissao_traducao']:$_SESSION['transmissao_traducao']='';

//Cadastro Hold
isset($_SESSION['campo_nome'])?$_SESSION['campo_nome']:$_SESSION['campo_nome']='';
isset($_SESSION['campo_sobrenome'])?$_SESSION['campo_sobrenome']:$_SESSION['campo_sobrenome']='';
isset($_SESSION['campo_email'])?$_SESSION['campo_email']:$_SESSION['campo_email']='';
isset($_SESSION['campo_telefone'])?$_SESSION['campo_telefone']:$_SESSION['campo_telefone']='';
isset($_SESSION['campo_celular'])?$_SESSION['campo_celular']:$_SESSION['campo_celular']='';
isset($_SESSION['campo_empresa'])?$_SESSION['campo_empresa']:$_SESSION['campo_empresa']='';
isset($_SESSION['campo_cargo'])?$_SESSION['campo_cargo']:$_SESSION['campo_cargo']='';
isset($_SESSION['campo_especialidade'])?$_SESSION['campo_especialidade']:$_SESSION['campo_especialidade']='';
isset($_SESSION['campo_ufcrm'])?$_SESSION['campo_ufcrm']:$_SESSION['campo_ufcrm']='';
isset($_SESSION['campo_senha'])?$_SESSION['campo_senha']:$_SESSION['campo_senha']='';
isset($_SESSION['senha_padrao'])?$_SESSION['senha_padrao']:$_SESSION['senha_padrao']='';
isset($_SESSION['senha_aleatoria'])?$_SESSION['senha_aleatoria']:$_SESSION['senha_aleatoria']='';
isset($_SESSION['senha_campo'])?$_SESSION['senha_campo']:$_SESSION['senha_campo']='';
isset($_SESSION['valida_crm'])?$_SESSION['valida_crm']:$_SESSION['valida_crm']='';
isset($_SESSION['valida_email'])?$_SESSION['valida_email']:$_SESSION['valida_email']='';

//Login Hold
isset($_SESSION['login_campo_nome'])?$_SESSION['login_campo_nome']:$_SESSION['login_campo_nome']='';
isset($_SESSION['login_campo_sobrenome'])?$_SESSION['login_campo_sobrenome']:$_SESSION['login_campo_sobrenome']='';
isset($_SESSION['login_campo_email'])?$_SESSION['login_campo_email']:$_SESSION['login_campo_email']='';
isset($_SESSION['login_campo_telefone'])?$_SESSION['login_campo_telefone']:$_SESSION['login_campo_telefone']='';
isset($_SESSION['login_campo_celular'])?$_SESSION['login_campo_celular']:$_SESSION['login_campo_celular']='';
isset($_SESSION['login_campo_empresa'])?$_SESSION['login_campo_empresa']:$_SESSION['login_campo_empresa']='';
isset($_SESSION['login_campo_cargo'])?$_SESSION['login_campo_cargo']:$_SESSION['login_campo_cargo']='';
isset($_SESSION['login_campo_especialidade'])?$_SESSION['login_campo_especialidade']:$_SESSION['login_campo_especialidade']='';
isset($_SESSION['login_campo_uf_crm'])?$_SESSION['login_campo_uf_crm']:$_SESSION['login_campo_uf_crm']='';
isset($_SESSION['login_campo_senha'])?$_SESSION['login_campo_senha']:$_SESSION['login_campo_senha']='';

//mensagem hold
isset($_SESSION['texto_email_cadastro'])?$_SESSION['texto_email_cadastro']:$_SESSION['texto_email_cadastro']='';
isset($_SESSION['texto_email_nova_senha'])?$_SESSION['texto_email_nova_senha']:$_SESSION['texto_email_nova_senha']='';
?>