<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Redirect;
use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Contracts\LoginResponse;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        
        Fortify::registerview(function(){
            return view('auth.register');
        });

        Fortify::loginview(function(){
            return view('auth.login');
        });

        RateLimiter::for('login', function(Request $request){
            $email = (string) $request->email;

            return Limit::perMinute(100)->by($email . $request->ip());
        });

        Fortify::redirects([
            'login' => '/',
        ]);

        $this->app->bind(FortifyLoginRequest::class, LoginRequest::class);	
        
        $this->app->instance(
            RegisterResponse::class,
            new class implements RegisterResponse{
                public function toResponse($request)
                {
                    return redirect('/mypage/profile');
                }
            }
        );

        $this->app->instance(
            LoginResponse::class,
            new class implements LoginResponse{
                public function toResponse($request)
                {
                    return redirect('/')
                }
            }
        )
    }
}
