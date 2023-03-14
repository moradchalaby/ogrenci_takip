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
        $this->middleware('can:root');

        //|| $this->middleware('can:root');
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
                ->addColumn(
                    'action',
                    function ($row) {
                        $btn = ' <a type="button" class="btn btn-success reset btn-xs editmodal" data-toggle="modal" data-id="' . $row['id'] . '"
                                          data-target="#modalEdit">
                                           <i class="fa-solid fa-pen-to-square"></i>
                                      </a>


                                      <a id="rolesil" type="button" class="btn btn-danger btn-xs" data-id="' . $row['id'] . '">

<i class="fa-solid fa-trash"></i>                    </a>';
                        return $btn;
                    }
                )

                ->rawColumns(['name', 'slug', 'vazife', 'parent', 'action'])
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
            ['data' => 'action', 'name' => 'action', 'title' => 'İşlemler'],

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
        if ($request->ajax()) {
            $data = Role::create(
                [
                    'name' => $request->name,
                    'roles_slug' => $request->roles_slug,
                    'parent_id' => $request->parent,
                    'vazife_id' => $request->vazife,
                ]

            );

            return response()->json($data);
        }
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
    public function edit(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Role::find($request->id);
            return response()->json($data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Role::where('id', $request->id)->update([
                'name' => $request->name,
                'roles_slug' => $request->slug,
                'parent_id' => $request->parent,
                'vazife_id' => $request->vazife
            ]);
            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Role::where('id', $request->id)->delete();
            return response()->json($data);
        }
    }
}
