<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //Veri Tabanı İşlemleri
use App\Models\Customer; //! Müşteri
use App\Imports\CustomerImport; //! Import Class
use Maatwebsite\Excel\Facades\Excel; //! Excel


class App extends Controller
{
    
    //Anasayfa
    public function index($site_lang="tr")
    {
        \Illuminate\Support\Facades\App::setLocale($site_lang); //! Çoklu Dil
        //echo "Dil:"; echo $site_lang;  echo "<br/>";  die();
        
        try {

            //! Tanım
            $yildirimdev_userCheck = 0; //! Kullanıcı Onay
            if(isset($_COOKIE["yildirimdev_userID"])) {  
                $yildirimdev_userCheck = 1; 
                $yildirimdev_email = $_COOKIE["yildirimdev_email"];
                $yildirimdev_roleID = $_COOKIE["yildirimdev_roleID"];
            } //! Kullanıcı Giriş Durumu

            //? Session Varmı
            if(session('status')=="succes") {   //echo "session var"; die();

                $yildirimdev_userCheck = 1; //! Kullanıcı Giriş Durumu
                setcookie("yildirimdev_userID",session('yildirimdev_userID'),time()+86400);  //! id
                setcookie("yildirimdev_email",session('yildirimdev_email'),time()+86400);  
                setcookie("yildirimdev_name",session('yildirimdev_name'),time()+86400);  
                setcookie("yildirimdev_surname",session('yildirimdev_surname'),time()+86400);  
                setcookie("yildirimdev_roleID",session('yildirimdev_roleID'),time()+86400); 

                //! Veriler
                $yildirimdev_email = session('yildirimdev_email');
                $yildirimdev_roleID = session('yildirimdev_roleID');

            } //? Session Varmı Son


            //! Sayfa Yönlendirme
            if($yildirimdev_userCheck == 0) {  return redirect('/'.__('admin.lang').'/'.'login/');  }  //! Giriş Yok
            else { //echo "Kullanıcı giriş var"; die();
            
                //? Müşteriler
                $dbCustomer= DB::table('customer')->get(); //? Tüm Veriler
                //echo "<pre>"; print_r($dbCustomer); die();

                //! Return
                $DB['yildirimdev_email'] = $yildirimdev_email;
                $DB['yildirimdev_roleID'] = $yildirimdev_roleID;
                $DB['dbCustomer'] = $dbCustomer ;

                return view('home',$DB);

            }
         
            
        } catch (\Throwable $th) {
            throw $th;
        }
    } 


    //Kullanıcı Giriş
    public function login($site_lang="tr")
    {
        \Illuminate\Support\Facades\App::setLocale($site_lang); //! Çoklu Dil
        //echo "Dil:"; echo $site_lang;  echo "<br/>";  die();

        //! Çerezleri Sil
        setcookie("yildirimdev_userID","", time() - 86400,'/'); //! Cookie Silme
        setcookie("yildirimdev_email","", time() - 86400,'/'); //! Cookie Silme
        setcookie("yildirimdev_name","", time() - 86400,'/'); //! Cookie Silme
        setcookie("yildirimdev_surname","", time() - 86400,'/'); //! Cookie Silme
        setcookie("yildirimdev_roleID","", time() - 86400,'/'); //! Cookie Silme

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

                $yildirimdev_userID = $DB_Where->id;
                $yildirimdev_email = $DB_Where->email;
                $yildirimdev_name = $DB_Where->name;
                $yildirimdev_surname = $DB_Where->surname;
                $yildirimdev_roleID = $DB_Where->role;
            }
            
            //! Login Durumuna Yönlendirme
            if($loginCheck == 1) { 
                //echo "Login Oldu"; die();

               
                return redirect('/'.__('admin.lang'))->with('status',"succes")
                    ->with('yildirimdev_userID',$yildirimdev_userID)->with('yildirimdev_email',$yildirimdev_email)
                    ->with('yildirimdev_name',$yildirimdev_name)->with('yildirimdev_surname',$yildirimdev_surname)->with('yildirimdev_roleID',$yildirimdev_roleID);
          
            }
            else {  return redirect('/'.__('admin.lang').'/admin/login')->with('status',"error")->with('msg', __('admin.theEmailPasswordMayBeIncorrect')); }
            //! Login Durumuna Yönlendirme Son

        } catch (\Throwable $th) { throw $th; }

    } //! Giriş Kontrol Son


    //! Excel Import
    public function importPost(Request $request)
    {

       try {
        
         //dd($request->file('file'));
         Excel::import(new CustomerImport, $request->file('file'));

         return redirect('/tr')->with('status_import',"succes")->with('msg','Excel import edildi');
        
       } catch (\Throwable $th) {

         return redirect('/tr')->with('status_import',"error")->with('msg','Excel Hatası: Dosya Yüklenemedi');
       
       }

    }
    //! Excel Import Son

}
