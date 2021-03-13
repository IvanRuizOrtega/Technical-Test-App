<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Student;
use App\Models\Note;
use App\Models\Period;

use App\Http\Requests\Note\Create;

use App\Constants\Constant;

class StudentNoteController extends Controller
{   
    private $note_;

    public function __construct(Note $note) 
    {
        $this->middleware(Constant::AUTH);

        $this->note = $note;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Student $student)
    {
        $course = $student->course;

        return view('student-note.index', compact('student', 'course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Student $student)
    {

        $course = $student->course;

        $periods = Period::all();

        return view('student-note.create', compact('student', 'course', 'periods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Create $request, Student $student)
    {
        DB::transaction(function () use ( $request, $student ) 
            {
                $this->note->create(
                    [
                        'course_id'  => $student->course_id,
                        'subject_id' => $request->subject,
                        'student_id' => $student->id,
                        'period_id'  => $request->period,
                        'note'       => $request->note,
                    ]
                );
            }
        );
    
        return redirect()->route(Constant::STUDENT_HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
