<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\CommandTrait;

use App\Categorie;
use App\Formation;
use App\Cour;
use App\Teacher;
use App\Lesson;
use App\Examen;
use App\Tp;
use App\Inscription_cour;

class MainController extends Controller
{
    use CommandTrait;

    public function show_index() {
        $categories1 = $this->categ();
        $formations1 = $this->formation();
        
        return view('welcome', ['categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function show_about() {
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        return view('about', ['categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function show_formation_details(Request $request, $id) {
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $formation = new Formation;
        $formation = Formation::find($id);

        $categ = new Categorie;
        $categ = Categorie::where('id', $formation->categ_id)->first();

        $cours = new Cour;
        $cours = Cour::where('form_id', $id)->get();

        $cr_ids = $this->check_course_creator($request, $id);
        $check_teacher = false;
        if (Auth::guard('teacher')->check()) {
            $check_teacher = true;
        }

        return view('formations_details', ['categ' => $categ, 'check_teacher' => $check_teacher, 'cr_ids' => $cr_ids, 'formation' => $formation, 'cours' => $cours, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function show_course_details($id) {
        return $this->course_details($id);
    }

    public function course_subscription(Request $request) {

        $inscr_cr = new Inscription_cour;
        $inscr_cr->cour_id = $request->route('id');
        $inscr_cr->user_id = auth()->user()->id;
        $inscr_cr->save();
        $msg = "hello";
        return redirect('/course/'.$request->route('id'));
    }

    public function teacher_delete_course(Request $request) {

        if ($request->has('crid')) {
            
            $this->delete_course($request->input('crid'));

            return redirect()->back()->with('congrats', 'did well');
        }
    }

    public function get_search_data(Request $request) {
        
        $str = $request->input('str');

        if ( $str != '') {
            $pattern = "/^".$str."/i";        

            $cours = new Cour;
            $cours = Cour::all();

            $cours_names = $cours->pluck('name');

            $result = [];
            $cour_data = new Cour;

            foreach($cours_names as $name) {
                if (preg_match($pattern, $name) == 1) {
                    $cour_data = Cour::where('name', $name)->first();
                    $result[] = $cour_data;
                }
            }    
        }
        
        return response()->json(array("result" => $result));
    }
}
