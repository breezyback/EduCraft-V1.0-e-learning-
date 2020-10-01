<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\CommandTrait;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Categorie;
use App\Cour;
use App\Inscription_cour;
use App\Resolution_tp;
use App\Resolution_examen;
use App\Tp;
use App\Lesson;
use App\Examen;
use App\Teacher;
use App\Profile;
use App\User;
use App\Question;
use App\Answer;

class StudentController extends Controller
{
    use CommandTrait;

    public function index() {
        $categories1 = $this->categ();
        $formations1 = $this->formation();
        
        $id = auth()->user()->id;

        $inscr_cr = new Inscription_cour;
        $inscr_cr = Inscription_cour::where('user_id', $id)->get();
        $nb_cr = count($inscr_cr);

        $res_tp = new Resolution_tp;
        $res_tp = Resolution_tp::where('user_id', $id)->get();
        $nb_tp = count($res_tp);

        $res_ex = new Resolution_examen;
        $res_ex = Resolution_examen::where('user_id', $id)->get();
        $nb_ex = count($res_ex);

        return view('student.student_dashboard', ['cr' => $nb_cr, 'tp' => $nb_tp, 'ex' => $nb_ex, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function show_courses() {
        $categories1 = $this->categ();
        $formations1 = $this->formation();
        //
        $id = auth()->user()->id;

        $inscr_cours = new Inscription_cour;
        $inscr_cours = Inscription_cour::where('user_id', $id)->get();
        $inscr_cour_ids = $inscr_cours->pluck('cour_id');

        $cours = new Cour;
        $cours = Cour::whereIn('id', $inscr_cour_ids)->get();
        
        return view('student.cours', ['cours' => $cours, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function show_details($id) {
        return $this->course_details($id);
    }

    public function delete_course($id) {

        $incr_cr = new Inscription_cour;
        $incr_cr = Inscription_cour::where(['cour_id'=> $id, 'user_id' => Auth::guard()->user()->id])->first();
        $incr_cr->delete();

        return redirect(route('student.courses'));
    }

    public function show_student_profile() {

        if (Gate::allows('check_student_login')) {

            $categories1 = $this->categ();
            $formations1 = $this->formation();

            $user = new User;
            $user = User::where('id', Auth::guard('')->user()->id)->first();

            $profile = new Profile;
            $profile = Profile::where('user_id', $user->id)->first();

            return view('profile.profile', ['user'=> $user, 'profile' => $profile, 'categories1' => $categories1, 'formations1' => $formations1]);
        }
        else {
            return redirect(route('welcome'));
        }
        
    }

    public function show_student_profile_settings() {

        if (Gate::allows('check_student_login')) {

            $categories1 = $this->categ();
            $formations1 = $this->formation();

            $user = new User;
            $user = User::where('id', Auth::guard('')->user()->id)->first();

            $profile = new Profile;
            $profile = Profile::where('user_id', $user->id)->first();

            return view('profile.profile_settings', ['user' => $user, 'profile' => $profile, 'categories1' => $categories1, 'formations1' => $formations1]);
        }
        else {
            return redirect(route('welcome'));
        }
        
    }

    public function update_student_profile(Request $request) {
        
        User::where('id', Auth::guard('web')->user()->id)->update(['name' => $request->input('username'), 'birth_date' => $request->input('birth_date')]);
        Profile::where('user_id', Auth::guard('')->user()->id)->update(['bio' => $request->input('bio')]);
        
        return redirect()->back();
    }

    public function update_student_profile_settings(Request $request) {

        $cr_us_id = Auth::guard('web')->user()->id;

        $user = new User;
        $user = User::where('id', $cr_us_id)->first();

        if (isset($_POST['change_pass'])) {

            if (Hash::check($request->input('current_pass'), $user->password)) {
                
                if (!Hash::check($request->input('new_pass'), $user->password)) {

                    User::where('id', $cr_us_id)->update(['password'=> Hash::make($request->input('new_pass'))]);
                }

                return redirect()->back();
            }
            else {
                echo 'current password wrong !!!';
            }
        } 
        else if (isset($_POST['change_email'])) {

            if (!($request->input("new_email") == $user->email)) {

                User::where('id', $cr_us_id)->update(['email' => $request->input('new_email')]);
            }

            return redirect()->back();
        }
    }

    public function delete_student_profile() {

        $std = new User;
        $std = User::where('id', Auth::guard('web')->user()->id)->first();

        $profile = new Profile;
        $profile = Profile::where('user_id', $std->id)->first();

        $ins_crs = new Inscription_cour;
        $ins_crs = Inscription_cour::where('user_id', $std->id)->get();

        if ($ins_crs != null) {
            foreach ($ins_crs as $ins_cr) {
                $ins_cr->delete();
            }
        }

        $res_tps = new Resolution_tp;
        $res_tps = Resolution_tp::where('user_id', $std->id)->get();

        if ($res_tps != null) {
            foreach ($res_tps as $res_tp) {
                $res_tp->delete();
            }
        }

        $res_exs = new Resolution_examen;
        $res_exs = Resolution_examen::where('user_id', $std->id)->get();

        if ($res_exs != null) {
            foreach ($res_exs as $res_ex) {
                $res_ex->delete();
            }
        }

        $ans = new Answer;
        $ans = Answer::where('user_id', $std->id)->get();

        if ($ans != null) {
            foreach ($ans as $an) {
                $an->delete();
            }
        }

        $profile->delete();
        $std->delete();

        return redirect(route('welcome'));
    }

    public function pass_exam($id) {

        $examen = new Examen;
        $examen = Examen::where('id', $id)->first();

        if (Gate::allows('check_user_subscription', $id)) {

            if (Gate::allows('check_exm_res', $id)) {

                $categories1 = $this->categ();
                $formations1 = $this->formation();

                $cour = new Cour;
                $cour = Cour::where('id', $examen->cour_id)->first();

                return view('student.pass_exam', ['cour_name' => $cour->name, 'examen' => $examen, 'categories1' => $categories1, 'formations1' => $formations1]);
            }
            else {
                return redirect(url("/course/".$examen->cour_id));
            }

        }
        else {
            return redirect(url("/course/".$examen->cour_id));
        }
        
    }

    public function start_exam($id) {

        if (Gate::allows('check_user_subscription', $id)) {

            if (Gate::allows('check_start_exam_requirements', $id)) {

                if (Gate::allows('check_exm_res', $id)) {

                    $categories1 = $this->categ();
                    $formations1 = $this->formation();

                    $passed_exam = false;

                    if (Resolution_examen::where(['exam_id'=> $id, 'user_id' => Auth::guard('')->user()->id])->exists()) {
                        $passed_exam = true;
                    }

                    $examen = new Examen;
                    $examen = Examen::where('id', $id)->first();

                    $ex_time = explode(':', $examen->open_hour);

                    $cour = new Cour;
                    $cour = Cour::where('id', $examen->cour_id)->first();

                    $datas = DB::table('exercices')->where('exercices.examen_id', $id)
                            ->select('exercices.id as exc_id', 
                                    'questions.id as qst_id', 'qst_type', 'ans_type', 'questions.content as qst_con', 'exercice_id', 
                                    'choices.id as ch_id', 'choices.content as ch_con', 'question_id')
                            ->join('questions', function ($join) {
                                $join->on('exercices.id', '=', 'questions.exercice_id')
                                    ->join('choices', 'questions.id', '=', 'choices.question_id');
                            })
                            ->get();

                    $exercice_ids = $datas->pluck('exc_id');
                    $exercice_ids2 = [];

                    foreach($exercice_ids as $exercice_id) {
                        $found = false;
                        foreach($exercice_ids2 as $exercice_id2) {
                            if ($exercice_id2 == $exercice_id) {
                                $found = true;
                            }
                        }
                        if (!$found) {
                            $exercice_ids2[] = $exercice_id;
                        }
                    }

                    $qst_ids = $datas->pluck('qst_id');
                    $qst_ids2 = [];

                    foreach($qst_ids as $qst_id) {
                        $found = false;
                        foreach($qst_ids2 as $qst_id2) {
                            if ($qst_id2 == $qst_id) {
                                $found = true;
                            }
                        }
                        if (!$found) {
                            $qst_ids2[] = $qst_id;
                        }
                    }

                    $qsts = new Question;
                    $qsts = Question::whereIn('id', $qst_ids2)->get();

                    //var_dump(count($qsts));

                    return view('student.start_exam', ['passed_exam' => $passed_exam, 'qsts' => $qsts, 'exercice_ids' => $exercice_ids2, 'ex_time' => $ex_time, 'examen' => $examen, 'cour' => $cour, 'datas' => $datas, 'categories1' => $categories1, 'formations1' => $formations1]);
                }
                else {
                    return redirect(route('student.dashboard'));
                }
            } 
            else {
                return redirect(url("/student/pass/exams/".$id));
            }
        } 
        else {
            return redirect(route('student.dashboard'));
        }
    }

    public function submit_exam(Request $request, $id) {

        if (Resolution_examen::where(['exam_id'=> $id, 'user_id' => Auth::guard('')->user()->id])->exists()) {
            return "You passed this exam";
        }
        else {

            $res_ex = new Resolution_examen;
            $res_ex->exam_id = $id;
            $res_ex->user_id = Auth::guard('')->user()->id;
            $res_ex->save();

            for($i = 0; $i < $request->input("nb_ex"); $i++) {
                
                for($j = 1; $j <= $request->input("nbqst_ex".$i); $j++) {

                    for($k = 0; $k <= $request->input("nbch_ex".$i."_qst".$j); $k++) {

                        if ($request->exists("ex".$i."_qst".$j."_ch".$k)) {
                            if ($request->exists("qstid_ex".$i."_qst".$j)) {

                                $answer = new Answer;
                                $answer->user_id = Auth::guard('')->user()->id;
                                $answer->question_id = $request->input("qstid_ex".$i."_qst".$j);
                                $answer->content = $request->input("ex".$i."_qst".$j."_ch".$k);
                                $answer->save();
            
                            }
                        }

                    }

                }
                
            }

            return redirect(route('student.dashboard'));
        }
        
    }

    public function show_exams_todo() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $cours = new Inscription_cour;
        $cours = Inscription_cour::where('user_id', Auth::guard('web')->user()->id)->get();

        $cour_ids = $cours->pluck('id');

        $exs = new Examen;
        $exs = Examen::whereIn('cour_id', $cour_ids)->get();

        return view('student.exams_todo', ['cours' => $cours, 'exs' => $exs, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function show_tps_todo() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $cours = new Inscription_cour;
        $cours = Inscription_cour::where('user_id', Auth::guard('web')->user()->id)->get();

        $cour_ids = $cours->pluck('id');

        $tps = new Tp;
        $tps = Tp::whereIn('cour_id', $cour_ids)->get();

        return view('student.tps_todo', ['cours' => $cours, 'tps' => $tps, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

}
