<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Course;
use App\Models\Subject;

use App\Http\Requests\Course\Create;
use App\Http\Requests\Course\Update;

use App\Constants\Constant;

class CourseController extends Controller
{
    private $course_;

    public function __construct(Course $course) 
    {
        $this->middleware(Constant::AUTH);

        $this->course_ = $course;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = $this->course_->search($request->search)->orderBy(Constant::SORT_BY, Constant::DESC)->simplePaginate(Constant::PAGE_NUMBER);

        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();

        return view ('course.create', compact('subjects'));
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
                $course = $this->course_->create(
                    [
                        'name'  => $request->name,
                    ]
                );
                
                $course->subjects()->syncWithoutDetaching($request->subject);
                
            }
        );
        
        return redirect()->route(Constant::COURSE_HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $subjects = Subject::all();

        return view('course.edit', compact('course', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Course $course)
    {
        DB::transaction(function () use ( $request, $course ) 
            {
                $course->update(
                    [
                        'name'  => $request->name,
                    ]
                );

                if ($request->subject) 
                {
                    $course->subjects()->syncWithoutDetaching($request->subject);
                }                
            }
        );

        return redirect()->route(Constant::COURSE_HOME);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        DB::transaction(function () use ( $course ) 
            {
                $course->delete();
            }
        );

        return redirect()->route(Constant::COURSE_HOME);
    }
}
