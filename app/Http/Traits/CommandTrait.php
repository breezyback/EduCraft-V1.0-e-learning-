<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Categorie;
use App\Formation;
use App\Cour;
use App\Teacher;
use App\Lesson;
use App\Examen;
use App\Tp;
use App\Inscription_cour;
use App\Resolution_tp;
use App\Resolution_examen;
use App\Exercice;
use App\Question;
use App\Choice;
use App\Answer;

trait CommandTrait {

    // return all categorie records
    public function categ() {

        $categories = new Categorie;
        $categories = Categorie::all();

        return $categories;
    }

    // return an array of arrays and every array represent all formations records for a specific category
    public function formation() {

        $formations[] = new Formation();
        $categories = $this->categ();
        $categ_id = $categories->pluck('id');

        for($i = 0; $i < count($categ_id); $i++) 
        {
            $formations[$i] = Formation::where('categ_id', $categ_id[$i])->get();
        }

        return $formations;
    }
    
    // check if the student is registered for a specific course or not
    public function check_register_course($id) {

        $counter = 0;
        $inscr_cours = new Inscription_cour;
        $inscr_cours = Inscription_cour::where('cour_id', $id)->get();

        if($inscr_cours != null) 
        {

            if(Auth::check()) 
            {

                foreach($inscr_cours as $inscr_cour)
                {
                    if($inscr_cour->user_id == Auth()->guard()->user()->id) {
                        $counter++;
                    }
                }

                if($counter > 0) 
                {
                    return true;
                }
                else 
                {
                    return false;
                }

            }
            else 
            {
                return false;
            }

        }
        else 
        {
            return false;
        }
    }

    // return the details of a specific course
    public function course_details($id) {
        // this 2 lines are for search by viewing categories
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        // Retrieve course record width specific id
        $cour = new Cour;
        $cour = Cour::find($id);

        $nb_sub = Inscription_cour::count('cour_id', $id);

        // Retrieve what formation record the course belong to 
        $formation = new Formation;
        $formation = Formation::find($cour->form_id);

        // Retrieve what categorie record the formation belong to
        $categorie = new Categorie;
        $categorie = Categorie::find($formation->categ_id);

        // 
        $inscrit = $this->check_register_course($id);

        if(Auth::guard('teacher')->check()) 
        {
            if($cour->teacher_id == Auth::guard('teacher')->user()->id)
            {
                $inscrit = true;
            }
        }

        // Retrieve what teacher record has created the course
        $teacher = new Teacher;
        $teacher = Teacher::where('id', $cour->teacher_id)->get();

        // Retrieve all lesson records for the course
        $lessons = new Lesson;
        $lessons = Lesson::where('cour_id', $id)->get();

        // Retrieve all tp records for the course
        $tps = new Tp;
        $tps = Tp::where('cour_id', $id)->get();

        // Retrieve Exam record for the course 
        $examens = new Examen;
        $examens = Examen::where('cour_id', $id)->get();

        return view('student.cours_details', ['nb_sub' => $nb_sub, 'formation' => $formation, 'categorie' => $categorie, 'inscrit' => $inscrit, 'teacher' => $teacher, 'cour' => $cour, 'lessons' => $lessons, 'tps' => $tps, 'examens' => $examens, 'categories1' => $categories1, 'formations1' => $formations1], compact('inscrit'), compact('teacher'));
    }

    public function check_course_creator(Request $request, $id) {

        if(Auth::guard('teacher')->check()) {
            $cour_cr = new Cour;
            $cour_cr = Cour::where(['form_id' => $id, 'teacher_id' => Auth::guard('teacher')->user()->id])->get();
            $cr_ids;
            if($cour_cr != null) {
                $cour_cr_id = $cour_cr->pluck('id');
                return $cour_cr_id;
            }
        } else {
            return false;
        }
        
    }

    public function delete_all_subscriptions_for_course($course_id) {

        $incr_cr = new Inscription_cour;
        $incr_cr = Inscription_cour::where('cour_id', $course_id)->get();
        foreach ($incr_cr as $inscr) {
            $inscr->delete();
        }
    }

    public function delete_course($course_id) {

        $this->delete_all_subscriptions_for_course($course_id);

        $lessons = new Lesson;
        $lessons = Lesson::where('cour_id', $course_id)->get();
            
        $tps = new TP;
        $tps = Tp::where('cour_id', $course_id)->get();

        $ex = new Examen;
        $ex = Examen::where('cour_id', $course_id)->first();

        $cour = new Cour;
        $cour = Cour::where('id', $course_id)->first();

        if ($lessons != null) {
            foreach ($lessons as $lesson) {
                $lesson->delete();
            }
        }

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

        if ($ex != null) {

            $res_exs = new Resolution_examen;
            $res_exs = Resolution_examen::where('exam_id', $ex->id)->get();

            if ($res_exs != null) {
                foreach ($res_exs as $res_ex) {
                    $res_ex->delete();
                }
            }

            $excs = new Exercice;
            $excs = Exercice::where('examen_id', $ex->id)->get();

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
        }

        $cour->delete();
    }
    
}