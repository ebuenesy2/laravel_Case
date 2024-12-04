<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class App extends Controller
{
    
    //Anasayfa
    public function index($site_lang="tr")
    {
        \Illuminate\Support\Facades\App::setLocale($site_lang); //! Çoklu Dil
        //echo "Dil:"; echo $site_lang;  echo "<br/>";  die();
        
        try {
         
            //! Return
            $DB =  [];

            return view('home',$DB);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    } 


    //Kullanıcı Giriş
    public function login($site_lang="tr")
    {
        \Illuminate\Support\Facades\App::setLocale($site_lang); //! Çoklu Dil
        //echo "Dil:"; echo $site_lang;  echo "<br/>";  die();

        //! Return
        $DB =  [];

        return view('login',$DB);
    }
    //Kullanıcı Giriş Son

    //! Giriş Kontrol
    public function LoginControl(Request $request)
    {
        try {

            //Veri Okuma
            // [ Name] - değerlerine göre oku
            $token= $request->_token;
            $siteLang= $request->siteLang; //! Çoklu Dil
            \Illuminate\Support\Facades\App::setLocale($siteLang); //! Çoklu Dil

            echo "loginControl"; die();

            //! Gelen Bilgiler
            $email= $request->email;
            $password= $request->password;
            
            //! Tanım
            $loginCheck=0; //! Login Durumu
      

            //veri tabanı işlemleri
            $DB_Where= DB::table('users')->where('email','=',$email)->where('password','=',$password)->first();
            //echo "<pre>"; print_r($DB_Where); die();

            if($DB_Where) {  
                //echo "Kullancı Giriş Var"; die();

                $loginCheck = 1;
                $activeCheck = $DB_Where->isActive;
                
                $yildirimdev_userID = $DB_Where->id;
                $yildirimdev_email = $DB_Where->email;
                $yildirimdev_name = $DB_Where->name;
                $yildirimdev_surname = $DB_Where->surname;
                $yildirimdev_img_url = $DB_Where->img_url;
                $yildirimdev_departmanID = $DB_Where->departman_id;
                $yildirimdev_roleID = $DB_Where->role_id;
            }

            
            //! Login Durumuna Yönlendirme
            if($loginCheck == 1) { 
                //echo "Login Oldu"; die();

                if($activeCheck == 0) { return redirect('/'.__('admin.lang').'/error/account/block'); }
                else { return redirect('/'.__('admin.lang').'/admin')->with('status',"succes")
                    ->with('yildirimdev_userID',$yildirimdev_userID)->with('yildirimdev_email',$yildirimdev_email)
                    ->with('yildirimdev_name',$yildirimdev_name)->with('yildirimdev_surname',$yildirimdev_surname)->with('yildirimdev_img_url',$yildirimdev_img_url) 
                    ->with('yildirimdev_departmanID',$yildirimdev_departmanID)->with('yildirimdev_roleID',$yildirimdev_roleID);
                }
            }
            else {  return redirect('/'.__('admin.lang').'/admin/login')->with('status',"error")->with('msg', __('admin.theEmailPasswordMayBeIncorrect')); }
            //! Login Durumuna Yönlendirme Son

        } catch (\Throwable $th) { throw $th; }

    } //! Giriş Kontrol Son

}
