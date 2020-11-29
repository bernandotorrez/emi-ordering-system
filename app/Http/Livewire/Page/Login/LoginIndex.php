<?php

namespace App\Http\Livewire\Page\Login;

use App\Models\User;
use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class LoginIndex extends Component
{

    use WithWrsApi;

    protected $pageTitle = 'Login Into DMS';
    public $username, $password, $loginAs;

    protected $rules = [
        'username'  => 'required|min:3|max:50',
        'password'  => 'required|min:3|max:50',
        'loginAs'   => 'required'
    ];

    protected $messages = [
        'username.required' => 'Please fill the Username Field',
        'username.min'      => 'Please fill the Username Field with Minimal 3 Characters',
        'username.max'      => 'Please fill the Username Field with Maximal 50 Characters',
        'password.required' => 'Please fill the Password Field',
        'password.min'      => 'Please fill the Password Field with Minimal 3 Characters',
        'username.max'      => 'Please fill the Username Field with Maximal 50 Characters',
        'loginAs.required'  => 'Please choose the Login As Field',
    ];

    public function render()
    {
        $data = array('title' => $this->pageTitle);
        return view('livewire.page.login.login-index')->layout('layouts.app', $data);
    }

    public function mount()
    {
        if(Auth::check()) {
            return redirect()->route('home.index');
        }

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['username', 'password', 'loginAs']);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $this->validate();

        $admin = User::where('level_access', '1')->get(['username']);
        $listAdmin = array();

        foreach($admin as $data) {
            array_push($listAdmin, $data->username);
        }
        
        if(in_array($this->username, $listAdmin)) {
            $login = User::where(['username' => $this->username, 'password' => md5($this->password)])->first();

            if(!$login) {
                session()->flash('login_failed', 'Username or Password is wrong!');
            } else {
                session(['user' => $login, 'level_access' => $login->level_access]);
                return redirect()->route('home.index');
            }
        } else {
            if($this->loginAs == 'atpm') {
                $response = Http::post($this->wrsApi.'/atpm-user/login', [
                    'username' => $this->username,
                    'password' => $this->password
                ]);
            } else {
                $response = Http::post($this->wrsApi.'/dealer-user/login', [
                    'username' => $this->username,
                    'password' => $this->password
                ]);
            }
    
            if($response['message'] != 'success') {
                session()->flash('login_failed', 'Username or Password is wrong!');
            } else {
                session(['user' => $response['data'], 'level_access' => 4]);
                return redirect()->route('home.index');
            }
        }

        

    }
}
