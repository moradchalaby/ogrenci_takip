<?php

namespace App\Http\Controllers\Root;

use App\Models\Role;
use App\Http\Controllers\Controller;
use \Illuminate\Http\Request;
use \Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

class RoleController extends Controller
{

    public function __construct()
    {

        $this->middleware('can:yetkili');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {
        //
        if (request()->ajax()) {
            $data = Role::select('*')->orderby('parent_id')->get();

            $a = 1;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    if ($row['vazife_id'] == 1) {
                        return '<strong>' . $row['name'] . '</strong>';
                    } else {
                        return $row['name'];
                    }
                })
                ->addColumn('slug', function ($row) {
                    if ($row['vazife_id'] == 1) {
                        return '<strong>' . $row['roles_slug'] . '</strong>';
                    } else {
                        return $row['roles_slug'];
                    }
                })
                ->addColumn('parent', function ($row) {
                    if ($row['vazife_id'] == 1) {
                        return '<strong>' . $row['parent_id'] . '</strong>';
                    } else {
                        return $row['parent_id'];
                    }
                })

                ->addColumn('vazife', function ($row) {
                    if ($row['vazife_id'] == 1) {
                        return '<strong>' . $row['vazife_id'] . '</strong>';
                    } else {
                        return $row['vazife_id'];
                    }
                })
                ->rawColumns(['name', 'slug', 'vazife', 'parent'])
                ->make(true);
        }
        $html = $builder->ajax([

            'url' => route('root.indexpost'),
            'type' => 'Post',
            'data' => "function(d) {


        }",
        ])->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Id'],

            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'slug', 'name' => 'slug', 'title' => 'Slug'],
            ['data' => 'parent', 'name' => 'parent', 'title' => 'Parent'],
            ['data' => 'vazife', 'name' => 'vazife', 'title' => 'Vazife'],

        ])->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)->serverSide(true)->search([
            "caseInsensitive" => true
        ])->parameters([
            'columnDefs' => [
                ['targets' => [2, 3], "orderDataType" => "dom-text", "type" => "locale-compare"],
                ['targets' => [0],  "type" => "numeric"]

            ]
        ])->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');


        $veri['title'] = 'Yetkiler';
        $veri['name'] = 'Yetki';

        return view('root.index', compact('html', 'veri'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
