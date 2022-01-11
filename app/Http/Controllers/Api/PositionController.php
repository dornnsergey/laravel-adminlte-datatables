<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Yajra\DataTables\Facades\DataTables;


class PositionController extends Controller
{
    public function getPositions()
    {
        $token = getallheaders()['token'];
        $positions = Position::select([
            'id',
            'name',
            'updated_at'
        ]);

        return Datatables::of($positions)
            ->addColumn('updated_at', function ($position) {
                return $position->updated_at->format('d.m.y');
            })
            ->addColumn('action', function ($position) {
                return view('positions.column-edit', compact('position'));
            })
            ->addColumn('delete', function ($position) use ($token) {
                return view('positions.column-delete', compact('position', 'token'));
            })
            ->make(true);
    }
}
