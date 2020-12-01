<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $options = Option::paginate(10);

        return view('option.index', compact(
            'options'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $action = route('options.store');
        $option = null;

        return view('option.form', compact(
            'action',
            'option'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        Option::create($request->all());

        Session::flash('success', __('Option has been created successfully!'));

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Option $option
     * @return Response
     */
    public function edit(Option $option)
    {
        $action = route('options.update', $option);

        return view('option.form', compact(
            'action',
            'option'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Option $option
     * @return void
     * @throws ValidationException
     */
    public function update(Request $request, Option $option)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $option->fill($request->all());
        $option->save();

        Session::flash('success', __('Option has been updated successfully!'));

        return redirect()->route('options.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Option $option
     * @return Response
     * @throws Exception
     */
    public function destroy(Option $option)
    {
        $option->products()->detach();
        $option->delete();

        Session::flash('success', __('Option has been deleted successfully!'));

        return back();
    }
}
