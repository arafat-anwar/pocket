<?php

namespace Modules\Peoples\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB, DataTables;

use \App\Models\User;
use Modules\Setups\Entities\Role;
use Modules\Setups\Entities\Permission;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        request()->merge([
            'anyPermissionArray' => makeResourcePermissions('users'),
            'allPermissionArray' => []
        ]);
        $this->middleware('check_permission');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (request()->ajax() && request()->has('draw')) {
            return DataTables::of(
                    User::with([
                        'roles'
                    ])
                )
                ->addIndexColumn()
                
                ->editColumn('image', function($user){
                    return '<img src="'.userImage($user).'" style="height: 80px"/>';
                })

                ->addColumn('roles', function($user){
                    return $user->roles->pluck('name')->implode(', ');
                })
                ->filterColumn('roles', function($query, $keyword){
                    return $query->whereHas('roles', function($query) use($keyword){
                        return $query->where(function($query) use($keyword){
                            return $query->where('name', 'LIKE', '%'.$keyword.'%');
                        });
                    });
                })

                ->addColumn('actions', function($user){
                    return view('layouts.crudButtons',[
                        'text' => 'User',
                        'object' => $user,
                        'link' => 'peoples/users',
                        'permission' => 'users',
                        'edit_link' => true,
                    ])->render();
                })
                ->rawColumns(['image', 'actions'])
                ->toJson();
        }
        return view('peoples::users.index', [
            'headerColumns' => headerColumns('users')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data = [
            'roles' => Role::all(),
            'modules' => Permission::orderBy('module', 'asc')->groupBy('module')->pluck('module')->toArray(),
            'permissions' => Permission::all(),

            'suppliers' => Supplier::all(),
            'customers' => Customer::all(),
            'employees' => Employee::all(),
        ];
        return view('peoples::users.create', $data);
    }

    public function getRoles($request){
        $roles = Role::whereIn('id', (isset($request->roles[0]) ? $request->roles : []))->pluck('name')->toArray();

        foreach(['supplier', 'customer', 'employee'] as $type){
            if($request->type == $type && !empty($request->$type.'_id')){
                $roles[] = ucwords($type);
            }
        }

        return $roles;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'gender' => 'required',
            'roles' => 'required_if:type,admin',
            'roles.*' => 'required',
            'password' => 'required|min:6|confirmed',
            'image_file' => 'nullable|image|max:2048',
            
            'type' => 'required',
            'supplier_id'  => 'required_if:type,supplier',
            'customer_id'  => 'required_if:type,customer',
            'employee_id'  => 'required_if:type,employee'
        ]);

        DB::beginTransaction();
        try{
            $user = new User();
            $user->fill($request->all());
            $user->password = bcrypt($request->password);
            $user->save();

            if($request->hasFile('image_file')){
                $fileInfo = fileInfo($request->image_file);
                $name = rand().'-'.rand().'.'.$fileInfo['extension'];
                if(fileUpload($request->image_file, 'uploads/user-images', $name)){
                    $user->image = 'uploads/user-images/'.$name;
                    $user->save();
                }
            }

            $user->syncRoles($this->getRoles($request));

            $permissions = Permission::whereIn('id', (isset($request->permissions[0]) ? $request->permissions : []))->pluck('name')->toArray();
            $user->syncPermissions($permissions);

            DB::commit();
            success('User has been Created.');
            return response()->json([
                'success' => true,
            ]);
        } catch (\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = [
            'user' => User::findOrFail($id),
            'roles' => Role::all(),
            'modules' => Permission::orderBy('module', 'asc')->groupBy('module')->pluck('module')->toArray(),
            'permissions' => Permission::all(),
            'existingPermissions' => DB::table('role_has_permissions')->where('role_id', request()->get('role_id'))->pluck('permission_id')->toArray(),

            'suppliers' => Supplier::all(),
            'customers' => Customer::all(),
            'employees' => Employee::all(),
        ];
        return view('peoples::users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'username' => 'required|unique:users,username,'.$id,
            'gender' => 'required',
            'roles' => 'required_if:type,admin',
            'roles.*' => 'required',
            'password' => 'nullable|min:6|confirmed',
            'image_file' => 'nullable|image|max:2048',

            'type' => 'required',
            'supplier_id'  => 'required_if:type,supplier',
            'customer_id'  => 'required_if:type,customer',
            'employee_id'  => 'required_if:type,employee'
        ]);

        DB::beginTransaction();
        try{
            $user = User::findOrFail($id);
            $password = $user->password;
            $user->fill($request->all());
            if(!empty($request->password)){
                $user->password = bcrypt($request->password);
            } else {
                $user->password = $password;
            }
            $user->save();

            if($request->hasFile('image_file')){
                $fileInfo = fileInfo($request->image_file);
                $name = rand().'-'.rand().'.'.$fileInfo['extension'];
                if(fileUpload($request->image_file, 'uploads/user-images', $name)){
                    if(!empty($user->image)){
                        fileDelete($user->image);
                    }
                    $user->image = 'uploads/user-images/'.$name;
                    $user->save();
                }
            }

            $user->syncRoles($this->getRoles($request));

            $permissions = Permission::whereIn('id', (isset($request->permissions[0]) ? $request->permissions : []))->pluck('name')->toArray();
            $user->syncPermissions($permissions);

            DB::commit();
            success('User has been updated.');
            return response()->json([
                'success' => true,
            ]);
        } catch (\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            if(User::find($id)->delete()){
                if(!empty($user->image)){
                    fileDelete($user->image);
                }
                DB::commit();
                return response()->json([
                    'success' => true
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ]);
        }catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
