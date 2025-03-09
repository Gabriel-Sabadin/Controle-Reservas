<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Reserva;

class AuthController extends Controller
{   
    public function login() 
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        $request->validate(

            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:8|max:32'
            ],

            [
                'text_username.required' => 'O username é obrigatório',
                'text_username.email' => 'Username deve ser um email válido',
                'text_password.required' => 'A password é obrigatória',
                'text_password.min' => 'A password deve ter pelo menos :min caracteres',
                'text_password.max' => 'A password deve ter no máximo :max caracteres'
            ]
        );

        $user = User::where('email', $username)
                      ->where('deleted_at', NULL)
                      ->first();

        if(!$user){
            return redirect()
                   ->back()
                   ->withInput()
                   ->with('loginError', 'Usuário incorreto.');
        }


        
        if(!password_verify($password, $user->password)){
            return redirect()
                   ->back()
                   ->withInput()
                   ->with('loginError', 'Senha incorreta.');
        }
        


        $user->last_login = date('Y-m-d H:i:s');
        $user->save();


        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->name
            ]
        ]);


        return redirect()->to('/calendario');
    }

    public function cadastro()
    {
        return view('cadastro');
    }

    public function cadastroSubmit(Request $request)
    {

    $request->validate(
        [
            'text_username' => 'required',
            'text_email' => 'required|email',
            'text_password' => 'required|min:8|max:32|confirmed'  
        ],
        [   
            'text_username.required' => 'O Nome é obrigatório',
            'text_email.required' => 'O Email é obrigatório',
            'text_username.email' => 'Email deve ser um email válido',
            'text_password.required' => 'A senha é obrigatória',
            'text_password.min' => 'A senha deve ter pelo menos :min caracteres',
            'text_password.max' => 'A senha deve ter no máximo :max caracteres',
            'text_password.confirmed' => 'As senhas não coincidem'  
        ]
    );


        $usuario = new User();
        $usuario->name = $request->text_username; 
        $usuario->email = $request->text_email;  
        $usuario->password = bcrypt($request->text_password);  
        $usuario->save();


        auth()->login($usuario);

        return redirect()->route('calendario');
    }

    public function dados()
    {
        $id = session('user.id');
        $usuario = User::find($id);
        return view('dados', compact('usuario'));
    }

    public function dadosSubmit(Request $request)
{
    // Validando os dados recebidos
    $request->validate(
        [
            'text_name' => 'required',
            'text_email' => 'required|email',
            'text_password' => 'required|min:8|max:32|confirmed',  // Confirmação automática com text_password_confirmation
            'text_password_confirmation' => 'required',  // Adicionar validação explícita
        ],
        [   
            'text_name.required' => 'O Nome é obrigatório',
            'text_email.required' => 'O Email é obrigatório',
            'text_email.email' => 'Email deve ser um email válido',
            'text_password.required' => 'A senha é obrigatória',
            'text_password.min' => 'A senha deve ter pelo menos :min caracteres',
            'text_password.max' => 'A senha deve ter no máximo :max caracteres',
            'text_password.confirmed' => 'As senhas não coincidem',  
            'text_password_confirmation.required' => 'A confirmação da senha é obrigatória', 
        ]
    );

    // Se os dados estão corretos, você pode proceder com o processo de atualização
    $usuario = User::find(session('user.id'));
    $usuario->name = $request->text_name;
    $usuario->email = $request->text_email;
    if ($request->text_password) {
        $usuario->password = bcrypt($request->text_password); // Atualizando senha
    }
    $usuario->save();

    // Mensagem de sucesso
    return redirect()->route('dados')->with('success', 'Dados atualizados com sucesso!');

}


    public function logout()
    {
        session()->forget('user');
        return redirect()->to('/login');
    }

}