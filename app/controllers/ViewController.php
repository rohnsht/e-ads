<?php

class ViewController extends BaseController{

    public function getAuthToken(){
        $username = Input::get('username');
        $pass = Input::get('password');
        $ip = Input::get('ip');
        
        if(!empty($username) && !empty($pass) && !empty($ip)){
            $data = Application::where("app_id","=",$username)->where("app_key","=",$pass)->get();
            if($data->count()){
                $data = $data->first();
                $category = $data->category;

                $url="http://localhost:8000/api/".$category;

                //Insert ad id and auth token to auth-tokens table 
                $auth = AuthToken::where('ip','=',$ip)->get();
                if(count($auth)){
                    $auth = $auth->first();
                    $auth_tokens = $auth->auth_tokens;
                }else{
                    $auth_tokens = str_random(10);
                    AuthToken::create([
                        'app_id' => $data->id, 
                        'auth_tokens' => $auth_tokens,
                        'ip' => $ip 
                        ]);
                }
                return Response::json(["url"=>$url, "token"=>$auth_tokens]);
            }else{
                return App::abort(404);
            }

        }   
    }

    public function getView(){
        $ads_id = Input::get("id");
        $token = Input::get("token");
        $ip = Input::get("ip");
        $data = AuthToken::where('auth_tokens','=',$token)->first();
        $user_id = Application::where('id','=',$data->app_id)->first();
        $user_id = $user_id->user_id;
        $view = Viewz::where('ads_id','=',$ads_id)
                    ->where('user_id','=',$user_id)
                    ->where('ip','=',$ip)
                    ->where('date','=',date("Y-m-d"))->get();

        if(count($view)){
            $view = $view->first();
            $view->hits = $view->hits + 1;
            $view->save();
        }
        else{
            $views = Viewz::create([
                'user_id' => $user_id, 
                'ads_id' => $ads_id, 
                'views' => 1,
                'date' => date("Y-m-d"),
                'ip' => $ip
            ]);
            if($views){
                return "ok";
            }
        }

    }
}