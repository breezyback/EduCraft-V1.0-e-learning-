<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\CommandTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

use App\Categorie;
use App\Formation;
use App\Cour;
use App\Inscription_cour;
use App\Tp;
use App\Resolution_tp;
use App\Examen;
use App\Resolution_examen;
use App\Exercice;
use App\Choice;
use App\Answer;
use App\Question;
use App\Lesson;
use App\Admin;
use App\User;
use App\Teacher;
use App\Profile;

class AdminController extends Controller
{
    use CommandTrait;
    
    public function index() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $std_nb = User::count();
        $tch_nb = Teacher::count();
        $adm_nb = Admin::count();
        $categ_nb = Categorie::count();
        $form_nb = Formation::count();
        $cour_nb = Cour::count();
        $tp_nb = Tp::count();
        $ex_nb = Examen::count();
        $res_ex_nb = Resolution_examen::count();
        $res_tps_nb = Resolution_tp::count();

        return view('admin.admin_dashboard', ['std_nb' => $std_nb, 'tch_nb' => $tch_nb, 'adm_nb' => $adm_nb, 'categ_nb' => $categ_nb, 'form_nb' => $form_nb,
                    'cour_nb' => $cour_nb, 'tp_nb' => $tp_nb, 'ex_nb' => $ex_nb, 'res_ex_nb' => $res_ex_nb, 'res_tps_nb' => $res_tps_nb, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function show_categories_list() {
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        return view('admin.categories_administration.categories_list', ['categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function update_category(Request $request, $id) {

        Categorie::where('id', $id)->update(['name' => $request->input('cat_title'.$id), 'description' => $request->input('cat_descr'.$id)]);

        return redirect()->back();
    }

    public function delete_category($id) {

        $formations = new Formation;
        $formations = Formation::where('categ_id', $id)->get();

        $category = new Categorie;
        $category = Categorie::find($id);

        if ($formations == null) {
            $category->delete();
        }
        else {

            $form_ids = $formations->pluck('id');

            $courses = new Cour;
            $courses = Cour::whereIn('form_id', $form_ids)->get();

            if ($courses == null) {
                foreach ($formations as $formation) {
                    $formation->delete();
                }
                $category->delete();
            }
            else {
                
                $cour_ids = $courses->pluck('id');

                $ins_crs = new Inscription_cour;
                $ins_crs = Inscription_cour::whereIn('cour_id', $cour_ids)->get();

                if (!$ins_crs == null) {
                    foreach ($ins_crs as $ins_cr) {
                        $ins_cr->delete();
                    }
                }

                $tps = new Tp;
                $tps = Tp::whereIn('cour_id', $cour_ids)->get();

                if (!$tps == null) {

                    $tp_ids = $tps->pluck('id');

                    $res_tps = new Resolution_Tp;
                    $res_tps = Resolution_Tp::whereIn('tp_id', $tp_ids)->get();

                    if (!$res_tps == null) {
                        foreach ($res_tps as $res_tp) {
                            $res_tp->delete();
                        }
                    }

                    foreach ($tps as $tp) {
                        $tp->delete();
                    }
                }

                $examens = new Examen;
                $examens = Examen::whereIn('cour_id', $cour_ids)->get();

                if ($examens != null) {

                    $ex_ids = $examens->pluck('id');

                    $res_exs = new Resolution_examen;
                    $res_exs = Resolution_examen::whereIn('exam_id', $ex_ids)->get();

                    if ($res_exs != null) {
                        foreach ($res_exs as $res_ex) {
                            $res_ex->delete();
                        }
                    }

                    $exercices = new Exercice;
                    $exercices = Exercice::whereIn('examen_id', $ex_ids)->get();

                    if ($exercices != null) {

                        $exc_ids = $exercices->pluck('id');

                        $qsts = new Question;
                        $qsts = Question::whereIn('exercice_id', $exc_ids)->get();

                        if ($qsts != null) {

                            $qst_ids = $qsts->pluck('id');

                            $chs = new Choice;
                            $chs = Choice::whereIn('question_id', $qst_ids)->get();

                            if ($chs != null) {
                                foreach($chs as $ch) {
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

                        foreach ($exercices as $exercice) {
                            $exercice->delete();
                        }
                    }

                    foreach ($examens as $examen) {
                        $examen->delete();
                    }
                }

                $lessons = new Lesson;
                $lessons = Lesson::whereIn('cour_id', $cour_ids)->get();

                if ($lessons != null) {
                    foreach ($lessons as $lesson) {
                        $lesson->delete();
                    }
                }

                foreach ($courses as $course) {
                    $course->delete();
                }

            }
            foreach ($formations as $formation) {
                $formation->delete();
            }
        }
        $category->delete();

        return redirect()->back();
    }

    public function show_create_category() {
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        return view('admin.categories_administration.create_category', ['categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function create_category(Request $request) {

        $cat = new Categorie;
        $cat->name = $request->input('cat_title');
        $cat->description = $request->input('cat_descr');
        $cat->save();

        return redirect(route('admin.show_categories_list'));
    }

    public function show_formations_list() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $formations = new Formation;
        $formations = Formation::all();

        return view('admin.formations_administration.formations_list', ['formations' => $formations, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function update_formation(Request $request, $id) {

        Formation::where('id', $id)->update(['name' => $request->input('form_title'.$id), 'description' => $request->input('form_descr'.$id), 'categ_id' => $request->input('categ_title'.$id)]);

        return redirect(route('admin.show_formations_list'));

    }

    public function delete_formation($id) {

        $formation = new Formation;
        $formation = Formation::where('id', $id)->first();

        $courses = new Cour;
        $courses = Cour::where('form_id', $id)->get();

        if ($courses == null) {
            $formation->delete();
        }
        else {
            
            $cour_ids = $courses->pluck('id');

            $ins_crs = new Inscription_cour;
            $ins_crs = Inscription_cour::whereIn('cour_id', $cour_ids)->get();

            if (!$ins_crs == null) {
                foreach ($ins_crs as $ins_cr) {
                    $ins_cr->delete();
                }
            }

            $tps = new Tp;
            $tps = Tp::whereIn('cour_id', $cour_ids)->get();

            if (!$tps == null) {

                $tp_ids = $tps->pluck('id');

                $res_tps = new Resolution_Tp;
                $res_tps = Resolution_Tp::whereIn('tp_id', $tp_ids)->get();

                if (!$res_tps == null) {
                    foreach ($res_tps as $res_tp) {
                        $res_tp->delete();
                    }
                }

                foreach ($tps as $tp) {
                    $tp->delete();
                }
            }

            $examens = new Examen;
            $examens = Examen::whereIn('cour_id', $cour_ids)->get();

            if ($examens != null) {

                $ex_ids = $examens->pluck('id');

                $res_exs = new Resolution_examen;
                $res_exs = Resolution_examen::whereIn('exam_id', $ex_ids)->get();

                if ($res_exs != null) {
                    foreach ($res_exs as $res_ex) {
                        $res_ex->delete();
                    }
                }

                $exercices = new Exercice;
                $exercices = Exercice::whereIn('examen_id', $ex_ids)->get();

                if ($exercices != null) {

                    $exc_ids = $exercices->pluck('id');

                    $qsts = new Question;
                    $qsts = Question::whereIn('exercice_id', $exc_ids)->get();

                    if ($qsts != null) {

                        $qst_ids = $qsts->pluck('id');

                        $chs = new Choice;
                        $chs = Choice::whereIn('question_id', $qst_ids)->get();

                        if ($chs != null) {
                            foreach($chs as $ch) {
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

                    foreach ($exercices as $exercice) {
                        $exercice->delete();
                    }
                }

                foreach ($examens as $examen) {
                    $examen->delete();
                }
            }

            $lessons = new Lesson;
            $lessons = Lesson::whereIn('cour_id', $cour_ids)->get();

            if ($lessons != null) {
                foreach ($lessons as $lesson) {
                    $lesson->delete();
                }
            }

            foreach ($courses as $course) {
                $course->delete();
            }

        }
        $formation->delete();

        return redirect()->back();
    }

    public function show_create_formation() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        return view('admin.formations_administration.create_formation', ['categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function create_formation(Request $request) {

        if (!Formation::where(['name' => $request->input('form_title'), 'categ_id' => $request->input('categ_title')])->exists()) {
            
            $formation = new Formation;
            $formation->name = $request->input('form_title');
            $formation->description = $request->input('form_descr');
            $formation->categ_id = $request->input('categ_title');
            $formation->save();

        }
        return redirect(route('admin.show_formations_list'));
    }

    public function show_courses_list() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $courses = DB::table('cours')
                ->select('cours.id as cr_id', 'cours.name as cr_n', 'cours.description as cr_desc', 'cours.created_at as cr_cr_at', 'cours.updated_at as cr_up_at',
                        'teachers.name as tch_n')
                ->join('teachers', 'cours.teacher_id', '=', 'teachers.id')
                ->get();

        return view('admin.resources_administration.courses_list', ['courses' => $courses, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function delete_course($id) {

        $this.delete_course($id);

        return redirect(route('admin.show_courses_list'));
    }

    public function show_exams_list() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $examens = DB::table('examens')
                ->select('examens.id as ex_id', 'examens.name as ex_n', 'duration', 'open_date', 'open_hour', 'state', 'examens.created_at as ex_cr_at',
                        'teachers.name as tch_n')
                ->join('teachers', 'examens.teacher_id', '=', 'teachers.id')
                ->get();

        return view('admin.resources_administration.exams_list', ['examens' => $examens, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function delete_exam($id) {

        $ex = new Examen;
        $ex = Examen::where('id', $id)->first();

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

        $ex->delete();

        return redirect(route('admin.show_exams_list'));
    }

    public function show_tps_list() {
        
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $tps = DB::table('tps')
                ->select('tps.id as tp_id', 'tps.name as tp_n', 'tps.created_at as tp_cr_at',
                        'teachers.name as tch_n')
                ->join('teachers', 'tps.teacher_id', '=', 'teachers.id')
                ->get();

        return view('admin.resources_administration.tps_list', ['tps' => $tps, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function delete_tp($id) {

        $res_tps = new Resolution_tp;
        $res_tps = Resolution_tp::where('tp_id', $id)->get();

        if ($res_tps != null) {
            foreach ($res_tps as $res_tp) {
                $res_tp->delete();
            }
        }

        $tp = new Tp;
        $tp = Tp::where('id', $id)->first();
        $tp->delete();

        return redirect(route('admin.show_tps_list'));
    }

    public function show_admins_list() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $admins = new Admin;
        $admins = Admin::all();

        return view('admin.accounts_administration.admins.admins_accounts_list', ['admins' => $admins, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function reset_password_admin(Request $request, $id) {

        Admin::where('id', $id)->update(['password' => Hash::make($request->input('adm_pass'.$id))]);

        return redirect(route('admin.show_admins_list'));
    }

    public function update_admin(Request $request, $id) {

        Admin::where('id', $id)->update(['name' => $request->input('adm_n'.$id), 'birth_date' => $request->input('adm_d'.$id), 'email' => $request->input('adm_email'.$id)]);

        return redirect(route('admin.show_admins_list'));
    }

    public function delete_admin($id) {

        $admin = new Admin;
        $admin = Admin::where('id', $id)->first();

        $profile = new Profile;
        $profile = Profile::where('admin_id', $id);
        $profile->delete();

        $admin->delete();

        return redirect(route('admin.show_admins_list'));
    }

    public function show_create_admin_account() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        return view('admin.accounts_administration.admins.create_admin_account', ['categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function create_admin_account(Request $request) {

        if (Admin::where('email', $request->input('admin_email'))->exists()) {
            return redirect(route('admin.show_admins_list'));
        }
        else {
            $admin = new Admin;
            $admin->name = $request->input('admin_n');
            $admin->birth_date = $request->input('admin_d');
            $admin->email = $request->input('admin_email');
            $admin->password = Hash::make($request->input('admin_pass'));
            $admin->save();
            
            $adm = new Admin;
            $adm = Admin::where('email', $request->input('admin_email'))->first();

            $profile = new Profile;
            $profile->admin_id = $adm->id;
            $profile->save();

            return redirect(route('admin.show_admins_list'));
        }
    }

    public function show_teachers_list() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $teachers = new Teacher;
        $teachers = Teacher::all();

        return view('admin.accounts_administration.teachers.teachers_accounts_list', ['teachers' => $teachers, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function update_teacher(Request $request, $id) {

        Teacher::where('id', $id)->update(['name' => $request->input('teacher_n'.$id), 'birth_date' => $request->input('teacher_d'.$id), 'num' => $request->input('teacher_num'.$id), 'email' => $request->input('teacher_email'.$id)]);

        return redirect(route('admin.show_teachers_list'));
    }

    public function delete_teacher($id) {

        $teacher = new Teacher;
        $teacher = Teacher::where('id', $id)->first();

        $profile = new profile;
        $profile = Profile::where('teacher_id', $id)->first();

        $courses = new Cour;
        $courses = Cour::where('teacher_id', $id)->get();

        if ($courses != null) {
            $cr_ids = $courses->pluck('id');

            $ins_cours = new Inscription_cour;
            $ins_cours = Inscription_cour::whereIn('cour_id', $cr_ids)->get();

            if ($ins_cours != null) {
                foreach ($ins_cours as $ins_cour) {
                    $ins_cour->delete();
                }
            }

            $lessons = new Lesson;
            $lessons = Lesson::whereIn('cour_id', $cr_ids)->get();

            if ($lessons != null) {
                foreach ($lessons as $lesson) {
                    $lesson->delete();
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

            $exams = new Examen;
            $exams = Examen::whereIn('cour_id', $cr_ids)->get();

            if ($exams != null) {
                $ex_ids = $exams->pluck('id');

                $res_exs = new Resolution_examen;
                $res_exs = Resolution_examen::whereIn('exam_id', $ex_ids)->get();

                if ($res_exs != null) {
                    foreach ($res_exs as $res_ex) {
                        $res_ex->delete();
                    }
                }

                $exercices = new Exercice;
                $exercices = Exercice::whereIn('examen_id', $ex_ids)->get();

                if ($exercices != null) {
                    $exc_ids = $exercices->pluck('id');

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

                    foreach ($exercices as $exercice) {
                        $exercice->delete();
                    }
                }

                foreach ($exams as $exam) {
                    $exam->delete();
                }
            }

            foreach ($courses as $course) {
                $course->delete();
            }
        }

        $profile->delete();
        $teacher->delete();

        return redirect(route('admin.show_teachers_list'));
    }

    public function show_create_teacher_account() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        return view('admin.accounts_administration.teachers.create_teacher_account', ['categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function create_teacher_account(Request $request) {

        if (Teacher::where('email', $request->input('teacher_email'))->exists() || Teacher::where('num', $request->input('teacher_num'))->exists()) {
            return redirect(route('admin.show_teachers_list'));
        }
        else {
            $teacher = new Teacher;
            $teacher->name = $request->input('teacher_n');
            $teacher->birth_date = $request->input('teacher_d');
            $teacher->num = $request->input('teacher_num');
            $teacher->email = $request->input('teacher_email');
            $teacher->password = Hash::make($request->input('teacher_pass'));
            $teacher->save();

            $tch = new Teacher;
            $tch = Teacher::where('email', $request->input('teacher_email'))->first();

            $profile = new Profile;
            $profile->teacher_id = $tch->id;
            $profile->save();

            return redirect(route('admin.show_teachers_list'));
        }
    }

    public function show_students_list() {

        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $students = new User;
        $students = User::all();

        return view('admin.accounts_administration.students.students_accounts_list', ['students' => $students, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function update_student(Request $request, $id) {

    }

    public function delete_student($id) {

        $student = new User;
        $student = User::where('id', $id)->first();

        $ins_crs = new Inscription_cour;
        $ins_crs = Inscription_cour::where('user_id', $id)->get();

        if ($ins_crs != null) {
            foreach ($ins_crs as $ins_cr) {
                $ins_cr->delete();
            }
        }

        $res_tps = new Resolution_tp;
        $res_tps = Resolution_tp::where('user_id', $id)->get();

        if ($res_tps != null) {
            foreach ($res_tps as $res_tp) {
                $res_tp->delete();
            }
        }

        $res_exs = new Resolution_examen;
        $res_exs = Resolution_examen::where('user_id', $id)->get();

        if ($res_exs != null) {
            foreach ($res_exs as $res_ex) {
                $res_ex->delete();
            }
        }

        $ans = new Answer;
        $ans = Answer::where('user_id', $id)->get();

        if ($ans != null) {
            foreach ($ans as $an) {
                $an->delete();
            }
        }

        $profile = new Profile;
        $profile = Profile::where('user_id', $id);

        if ($profile != null) {
            $profile->delete();
        }

        $student->delete();

        return redirect(route('admin.show_students_list'));
    }

    public function show_admin_profile() {

        if (Gate::allows('check_admin_login')) {

            $categories1 = $this->categ();
            $formations1 = $this->formation();

            $user = new Admin;
            $user = Admin::where('id', Auth::guard('admin')->user()->id)->first();

            $profile = new Profile;
            $profile = Profile::where('admin_id', $user->id)->first();

            return view('profile.profile', ['user'=> $user, 'profile' => $profile, 'categories1' => $categories1, 'formations1' => $formations1]);
        }
        else {
            return redirect(route('welcome'));
        }
    }

    public function update_admin_profile(Request $request) {

        Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $request->input('username'), 'birth_date' => $request->input('birth_date')]);
        Profile::where('admin_id', Auth::guard('admin')->user()->id)->update(['bio' => $request->input('bio')]);

        return redirect(route('profile.show_admin_profile'));
    }

    public function show_admin_profile_settings() {

        if (Gate::allows('check_admin_login')) {

            $categories1 = $this->categ();
            $formations1 = $this->formation();

            $user = new Admin;
            $user = Admin::where('id', Auth::guard('admin')->user()->id)->first();

            $profile = new Profile;
            $profile = Profile::where('admin_id', $user->id)->first();

            return view('profile.profile_settings', ['user' => $user, 'profile' => $profile, 'categories1' => $categories1, 'formations1' => $formations1]);
        }
        else {
            return redirect(route('welcome'));
        }
    }

    public function update_admin_profile_settings(Request $request) {

        $cr_ad_id = Auth::guard('admin')->user()->id;

        $admin = new Admin;
        $admin = Admin::where('id', $cr_ad_id)->first();

        if (isset($_POST['change_pass'])) {

            if (Hash::check($request->input('current_pass'), $admin->password)) {
                
                if (!Hash::check($request->input('new_pass'), $admin->password)) {

                    Admin::where('id', $cr_ad_id)->update(['password'=> Hash::make($request->input('new_pass'))]);
                }

                return redirect()->back();
            }
            else {
                echo 'current password wrong !!!';
            }
        } 
        else if (isset($_POST['change_email'])) {

            if (!($request->input("new_email") == $admin->email)) {

                Admin::where('id', $cr_ad_id)->update(['email' => $request->input('new_email')]);
            }

            return redirect()->back();
        }
    }

    public function delete_admin_profile() {

        $admin = new Admin;
        $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        $profile = new Profile;
        $profile = Profile::where('admin_id', $admin->id)->first();
        $profile->delete();
        $admin->delete();

        return redirect(route('welcome'));
    }

}
