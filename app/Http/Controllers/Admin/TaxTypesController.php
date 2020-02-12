<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\TaxTypesDataTable;
use App\Models\TaxTypes;
use Lang;

class TaxTypesController extends Controller
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->base_path = 'admin.tax_types.';
        $this->base_url = $this->view_data['base_url'] = route('admin.tax_types');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaxTypesDataTable $dataTable)
    {
        return $dataTable->render($this->base_path.'view',$this->view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->view_data['result'] = new TaxTypes;
        return view($this->base_path.'add', $this->view_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $request['agency_id'] = 1;
        $validated = $request->only(['name','type','value','status','description','agency_id']);

        TaxTypes::create($validated);

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
        $this->view_data['result'] = TaxTypes::findOrFail($id);
        return view($this->base_path.'edit', $this->view_data);
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
        $this->validateRequest($request, $id);

        $tax_types = TaxTypes::Find($id);
        $tax_types->name        = $request->name;
        $tax_types->type        = $request->type;
        $tax_types->value       = $request->value;
        $tax_types->status      = $request->status;
        $tax_types->description = $request->description;
        $tax_types->save();

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
            TaxTypes::find($id)->delete();
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
        return ['status' => true,'status_message' => ''];
    }

    /**
     * Validate the Given Request
     *
     * @param  Illuminate\Http\Request $request_data
     * @param  Int $id
     * @return Array
     */
    protected function validateRequest($request_data, $id = '')
    {
        $rules = array(
            'name'      => 'required',
            'type'      => 'required|in:fixed,percent',
            'value'     => 'required|numeric',
            'status'    => 'required',
        );

        $attributes = array(
            'name'      => 'Name',
            'type'      => 'Type',
            'value'     => 'Value',
            'status'    => 'Status',
        );

        $this->validate($request_data,$rules,[],$attributes);
    }
}