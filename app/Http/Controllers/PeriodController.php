<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Period;

use App\Http\Requests\Period\Create;
use App\Http\Requests\Period\Update;

use App\Constants\Constant;

class PeriodController extends Controller
{
    private $period_;

    public function __construct(Period $period) 
    {
        $this->middleware(Constant::AUTH);

        $this->period_ = $period;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $periods = $this->period_->search($request->search)->orderBy(Constant::SORT_BY, Constant::DESC)->simplePaginate(Constant::PAGE_NUMBER);

        return view('period.index', compact('periods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('period.create');
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
                $this->period_->create(
                    [
                        'name'  => $request->name,
                    ]
                );
            }
        );
        return redirect()->route(Constant::PERIOD_HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function show(Period $period)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function edit(Period $period)
    {
        return view('period.edit', compact('period'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Period $period)
    {
        DB::transaction(function () use ( $request, $period ) 
            {
                $period->update(
                    [
                        'name'  => $request->name,
                    ]
                );
            }
        );
        
        return redirect()->route(Constant::PERIOD_HOME);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy(Period $period)
    {
        DB::transaction(function () use ( $period ) 
            {
                $period->delete();
            }
        );

        return redirect()->route(Constant::PERIOD_HOME);
    }
}
