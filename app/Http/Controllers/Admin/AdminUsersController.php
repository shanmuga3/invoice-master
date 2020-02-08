<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\AdminUsersDataTable;
use App\Models\Admin;
use App\Models\Role;
use Lang;

class AdminUsersController extends Controller
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->base_path = 'admin.admin_users.';
        $this->base_url = route('admin.admin_users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminUsersDataTable $dataTable)
    {
        return $dataTable->render($this->base_path.'view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['result'] = new Admin;
        $data['roles'] = Role::get()->pluck('name','id');
        return view($this->base_path.'add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'username' => 'required|max:20',
            'password'  => 'required|min:8',
            'email'     => 'required|email|unique:admins,email',
            'role'      => 'required|integer',
            'status'    => 'required',
        );

        $attributes = array(
            'username' => 'User Name',
            'password'  => 'Password',
            'email'     => 'Email',
            'role'      => 'Role',
            'status'    => 'Status',
        );

        $request->validate($rules,[],$attributes);

        $validated = $request->only(['username','password','email','status']);

        $admin = Admin::create($validated);

        $admin->attachRole($request->role);

        flashMessage('success', Lang::get('admin_messages.success'), Lang::get('admin_messages.added_successfully'));
        return redirect($this->base_url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['result'] = Admin::with('roles')->findOrFail($id);
        $data['role_id'] = $data['result']->roles[0]->id;
        $data['roles'] = Role::get()->pluck('name','id');
        return view($this->base_path.'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'username' => 'required|max:20',
            'password'  => 'nullable|min:8',
            'email'     => 'required|email|unique:admins,email,'.$id,
            'role'      => 'required|integer',
            'status'    => 'required',
        );

        $attributes = array(
            'username' => 'User Name',
            'password'  => 'Password',
            'email'     => 'Email',
            'role'      => 'Role',
            'status'    => 'Status',
        );

        $request->validate($rules,[],$attributes);

        $admin = Admin::Find($id);
        $admin->username = $request->username;
        $admin->email    = $request->email;
        if($request->password != '') {
            $admin->password = $request->password;
        }
        $admin->status   = $request->status;
        $admin->save();

        $admin->roles()->sync($request->role);

        flashMessage('success', Lang::get('admin_messages.success'), Lang::get('admin_messages.updated_successfully'));

        return redirect($this->base_url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $can_destroy = $this->canDestroy($id);
        
        if(!$can_destroy['status']) {
            flashMessage('danger', Lang::get('admin_messages.failed'), $can_destroy['status_message']);
            return redirect($this->base_url);
        }
        
        try {
            Admin::find($id)->delete();
            flashMessage('success', Lang::get('admin_messages.success'), Lang::get('admin_messages.delete_success'));
        }
        catch (Exception $e) {
            flashMessage('danger', Lang::get('admin_messages.failed'), $e->getMessage());
        }

        return redirect($this->base_url);
    }

    /**
     * Check the specified resource Can be deleted or not.
     *
     * @param  int  $id
     * @return Array
     */
    protected function canDestroy($id)
    {
        $admin_count = Admin::activeOnly()->where('id','!=',$id)->count();

        if($admin_count == 0) {
            return ['status' => false, 'status_message' => __('admin_messages.users.only_one_admin')];
        }

        return ['status' => true,'status_message' => ''];
    }
}
