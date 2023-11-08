<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\professional; // Import the Professional model
class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
   

     public function boot()
     {
        
         view()->composer('*', function ($view) {
            if (Auth::check()) {
                $professional = Auth::user();
                $professional_id = $professional->professional_id;
                $user = Professional::where('professional_id', $professional_id)->first();
                
            $view->with('user', $user);
            }
            
            
         });
     }
     
     
}
