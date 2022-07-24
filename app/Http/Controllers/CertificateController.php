<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'name' => 'mhd',
            'subject' => 'sub',
            'creator' => 'teacher',
            'date' => Carbon::now()->format('Y-M-d')
        ];
//       return view('cert',['data'=>$data]);
        $pdf = Pdf::loadView('cert', ['data'=>$data])->setPaper('a4','landscape');

        return $pdf->download('cert.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Badge $badge
     * @return \Illuminate\Http\Response
     */
    public function show(Badge $badge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Badge $badge
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Badge $badge)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Badge $badge
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Badge $badge)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Badge $badge
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Badge $badge)
    {

    }
}
