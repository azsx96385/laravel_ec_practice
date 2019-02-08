<?php

//命名空間-告訴laravel 要到哪個資料夾 找到我這個controller
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator; //驗證器
use Hash; //雜湊
use Mail;
use App\Shop\Entity\User; //使用 - user 的 Eloquent ORM　Model
use DB;
use Socialite; //Fb 社群登入




class UserAuthController extends Controller
{
    /*****[ A. 會員註冊 ]*******************************************************/
    public function signUpPage(){
        $binding=["title"=>'註冊'];
        return view('auth.signUP',$binding);
        
    }
    
    
    public function signUpProcess(){ //處理註冊資料
        //1.接收輸入的資料
        $input=request()->all(); //取得請求中，使用者傳來的所有資料
        //2.設定驗證規則
        $rules=[ //表單傳送過來的欄位名稱 => [驗證規則]
            //暱稱
            'nickname'=>['required','max:50'],
            //email
            'email'=>['required','max:150','email'],
            //密碼
            'password'=>['required','same:password_confirmation','min:6'],
            //密碼驗證
            'password_confirmation'=>['required','min:6'],
            //帳號類型
            'type'=>['required','in:G,A'],

        ];

        //3.驗證資料 Validator::make()
        $validator=Validator::make($input,$rules);

        //4.驗證失敗處理
        if ($validator->fails()){
            return redirect('/user/auth/sign-up')->withErrors($validator);
        };

        //5.進行密碼加密
        $input['password']=Hash::make($input['password']);


        //6.新增會員資料 - 驗證加密過後，可以準備存入了
        $Users=User::create($input);  
        
        //所有傳入的資料，會依據鍵值名稱，新增到資料表相對應的欄位中-又稱為 Mass assignment 大量指定異動的欄位
        //所傳入之資料，只要有寫在 Eloquent ORM　Model $fillable ，都可以做異動 ，反之則無法

        // 7.寄送註冊通知信
        $mail_binding=['nickname'=>$input['nickname']];

        Mail::send('email.signUpEmailNotification',$mail_binding,
        function($mail) use ($input){
            //寄件人
            $mail->to($input['email']);
            //收件人
            $mail->from('kj@kejyun.com');
            //郵件主旨
            $mail->subject('恭喜註冊 SHOP LRARAVEL 成功');
        });

        return redirect('/user/auth/sign-in');

        //設定驗證規則
        //var_dump($input);
        //exit;
    }
    

    /*****[B. 會員登入]*******************************************************/

    public function signInPage(){
        $binding=["title"=>"登入"];
        return view('auth.signIn',$binding);

    }

    public function signInProcess(){
        //1.接收資料
        $input=request() -> all(); //使用 變數 input接收-request的所有表單資料

        //2.開始驗證資料-輸入錯誤
            //建立規則
        $rules=[
            //Email 
            'email'=>['required','max:150','email',],
            //密碼
            'password'=>['required','min:6',],
        ];
            //驗證資料
            $validator=Validator::make($input,$rules);

            if($validator->fails()){
                //資料驗證錯誤
                return redirect('/user/auth/sign-in')
                ->withErrors($validator)->withInput(); //顯示驗證器驗證的錯誤訊息
            };
        
        //3.取得使用者資料-資料庫撈資料-判斷密碼是否有誤

            //啟用紀錄 SQL 語法
            DB::enableQueryLog(); 


        //使用email-撈取使用者-資料
        $User=User::where('email',$input['email'])->firstOrFail(); //比對email-撈出資料
            //where 限定-撈取email資料-firstOrFail() 限制撈取第一筆資料-若無則丟出例外訊息

            var_dump(DB::getQueryLog());
           // exit;
        
        //檢查密碼是否正確
        $is_password_correct=Hash::check($input['password'],$User->password);

        if( !$is_password_correct ){
            //False-密碼錯誤-回傳密碼錯誤訊息
            $error_message=['msg'=>["密碼驗證錯誤"],];
            return redirect('user/auth/sign-in')-withErrors($error_message)->withInput();
        }

        //session 紀錄會員編號
        session()->put('user_id',$User->id);

        //重新回到首頁
        return redirect()->intended("/");

    }

    public function signOut(){
        session()->forget('user_id');
        return redirect('/');
    }

    /*****[C. 社群登入-FB]*******************************************************/

    public function facebookSignInProcess(){
        $redirect_url=env('FB_REDIRECT');

        return Socialite::driver('facebook')
            ->scopes(['user_friends'])->redirectUrl($redirect_url)->redirect();
    }

    //0208 - 社群登入暫緩
    // public function facebookSignInCallbackProcess(){
    // }

    /************************************************************/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
