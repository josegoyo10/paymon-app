<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth; 

class CourseController extends Controller
{
    public function index(User $user)
    {
   
        $courses = DB::table('courses')
              ->join('registers', 'courses.id', '=', 'registers.course_id')
              ->select('courses.id', 'courses.title', 'courses.description','courses.category_id','courses.age_group')
              ->where('registers.user_id','=', $user->id)
              ->get();

        return response()->json(['message' => 'mis cursos', 'courses' => $courses], 201);
    }

    public function registerUser(Request $request, Course $course, User $user)
    {

        $register = Register::create([
            'user_id' => $user->id,
            'course_id' => $course->id
        ]);


        return response()->json(['message' => 'Usuario registrado exitosamentexxx', 'registro' => $register], 201);
    }

    public function search(Request $request)
    {
        //dd("llego search controller");
        $filters = $request->only(['age_group', 'category_id', 'name']);

        $query = Course::query();

        if (!empty($filters['age_group'])) {
            $query->where('age_group', $filters['age_group']);
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['name'])) {
            $query->where('title', 'like', "%{$filters['name']}%");
        }

        $courses = $query->get();

        return response()->json(['courses' => $courses]);
    }

    public function store(Request $request)
    {
        //dd("llego controlador");
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'age_group' => 'required|in:5-8,9-13,14-16,16+'
        ]);


        // Creación del curso
        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'age_group' => $request->age_group,
        ]);

        return response()->json(['message' => 'Curso creado exitosamente', 'course' => $course], 201);
    }
}
