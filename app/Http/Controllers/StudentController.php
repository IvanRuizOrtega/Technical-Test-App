<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Student;
use App\Models\IdentificationType;
use App\Models\Course;

use App\Http\Requests\Student\Create;
use App\Http\Requests\Student\Update;

use App\Constants\Constant;

class StudentController extends Controller
{
    private $student_;

    public function __construct(Student $student) 
    {
        $this->middleware(Constant::AUTH);

        $this->student_ = $student;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = $this->student_->with('identificationType','course')->search($request->search)->orderBy(Constant::SORT_BY, Constant::DESC)->simplePaginate(Constant::PAGE_NUMBER);

        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $identificationTypes = IdentificationType::all();

        $courses = Course::all();

        return view ('student.create', compact('identificationTypes', 'courses') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Create $request)
    {

        DB::transaction(function () use ( $request ) 
            {
                $student = $this->student_->create(
                    [
                        'name'                   => $request->name,
                        'email'                  => $request->email,
                        'identification'         => $request->identification,
                        'identification_type_id' => $request->typeOfIdentification,
                        'course_id'              => $request->course
                    ]
                );

                //$course = Course::firstWhere('id', $request->course);

                //$student->subjects()->syncWithoutDetaching($course->subjects);
            }
        );
        
        return redirect()->route(Constant::STUDENT_HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $identificationTypes = IdentificationType::all();

        $courses = Course::all();

        return view('student.edit', compact('student', 'identificationTypes', 'courses'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Student $student)
    {
        DB::transaction(function () use ( $request, $student ) 
            {
                $student->update(
                    [
                        'name'                   => $request->name,
                        'email'                  => $request->email,
                        'identification'         => $request->identification,
                        'identification_type_id' => $request->typeOfIdentification,
                        'course_id'              => $request->course
                    ]
                );

                //$course = Course::firstWhere('id', $request->course);

                //$student->subjects()->syncWithoutDetaching($course->subjects);
            }
        );

        return redirect()->route(Constant::STUDENT_HOME);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        DB::transaction(function () use ( $student ) 
            {
                $student->delete();
            }
        );

        return redirect()->route(Constant::STUDENT_HOME);
    }
}
