<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\CommandTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

use App\Categorie;
use App\Formation;
use App\Cour;
use App\Lesson;
use App\Tp;
use App\Examen;
use App\Resolution_tp;
use App\Resolution_examen;
use App\Exercice;
use App\Question;
use App\Choice;
use App\Teacher;
use App\Profile;
use App\Inscription_cour;
use App\Answer;

class TeacherController extends Controller
{
    use CommandTrait;
    
    public function index() {
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $id = Auth::guard('teacher')->user()->id;

        $crs = new Cour;
        $crs = Cour::where('teacher_id', $id)->get();
        $cr_nb = count($crs);

        $tps = new Tp;
        $tps = Tp::where('teacher_id', $id)->get();
        $tp_nb = count($tps);

        $exs = new Examen;
        $exs = Examen::where('teacher_id', $id)->get();
        $ex_nb = count($exs);

        $ex_ids = $exs->pluck('id');
        $res_exs = new Resolution_examen;
        $res_exs = Resolution_examen::whereIn('exam_id', $ex_ids)->get();
        $res_ex_nb = count($res_exs);

        $tp_ids = $tps->pluck('id');
        $res_tps = new Resolution_tp;
        $res_tps = Resolution_tp::whereIn('tp_id', $res_tps)->get();
        $res_tp_nb = count($res_tps);

        return view('teacher.teacher_dashboard', ['cr_nb' => $cr_nb, 'tp_nb' => $tp_nb, 'ex_nb' => $ex_nb, 'res_ex_nb' => $res_ex_nb, 'res_tp_nb' => $res_tp_nb, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function create_cr() {
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $formations = new Formation;
        $formations = Formation::all();
        
        if(count($formations) == 0) {
            echo "SORRY, there is no formation !!!";
        }
        else {
            return view('teacher.create_courses', ['formations' => $formations, 'categories1' => $categories1, 'formations1' => $formations1]);
        }

    }

    public function create_tp() {
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $cours = new Cour;
        $cours = Cour::where('teacher_id', Auth::guard('teacher')->user()->id)->get();

        if(count($cours) == 0) {
            return redirect(route('teacher.create_courses'));
        }
        else {
            return view('teacher.create_tps', ['cours' => $cours, 'categories1' => $categories1, 'formations1' => $formations1]);
        }
        
    }

    public function create_ex() {
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $cours = new Cour;
        $cours = Cour::where('teacher_id', Auth::guard('teacher')->user()->id)->get();

        if(count($cours) == 0) {
            return redirect(route('teacher.create_courses'));
        }
        else {
            return view('teacher.create_exams', ['cours' => $cours, 'categories1' => $categories1, 'formations1' => $formations1]);
        }
        
    }

    public function store_cr(request $request) {
        //
        $formation = new Formation;
        $formation = Formation::where('name', $request->input('formation'))->first();

        //
        $path = $request->file('lesson')->store('lessons', 'public');

        //
        $cour = new Cour;
        $cour->name = $request->input('cr_title');
        $cour->description = $request->input('descr');
        $cour->content = "null";
        $cour->form_id = $formation->id;
        $cour->teacher_id = auth()->user()->id;
        $cour->save();

        //
        $lesson = new Lesson;
        $lesson->name = $request->input('title');
        $lesson->content = $path;
        $lesson->cour_id = $cour->id;
        $lesson->save();

        //
        for($i = 1; $i < $request->input('id'); $i++)
        {
            if($request->has("title".$i)){
                
                $path_plus = $request->file('lesson'.$i)->store('lessons', 'public');

                $lesson_plus = new Lesson;
                $lesson_plus->name = $request->input('title'.$i);
                $lesson_plus->content = $path_plus;
                $lesson_plus->cour_id = $cour->id;
                $lesson_plus->save();
            }
        }

        //
        return redirect(route('teacher.create_courses'));
    }

    public function store_tp(request $request) {
        //
        $cour = new Cour;
        $cour = Cour::where('name', $request->input('cours'))->first();

        //
        $path = $request->file('tp')->store('tps', 'public');

        //
        $tp = new Tp;
        $tp->name = $request->input('tp_title');
        $tp->content = $path;
        $tp->cour_id = $cour->id;
        $tp->teacher_id = auth()->user()->id;
        $tp->save();

        //
        return redirect(route('teacher.create_tps'));
    }

    public function store_exam(request $request) {
        //
        $cour = new Cour;
        $cour = Cour::where('name', $request->input('cours'))->first();
        $cour_id = $cour->id;
        
        $ex = new Examen;
        $ex = Examen::where('cour_id', $cour_id)->first();

        //
        if($ex != null) {
            echo "This course has an exam !!!!";
        }
        //
        else {

            //$name = $request->file('ex')->getClientOriginalName();
            //$path = $request->file('ex')->store('exams', 'public');

            //
            $examen = new Examen;
            $examen->name = $request->input('ex_title');
            $examen->duration = $request->input('duration');
            $examen->open_date = $request->input('op_date');
            $examen->open_hour = $request->input('op_time');
            $examen->state = FALSE;
            $examen->cour_id = $cour_id;
            $examen->teacher_id = auth()->user()->id;
            $examen->save();
            
            //
            

            $exm = new Examen;
            $exm = Examen::where('cour_id', $cour_id)->first();

            $nb_ex = $request->input('nb_ex');
            for ($i = 1; $i <= $nb_ex; $i++) {
                
                $exercice = new Exercice;
                $exercice->examen_id = $exm->id;
                $exercice->save();

                $exercice1 = new Exercice;
                $exercice1 = Exercice::orderBy('id', 'desc')->first();

                $ex = $request->input('ex'.$i);
                for ($j = 1; $j <= $ex; $j++) {
                    
                    $question = new Question;
                    $question->qst_type = $request->input('qst_type'.$j.'_ex'.$i);
                    $question->content =  $request->input('qst_content'.$j.'_ex'.$i);
                    $question->exercice_id = $exercice1->id;

                    if ($request->input('qst_type'.$j.'_ex'.$i) == 'qcm' || $request->input('qst_type'.$j.'_ex'.$i) == 'true/false') {

                        if ($request->input('qst_type'.$j.'_ex'.$i) == 'qcm') {
                            $question->ans_type = $request->input('answers_type'.$j."_ex".$i);
                        }
                        
                        $question->save();

                        $question1 = new Question;
                        $question1 = Question::where('content', $request->input('qst_content'.$j.'_ex'.$i))->first();

                        $ans_nb = $request->input('nb_ans'.$j.'_ex'.$i);

                        for ($k = 1; $k <= $ans_nb; $k++) {

                            $choice = new Choice;
                            $choice->content = $request->input('answer_content'.$k.'_qst'.$j.'_ex'.$i);
                            $choice->question_id = $question1->id;
                            $choice->save();
                        }
                    } else {
                        $question->save();
                        
                        $question2 = new Question;
                        $question2 = Question::where('content', $request->input('qst_content'.$j.'_ex'.$i))->first();

                        $choice = new Choice;
                        $choice->content = 'none';
                        $choice->question_id = $question2->id;
                        $choice->save();
                    }
                }
            }
            return redirect(route('teacher.create_exams'));
            
        }

    }

    public function get_courses_data($id) {

        $cour = new Cour;
        $cour = Cour::where('id', $id)->first();

        $lessons = new Lesson;
        $lessons = Lesson::where('cour_id', $id)->get();

        return response()->json(array("cour" => $cour, "lessons" => $lessons));
    }

    public function update_course(Request $request) {

        $cr_id = $request->input('crid');

        Cour::where('id', $cr_id)->update(['name' => $request->input('cr_name'.$cr_id), 'description' => $request->input('cr_descr'.$cr_id)]);

        $lessons = new Lesson;
        $lessons = Lesson::where('cour_id', $cr_id)->get();

        for ($i = 0; $i < count($lessons); $i++) {

            $path = $request->file("lesson".$i)->store('lessons', 'public');
            Lesson::where('id', $lessons[$i]->id)->update(['name' => $request-> input('ls_title'.$i), 'content' => $path]);
        }

        return redirect()->back();
    }

    public function show_all_tps_solutions() {
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $teacher_id = Auth::guard('teacher')->user()->id;

        $datas = DB::table('tps')->where('tps.teacher_id', '=', $teacher_id)
                ->select('cours.name as cours_name', 'tps.name as tps_name', 'users.name as users_name', 'resolution_tps.created_at as created_at', 'mark', 'resolution_tps.id as restp_id')
                ->join('cours', 'tps.cour_id', '=', 'cours.id')
                ->join('resolution_tps', function ($join) {
                    $join->on('tps.id', '=', 'resolution_tps.tp_id')
                        ->join('users', 'resolution_tps.user_id', '=', 'users.id');
                })
                ->orderBy('tps.name', 'asc')
                ->get();

        $courses_names = $datas->pluck('cours_name');
        $tps = $datas->pluck('tps_name');

        $tps_names = [];

        foreach($tps as $tp) {
            $found = false;
            foreach($tps_names as $tp_name) {
                if ($tp == $tp_name) {
                    $found = true;
                }
            }
            if (!$found) {
                $tps_names[] = $tp;
            }
        }

        return view('teacher.solutions_tps', ['tps_names' => $tps_names, 'datas' => $datas, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    function show_tp_solution_details($id) {
        $categories1 = $this->categ();
        $formations1 = $this->formation();
        
        $data = DB::table('resolution_tps')->where('resolution_tps.id', $id)
                ->select('tps.name as tp_name', 'users.name as user_name', 'resolution_tps.created_at as created_at', 'mark')
                ->join('tps', 'tps.id', '=', 'resolution_tps.tp_id')
                ->join('users', 'users.id', '=', 'resolution_tps.user_id')
                ->first();

        return view('teacher.solution_tp_details', ['resid' => $id, 'data' => $data, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    function update_tp_mark($id, Request $request) {

        Resolution_tp::where('id', $id)->update(['mark'=> $request->input('mark_up')]);

        return redirect()->route('teacher.show_all_tps_solutions');
    }

    function show_all_exams_solutions() {
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $teacher_id = Auth::guard('teacher')->user()->id;

        $datas = DB::table('examens')->where('examens.teacher_id', '=', $teacher_id)
                ->select('cours.name as cours_name', 'examens.name as examens_name','users.id as us_id', 'users.name as users_name', 'resolution_examens.created_at as created_at', 'mark', 'resolution_examens.id as resex_id')
                ->join('cours', 'examens.cour_id', '=', 'cours.id')
                ->join('resolution_examens', function ($join) {
                    $join->on('examens.id', '=', 'resolution_examens.exam_id')
                        ->join('users', 'resolution_examens.user_id', '=', 'users.id');
                })
                ->orderBy('examens.name', 'asc')
                ->get();

        $courses_names = $datas->pluck('cours_name');
        $examens = $datas->pluck('examens_name');

        $examens_names = [];

        foreach($examens as $examen) {
            $found = false;
            foreach($examens_names as $examen_name) {
                if ($examen == $examen_name) {
                    $found = true;
                }
            }
            if (!$found) {
                $examens_names[] = $examen;
            }
        }

        return view('teacher.solutions_exams', ['examens_names' => $examens_names, 'datas' => $datas, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    function show_exam_solution_details(Request $request, $id) {
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $data = DB::table('resolution_examens')->where('resolution_examens.id', '=', $id)
                ->select('resolution_examens.id as resex_id', 'mark', 'resolution_examens.created_at as res_ex_crat',
                    'examens.id as ex_id', 'examens.name as ex_name',
                    'users.id as us_id', 'users.name as us_name')
                ->join('examens', 'resolution_examens.exam_id', '=', 'examens.id')
                ->join('users', 'resolution_examens.user_id', '=', 'users.id')
                ->first();

        $datas = DB::table('exercices')->where('exercices.examen_id', '=', $data->ex_id)
                ->select('exercices.id as exc_id',
                        'questions.id as qst_id', 'qst_type', 'questions.exercice_id as qst_ex_id',
                        'answers.id as ans_id', 'answers.content as ans_con', 'answers.question_id as ans_qst_id')
                ->join('questions', function($join) use($data) {
                    $join->on('questions.exercice_id', '=', 'exercices.id')
                        ->join('answers', 'answers.question_id', '=', 'questions.id')
                        ->where('answers.user_id', $data->us_id);
                })
                ->get();
        
        $exs = $datas->pluck('exc_id');
        $ex_ids = [];

        foreach ($exs as $ex) {
            $found = false;
            foreach ($ex_ids as $ex_id) {
                if ($ex_id == $ex) {
                    $found = true;
                } 
            }
            if (!$found) {
                $ex_ids[] = $ex;
            }
        }

        $qsts = $datas->pluck('qst_ex_id', 'qst_id', 'qst_type');

        return view('teacher.solution_exam_details', ['qsts' => $qsts, 'ex_ids' => $ex_ids, 'datas' => $datas, 'data' => $data, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    function update_exam_mark(Request $request, $id) {

        Resolution_examen::where('id', $id)->update(['mark'=> $request->input('mark_up')]);

        return redirect()->route('teacher.show_all_exams_solutions');
    }

    public function show_teacher_profile() {

        if (Gate::allows('check_teacher_login')) {

            $categories1 = $this->categ();
            $formations1 = $this->formation();

            $user = new Teacher;
            $user = Teacher::where('id', Auth::guard('teacher')->user()->id)->first();

            $profile = new Profile;
            $profile = Profile::where('teacher_id', $user->id)->first();

            return view('profile.profile', ['user'=> $user, 'profile' => $profile, 'categories1' => $categories1, 'formations1' => $formations1]);
        }
        else {
            return redirect(route('welcome'));
        }
    }

    public function update_teacher_profile(Request $request) {

        Teacher::where('id', Auth::guard('teacher')->user()->id)->update(['name' => $request->input('username'), 'birth_date' => $request->input('birth_date')]);
        Profile::where('teacher_id', Auth::guard('teacher')->user()->id)->update(['bio' => $request->input('bio')]);
        
        return redirect()->back();
    }

    public function show_teacher_profile_settings() {
        
        if (Gate::allows('check_teacher_login')) {

            $categories1 = $this->categ();
            $formations1 = $this->formation();

            $user = new Teacher;
            $user = Teacher::where('id', Auth::guard('teacher')->user()->id)->first();

            $profile = new Profile;
            $profile = Profile::where('teacher_id', $user->id)->first();

            return view('profile.profile_settings', ['user' => $user, 'profile' => $profile, 'categories1' => $categories1, 'formations1' => $formations1]);
        }
        else {
            return redirect(route('welcome'));
        }
    }
    
    public function update_teacher_profile_settings(Request $request) {

        $cr_us_id = Auth::guard('teacher')->user()->id;

        $user = new Teacher;
        $user = Teacher::where('id', $cr_us_id)->first();

        if (isset($_POST['change_pass'])) {

            if (Hash::check($request->input('current_pass'), $user->password)) {
                
                if (!Hash::check($request->input('new_pass'), $user->password)) {

                    Teacher::where('id', $cr_us_id)->update(['password'=> Hash::make($request->input('new_pass'))]);
                }

                return redirect()->back();
            }
            else {
                echo 'current password wrong !!!';
            }
        } 
        else if (isset($_POST['change_email'])) {

            if (!($request->input("new_email") == $user->email)) {

                Teacher::where('id', $cr_us_id)->update(['email' => $request->input('new_email')]);
            }

            return redirect()->back();
        }
    }

    public function delete_teacher_profile() {

        $tch = new Teacher;
        $tch = Teacher::where('id', Auth::guard('teacher')->user()->id)->first();

        $profile = new Profile;
        $profile = Profile::where('teacher_id', $tch->id)->first();

        $crs = new Cour;
        $crs = Cour::where('teacher_id', $tch->id)->get();

        if ($crs != null) {
            $cr_ids = $crs->pluck('id');

            $ins_crs = new Inscription_cour;
            $ins_crs = Inscription_cour::whereIn('cour_id', $cr_ids)->get();

            if ($ins_crs != null) {
                foreach ($ins_crs as $ins_cr) {
                    $ins_cr->delete();
                }
            }

            $ls = new Lesson;
            $ls = Lesson::whereIn('cour_id', $cr_ids)->get();

            if ($ls != null) {
                foreach ($ls as $l) {
                    $l->delete();
                }
            }

            $tps = new Tp;
            $tps = Tp::whereIn('cour_id', $cr_ids)->get();

            if ($tps != null) {
                $tp_ids = $tps->pluck('id');

                $res_tps = new Resolution_tp;
                $res_tps = Resolution_tp::whereIn('tp_id', $tp_ids)->get();

                if ($res_tps != null) {
                    foreach ($res_tps as $res_tp) {
                        $res_tp->delete();
                    }
                }

                foreach ($tps as $tp) {
                    $tp->delete();
                }
            }

            $exs = new Examen;
            $exs = Examen::whereIn('cour_id', $cr_ids)->get();

            if ($exs != null) {
                $ex_ids = $exs->pluck('id');

                $res_exs = new Resolution_examen;
                $res_exs = Resolution_examen::whereIn('exam_id', $ex_ids)->get();

                if ($res_exs != null) {
                    foreach ($res_exs as $res_ex) {
                        $res_ex->delete();
                    }
                }

                $excs = new Exercice;
                $excs = Exercice::whereIn('examen_id', $ex_ids)->get();

                if ($excs != null) {
                    $exc_ids = $excs->pluck('id');

                    $qsts = new Question;
                    $qsts = Question::whereIn('exerice_id', $excs)->get();

                    if ($qsts != null) {
                        $qst_ids = $qsts->pluck('id');

                        $ans = new Answer;
                        $ans = Answer::whereIn('question_id', $qst_ids)->get();

                        if ($ans != null) {
                            foreach ($ans as $an) {
                                $an->delete();
                            }
                        }

                        $chs = new Choice;
                        $chs = Choice::whereIn('question_id', $qts_ids)->get();

                        if ($chs != null) {
                            foreach ($chs as $ch) {
                                $ch->delete();
                            }
                        }

                        foreach ($qsts as $qst) {
                            $qst->delete();
                        }
                    }

                    foreach ($excs as $exc) {
                        $exc->delete();
                    }
                }

                foreach ($exs as $ex) {
                    $ex->delete();
                }
            }

            foreach ($crs as $cr) {
                $cr->delete();
            }
        }
        
        $profile->delete();
        $tch->delete();

        return redirect(route('welcome'));
    }

    public function show_my_courses() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $courses = new Cour;
        $courses = Cour::where('teacher_id', Auth::guard('teacher')->user()->id)->get();

        return view('teacher.my_courses', ['courses' => $courses, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function show_my_tps() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $courses = new Cour;
        $courses = Cour::where('teacher_id', Auth::guard('teacher')->user()->id)->get();

        $cr_ids = $courses->pluck('id');

        $tps = new Tp;
        $tps = Tp::whereIn('cour_id', $cr_ids)->get();

        return view('teacher.my_tps', ['tps' => $tps, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function delete_my_tps($id) {

        $tp = new Tp;
        $tp = Tp::where('id', $id)->first();

        $res_tps = new Resolution_tp;
        $res_tps = Resolution_tp::where('tp_id', $id)->get();

        if ($res_tps != null) {
            foreach ($res_tps as $res_tp) {
                $res_tp->delete();
            }
        }

        $tp->delete();

        return redirect(route('teacher.show_my_tps'));

    }

    public function show_my_exams() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $courses = new Cour;
        $courses = Cour::where('teacher_id', Auth::guard('teacher')->user()->id)->get();

        $cr_ids = $courses->pluck('id');

        $exams = new Examen;
        $exams = Examen::whereIn('cour_id', $cr_ids)->get();

        return view('teacher.my_exams', ['exams' => $exams, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function delete_my_exams($id) {

        $examen = new Examen;
        $examen = Examen::where('id', $id)->first();

        $res_exs = new Resolution_examen;
        $res_exs = Resolution_examen::where('exam_id', $id)->get();

        if ($res_exs != null) {
            foreach ($res_exs as $res_ex) {
                $res_ex->delete();
            }
        }

        $excs = new Exercice;
        $excs = Exercice::where('examen_id', $id)->get();

        if ($excs != null) {
            $exc_ids = $excs->pluck('id');

            $qsts = new Question;
            $qsts = Question::whereIn('exercice_id', $exc_ids)->get();

            if ($qsts != null) {
                $qst_ids = $qsts->pluck('id');

                $chs = new Choice;
                $chs = Choice::whereIn('question_id', $qst_ids)->get();

                if ($chs != null) {
                    foreach ($chs as $ch) {
                        $ch->delete();
                    }
                }

                $ans = new Answer;
                $ans = Answer::whereIn('question_id', $qst_ids)->get();

                if ($ans != null) {
                    foreach ($ans as $an) {
                        $an->delete();
                    }
                }

                foreach ($qsts as $qst) {
                    $qst->delete();
                }
            }

            foreach ($excs as $exc) {
                $exc->delete();
            }
        }

        $examen->delete();

        return redirect(route('teacher.show_my_exams'));
    }

    public function update_my_tps($id, Request $request) {

        $path = $request->file('tp_cont'.$id)->store('tps', 'public');

        Tp::where('id', $id)->update(['name' => $request->input('tp_name'.$id), 'content' => $path]);

        return redirect(route('teacher.show_my_tps'));
    }
}
