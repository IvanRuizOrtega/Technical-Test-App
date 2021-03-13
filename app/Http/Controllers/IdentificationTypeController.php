<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\IdentificationType;

use App\Http\Requests\IdentificationType\Create;
use App\Http\Requests\IdentificationType\Update;

use App\Constants\Constant;

class IdentificationTypeController extends Controller
{
    private $identificationType_;

    public function __construct(IdentificationType $identificationType) 
    {
        $this->middleware(Constant::AUTH);

        $this->identificationType_ = $identificationType;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $identificationTypes = $this->identificationType_->search($request->search)->orderBy(Constant::SORT_BY, Constant::DESC)->simplePaginate(Constant::PAGE_NUMBER);

        return view('identification-type.index', compact('identificationTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('identification-type.create');
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
                $this->identificationType_->create(
                    [
                        'name'  => $request->name,
                    ]
                );
            }
        );
        return redirect()->route(Constant::ID_TYPE_HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function show(IdentificationType $identificationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentificationType $identificationType)
    {
        return view('identification-type.edit', compact('identificationType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, IdentificationType $identificationType)
    {
        DB::transaction(function () use ( $request, $identificationType ) 
            {
                $identificationType->update(
                    [
                        'name'  => $request->name,
                    ]
                );
            }
        );

        return redirect()->route(Constant::ID_TYPE_HOME);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentificationType $identificationType)
    {
        DB::transaction(function () use ( $identificationType ) 
            {
                $identificationType->delete();
            }
        );

        return redirect()->route(Constant::ID_TYPE_HOME);
    }
}
