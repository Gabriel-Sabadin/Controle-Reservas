<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Reserva;

class MainController extends Controller
{  
    
    

        public function index(Request $request)
        {

            //dd(session('user.id'));


            Carbon::setLocale('pt_BR');
        

            $month = $request->query('month', now()->month);
            $year = $request->query('year', now()->year);
        

            $firstDay = Carbon::create($year, $month, 1);
            $startDayOfWeek = $firstDay->dayOfWeek; 
            $daysInMonth = $firstDay->daysInMonth;
        

            $reservasCollection = Reserva::where('mes_reserva', $month)
                ->where('ano_reserva', $year)
                ->get();
        

            $reservas = [];
            foreach ($reservasCollection as $reserva) {
                $reservas[$reserva->dia_reserva][] = $reserva;
            }

            $userId = session('user.id');
        
            return view('index', compact('month', 'year', 'daysInMonth', 'startDayOfWeek', 'reservas', 'userId'));
        }

    

    public function todas()
    {
        $reservas = Reserva::orderBy('data', 'desc')->get();
        return view('reservas', ['reservas' => $reservas]);
    }

    public function minhas(Request $request)
{
    $id = session('user.id');
    $query = Reserva::where('id_user', $id)->orderBy('ano_reserva', 'desc')
                    ->orderBy('mes_reserva', 'desc')
                    ->orderBy('dia_reserva', 'desc');  // Ordenar por ano, mês e dia

    // Filtro de reservas ativas
    if ($request->query('filtro') == 'ativas') {
        // Comparar com o dia, mês e ano de hoje
        $today = now(); // Data de hoje
        $query->where('ano_reserva', '>', $today->year)  // Filtra reservas com ano maior que o ano atual
              ->orWhere(function($query) use ($today) {
                  $query->where('ano_reserva', $today->year)  // Para o mesmo ano, verifica o mês
                        ->where('mes_reserva', '>', $today->month)  // Filtra meses maiores que o atual
                        ->orWhere(function($query) use ($today) {
                            $query->where('mes_reserva', $today->month)  // Para o mesmo mês, verifica o dia
                                  ->where('dia_reserva', '>', $today->day);  // Filtra dias maiores que o atual
                        });
              });
    }

    $reservas = $query->get();

    return view('minhas', ['reservas' => $reservas]);
}


    public function adicionarReserva(Request $request)
    {
        

        $userId = $request->query('user_id');
        $day = $request->query('day');
        $month = $request->query('month');
        $year = $request->query('year');


        return view('adicionar', compact('userId', 'day', 'month', 'year'));
    }

    public function adicionarBanco(Request $request)
    {   

        $id = $request->input('user_id');
        if(!$id) {
            return redirect()->route('logout');
        }

        $request->validate(

            [
                'finalidade' => 'required',
                'horario_inicio' => 'required',
                'horario_fim' => 'required',
                'tipo' => 'required'
                
            ],

            [
                'finalidade.required' => 'A finalidade é obrigatória',
                'horario_inicio.required' => 'O horário de início é obrigatório',
                'horario_fim.required' => 'O horário de fim é obrigatório',
                'tipo.required' => 'O tiipo é obrigatório'
             
                
            ]
        );

        $id = session('user.id');

        $reserva = new Reserva();
        $reserva->finalidade = $request->finalidade;
        $reserva->data = '2000-01-01';
        $reserva->horario_inicio = $request->horario_inicio;
        $reserva->horario_termino = $request->horario_fim;
        $reserva->local = $request->tipo;
        $reserva->id_user = $request->user_id;

        

        $reserva->user = User::find($request->user_id)->name;
        $reserva->observacao = $request->observacoes;
        $reserva->dia_reserva = $request->day;
        $reserva->mes_reserva = $request->month;
        $reserva->ano_reserva = $request->year;
        
        $reserva->save();
        
        return redirect()->route('calendario')->with('success', 'Reserva adicionada com sucesso!');

    }

    public function editar()
    {
        
        return view('editar');
    }



    public function editarSubmit(Request $request)
    {
        $request->validate([
            'finalidade' => 'required',
            'horario_inicio' => 'required',
            'horario_fim' => 'required',
            'tipo' => 'required'
        ]);

        $id =$request->id;
    
        $reserva = Reserva::findOrFail($id);
    
        $reserva->update([
            'finalidade' => $request->finalidade,
            'horario_inicio' => $request->horario_inicio,
            'horario_termino' => $request->horario_fim,
            'local' => $request->tipo,
            'observacao' => $request->observacao,
        ]);
    
        return redirect()->route('calendario')->with('success', 'Reserva atualizada com sucesso!');
    }
    

    public function apagarSubmit(Request $request, $id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {
            return redirect()->back()->with('error', 'Reserva não encontrada.');
        }

        if ($reserva->id_user != session('user.id')) {
            return redirect()->back()->with('error', 'Você não tem permissão para excluir esta reserva.');
        }

        $reserva->delete();

        return redirect()->route('calendario')->with('success', 'Reserva deletada com sucesso!');
    }

}