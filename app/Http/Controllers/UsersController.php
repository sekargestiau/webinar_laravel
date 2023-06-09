<?php

namespace App\Http\Controllers;

use App\Models\Data_Pendaftaran;
use App\Models\PIC_Seminar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $pic_seminar = PIC_Seminar::where(function ($query) use ($keyword) {
            $query->where('nama_seminar', 'LIKE', '%' . $keyword . '%')
                ->orWhere('tanggal_seminar', 'LIKE', '%' . $keyword . '%')
                ->orWhere('lokasi_seminar', 'LIKE', '%' . $keyword . '%')
                ->orWhere('gratis_berbayar', 'LIKE', '%' . $keyword . '%');
                

        })
        ->where('status', 'accepted')
        ->paginate(12);

        $pic_seminar->withPath('users');
        $pic_seminar->appends($request->all());

        return view('dashboard.users', compact('pic_seminar', 'keyword'));
        $pic_seminar = PIC_Seminar::all();


    }

    public function index_profile()
    {
        // $datas = User::all();
        // return view('users', compact('datas'));
        // $user = User::all();
        $user = auth()->user();
        $acara = Data_Pendaftaran::whereHas('picSeminar', function ($query) use ($user) {
        $query->where('id_users', $user->id);
         })->get();

         return view('profile.view-user', ['user' => $user, 'acara' => $acara]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new User;
        return view('create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $model = new User;
        $model->password = 1;
        $model->nama_user = $request->nama_user;
        $model->email_user = $request->email_user;
        $model->asal_instansi = $request->asal_instansi;
        $model->no_telp = $request->no_telp;
        $model->save();

        return redirect('users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $user = User::where('id',auth()->user()->id)->post();
        $user = User::find($id);

        // Mengirim data pengguna ke view edit profile
        return view('profile.edit-user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $model = User::findOrFail($id);
        $model->nama_user = $request->nama_user;
        $model->email_user = $request->email_user;
        $model->asal_instansi = $request->asal_instansi;
        $model->no_telp = $request->no_telp;
        $model->save();
    
        return redirect('profile')->with('success', 'Profil berhasil diperbarui');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = User::where('id',auth()->user()->id)->post();
        $model->delete();
        return redirect('users');
    }


    public function layout_users(){
        return view('users');
    }

    public function create_layout(){
        return view('users');
    }

    public function edit_layout(){
        return view('users');
    }

    public function register_seminar(){
        return view('pendaftaran');
    }


    public function logout(Request $request)
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/login');
    }

}


