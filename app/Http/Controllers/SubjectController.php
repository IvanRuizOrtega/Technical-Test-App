<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Subject;

use App\Http\Requests\Subject\Create;
use App\Http\Requests\Subject\Update;

use App\Constants\Constant;

class SubjectController extends Controller
{
    private $subject_;

    public function __construct(Subject $subject) 
    {
        $this->middleware(Constant::AUTH);

        $this->subject_ = $subject;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = $this->subject_->search($request->search)->orderBy(Constant::SORT_BY, Constant::DESC)->simplePaginate(Constant::PAGE_NUMBER);

        return view('subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('subject.create');
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
                $this->subject_->create(
                    [
                        'name'  => $request->name,
                    ]
                );
            }
        );
    
        return redirect()->route(Constant::SUBJECT_HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Subject $subject)
    {
        DB::transaction(function () use ( $request, $subject ) 
            {
                $subject->update(
                    [
                        'name'  => $request->name,
                    ]
                );
            }
        );

        return redirect()->route(Constant::SUBJECT_HOME);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        DB::transaction(function () use ( $subject ) 
            {
                $subject->delete();
            }
        );

    return redirect()->route(Constant::SUBJECT_HOME);
    }
}
