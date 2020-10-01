<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Lesson;
use App\Inscription_cour;
use App\Examen;
use App\Resolution_examen;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        /*Gate::define('check', function ($user, $id) {

            $lesson = new Lesson;
            $lesson = Lesson::where('id', $id)->first();

            $contraint = ['cour_id' => $lesson->cour_id, 'user_id' => $user->id];

            if (Inscription_cour::where($contraint)->exists()) {
                return true;
            }
            else {
                return false;
            }
        });*/

        Gate::define('check_exm_res', function($user, $id) {

            $contraint = ['exam_id' => $id, 'user_id' => $user->id];

            if (Resolution_examen::where($contraint)->exists()) {
                return false;
            }
            else {
                return true;
            }
        });

        Gate::define('check_user_subscription', function($user, $id) {

            $examen = new Examen;
            $examen = Examen::where('id', $id)->first();

            $contraint = ['user_id' => $user->id, 'cour_id' => $examen->cour_id];

            if (Inscription_cour::where($contraint)->exists()) {
                return true;
            }
            else {
                return false;
            }
        });

        Gate::define('check_start_exam_requirements', function($user, $id) {

            $examen = new Examen;
            $examen = Examen::where('id', $id)->first();

            $ex_open = $examen->open_date." ".$examen->open_hour;

            $open_time = explode(':', $examen->open_hour);

            $close_hour = (int)$open_time[0] + (int)$examen->duration;

            if ((int)($close_hour / 10) == 0) {
                $close_hour = "0".$close_hour;
            } 

            $ex_close = $examen->open_date." ".$close_hour.":".$open_time[1].":".$open_time[2];
            
            $time = Carbon::now("Africa/Algiers");
            /*echo $ex_open;
            echo "<br>";
            echo $time;
            echo "<br>";
            echo $ex_close;
            echo "<br>";*/

            if (strcmp($time, $ex_open) > 0 && strcmp($time, $ex_close) < 0) {
                return true;
            } 
            else {
                return false;
            }
        });

        Gate::define('check_student_login', function() {

            return Auth::guard('web')->user();
        });

        Gate::define('check_teacher_login', function() {

            return Auth::guard('teacher')->user();
        });

        Gate::define('check_admin_login', function() {

            return Auth::guard('admin')->user();
        });
    }
}
