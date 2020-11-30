<?php

namespace App\Http\Livewire\Page\Login;

use App\Models\User;
use App\Repository\Eloquent\UserRepository;
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

                $status_atpm = 'atpm';
            } else {
                $response = Http::post($this->wrsApi.'/dealer-user/login', [
                    'username' => $this->username,
                    'password' => $this->password
                ]);

                $status_atpm = 'dealer';
            }
    
            if($response['message'] != 'success') {
                session()->flash('login_failed', 'Username or Password is wrong!');
            } else {
                $login = User::where(['username' => $this->username])->count();

                if($login == 0) {
                    if($status_atpm == 'atpm') {
                        User::create([
                            'kd_user_wrs' => $response['data']['kd_atpm_user'],
                            'nama_user' => $response['data']['nm_atpm_user'],
                            'username' => $response['data']['username'],
                            'email' => $response['data']['email'],
                            'id_user_group' => 2,
                            'status_atpm' => 'atpm',
                            'is_from_wrs' => '1'
                        ]);
                    } else {
                        User::create([
                            'kd_user_wrs' => $response['data']['kd_dealer_user'],
                            'nama_user' => $response['data']['nm_dealer_user'],
                            'username' => $response['data']['username'],
                            'email' => $response['data']['email'],
                            'id_user_group' => 3,
                            'id_dealer' => $response['data']['fk_dealer'],
                            'id_dealer_level' => $response['data']['fk_dealer_level'],
                            'status_atpm' => 'dealer',
                            'is_from_wrs' => '1'
                        ]);
                    }
                }

                session(['user' => $response['data'], 'level_access' => 4]);
                return redirect()->route('home.index');
            }
        }

        

    }
}
