<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use \App\PizzaCategory;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyUser;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';
    // protected $redirectTo = '/verifyUser';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);
        $name = $request->name;
        $to = $request->email;
        $subj = 'Verification from Pizzapizzaria';
        $msg = '';
        $code = $user->code;
        Mail::to($to)->send(new VerifyUser($code, $name, $subj, $msg));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath())->with('verify', 'sent');
    }
    public function showRegistrationForm()
    {
        $cate = PizzaCategory::where('isActive',1)->get();
        return view('auth.register',compact('cate'));
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // $file = $data['uimg'];
        // $img = Image::make($file->getRealPath());
        // $imgname = time().$data['name'].".".$file->getClientOriginalExtension();
        // $img->save('userAssets/userImage/'.$imgname);
        $buffet = 0;
        $code = mt_rand(100000, 999999);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address'=>null,
            'phone'=>$data['phone'],
            'city'=>null,
            'state'=>null,
            'country'=>null,
            'imgname'=>null,
            'preference'=>null,
            'delivery_method'=>null,
            'pizza_size'=>null,
            'fav_com'=>null,
            'buffet'=>$buffet,
            'code'=> $code,
        ]);
    }
    public function verifyEmail(Request $request)
    {
        $user = Auth::user();
        if(!$user->email_verified_at)
        {
            if($request->code)
            {
                if($user->code == $request->code)
                {
                    $user->email_verified_at = date('Y-m-d H:i:s');
                    $user->save();
                    return redirect('/home');
                }
                else {
                    return back()->with('invalid', 'error');
                }
            }
        }
        else{
            return redirect('/home');
        }
        return view('user.verifyUser');
    }
    public function resendCode(Request $request)
    {
        // echo "resendCode";die;
        $user = Auth::user();
        if(!$user->email_verified_at)
        {
            $name = $user->name;
            $to = $user->email;
            $subj = 'Verification from Pizzapizzaria';
            $msg = '';
            $code = mt_rand(100000, 999999);
            Mail::to($to)->send(new VerifyUser($code, $name, $subj, $msg));
            $user->code = $code;
            $user->save();
            return redirect('/verifyUser')->with('verify', 'sent');
        }
        return redirect('/home');
    }
}