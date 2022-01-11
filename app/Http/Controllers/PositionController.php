<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePositionRequest;
use App\Http\Requests\EditPositionRequest;
use App\Models\Position;

class PositionController extends Controller
{
    public function index()
    {
        return view('positions.index');
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(CreatePositionRequest $request)
    {
        Position::create($request->validated());

        return redirect()->route('positions.index')->with('success', 'New position has been created.');
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(EditPositionRequest $request, Position $position)
    {
        $position->update($request->validated());

        return redirect()->route('positions.index')->with('success', 'Position has been successfully updated.');
    }

    public function destroy(Position $position)
    {
        if ($position->employees->count()) {
            return redirect()->back()->with('error', 'Can not delete. Position belongs to employee(s).');
        }

        $position->delete();

        return redirect()->route('positions.index')->with('success', 'Position has been deleted.');
    }
}
