<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use App\usuarios;
use Session;
use App\classes\minhaClasse;

use Illuminate\Support\Facades\Mail;
use App\Mail\emailRecuperarSenha;

class usuariosController extends Controller
{
	//================================================================
    public function index(){

        //verificar se existe sessão.
        if(!Session::has('login')){
            //se não existe, apresenta formulário de login
            return $this->frmLogin();
        }else{
            return view('aplicacao');
        }

    }

    //================================================================
    // LOGIN
    //================================================================
    public function frmLogin(){
        //apresenta o formulário de login
        return view('usuario_frm_login');        
    }

    //================================================================
    public function executarLogin(Request $request){
        /*
        1 - verificar se os dados foram preenchidos corretamente (Validation)
        2 - ir à procura do usuário na bd (Eloquent ORM)
        3 - verificar se usuário e senha correspondem a usuário e senha inserido no frm (Hashing)
        4 - ultrapassadas as fases todas, criar sessão de usuário (Sessions)
        */

        // Validação
        $this->validate($request, [            
            'text_usuario' => 'required',
            'text_senha' => 'required'
            ]);

        //verificar se o usuário existe
        $usuario = usuarios::where('usuario', $request->text_usuario)->first();

        //verifica se existe usuário
        if(count($usuario)==0){
            $erros_bd = ['Essa conta de usuário não existe.'];
            return view('usuario_frm_login', compact('erros_bd'));
        }

        //verifica se a senha corresponde ao guardado na bd
        if(!Hash::check($request->text_senha, $usuario->senha)){
            $erros_bd = ['A senha está incorreta.'];
            return view('usuario_frm_login', compact('erros_bd'));
        }

        //criar/abrir sessão de usuário
        Session::put('login', 'sim');
        Session::put('usuario', $usuario->usuario);

        return redirect('/');
    }

    //================================================================
    public function logout(){
        //logout da sessão (destruir a sessão e redirecionar para o quadro de login)

        //destruir a sessão
        Session::flush();
        return redirect('/');
    }


    //================================================================
    // RECUPERAR SENHA
    //================================================================
    public function frmRecuperarSenha(){
    	//apresentar o formulário para recuperação da senha
    	return view('usuario_frm_recuperar_senha');
    }

    //================================================================
    public function executarRecuperarSenha(Request $request){
        
        //validacao
        $this->validate($request,[
            'text_email' => 'required|email'
            ]);

        //vai buscar o usuário que contém a conta de email indicada
        $usuario = usuarios::where('email', $request->text_email)->get();
        if($usuario->count() == 0){
            $erros_bd = ['O email não está associado a nenhuma conta de usuário.'];
            return view('usuario_frm_recuperar_senha', compact('erros_bd'));
        }

        //atualizar a senha do usuário para a nova senha (senha de recuperação)
        $usuario = $usuario->first();
        //criar uma nova senha aleatória
        $nova_senha = minhaClasse::criarCodigo();
        $usuario->senha = Hash::make($nova_senha);
        $usuario->save();

        //enviar email ao usuário com a nova senha
        Mail::to($usuario->email)->send(new emailRecuperarSenha($nova_senha));
        
        //apresentar uma view informando o usuário que foi enviado email
        return redirect('/usuario_email_enviado');
    }

    public function emailEnviado(){
        return view('usuario_email_enviado');
    }



    //================================================================
    // CRIAÇÃO DE NOVA CONTA
    //================================================================
    public function frmCriarNovaConta(){
    	//apresentar o formulário de criação de nova conta
    	return view('usuario_frm_criar_conta');
    }

    //================================================================
    public function executarCriarNovaConta(Request $request){
    	//executar os procedimentos e verificações para criação de uma nova conta

        // ---------------------------------------------------
        //validacao
        $this->validate($request,[
            'text_usuario' => 'required|between:3,30|alpha_num',
            'text_senha' => 'required|between:6,15',
            'text_senha_repetida' => 'required|same:text_senha',
            'text_email' => 'required|email',
            'check_termos_condicoes' => 'accepted'
            ]);

        
        // ---------------------------------------------------
        // verifica se já existe um usuário com o mesmo nome ou com o mesmo email
        $dados = usuarios::where('usuario', "=", $request->text_usuario)
                         ->orWhere('email', '=', $request->text_email)
                         ->get();
        if($dados->count() != 0){
            $erros_bd = ['Já existe um usuário com o mesmo nome ou com o mesmo email.'];
            return view('usuario_frm_criar_conta', compact('erros_bd'));
        }
        

        // ---------------------------------------------------
        //inserir o novo usuário na base de dados
        $novo = new usuarios;
        $novo->usuario = $request->text_usuario;
        $novo->senha = Hash::make($request->text_senha);
        $novo->email = $request->text_email;
        $novo->save();

        return redirect('/');
    }
}
