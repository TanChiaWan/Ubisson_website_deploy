<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\professional;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
class AppServiceProvider extends ServiceProvider
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
        
        Validator::extend('dependent_filled', function ($attribute, $value, $parameters, $validator) {
            $otherField = $parameters[0];
            $otherValue = $validator->getData()[$otherField];
            
            return empty($value) || !empty($otherValue);
        });

   
        if (auth()->check()) {
            $professional = Professional::where('professional_id', auth()->user()->id)->first();
            View::share('professional', $professional);
        }



    }
}
