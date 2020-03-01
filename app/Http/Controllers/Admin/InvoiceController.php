<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\InvoiceDataTable;
use App\Models\Invoice;
use App\Models\InvoiceItems;
use App\Models\User;
use App\Models\TaxTypes;
use Lang;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->base_path = 'admin.invoice.';
        $this->base_url = $this->view_data['base_url'] = route('admin.invoice');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InvoiceDataTable $dataTable)
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
        $data['result'] = new Invoice;
        $data['customers'] = User::get();
        $data['tax_types'] = TaxTypes::activeOnly()->get();
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
        $this->validateRequest($request);

        $current_dateObj = Carbon::now();

        $invoice = new Invoice;
        $invoice->invoice_template_id = 1;
        $invoice->user_id = $request->customer;
        $invoice->agency_id = $request->agency;
        $invoice->invoice_number = "INV".$request->customer;
        $invoice->invoice_date = $current_dateObj->format('Y-m-d');
        $invoice->due_date = $current_dateObj->addDays(7)->format('Y-m-d');
        $invoice->status = "Pending";
        $invoice->paid_status = "Pending";
        $invoice->notes = $request->notes;
        $invoice->currency_code= getCurrencyCode();
        $invoice->sub_total = $request->sub_total;
        $invoice->total = $request->total;
        $invoice->discount_type = $request->discount_type;
        $invoice->discount = $request->discount;
        $invoice->discount_val = $request->discount_val;
        $invoice->round_off = $request->round_off;
        $invoice->unique_hash = \Str::uuid()->toString();

        $invoice->save();

        $invoice_total = 0;

        foreach ($request->invoice_item as $invoice_item) {
            $item = new InvoiceItems;
            $item->invoice_id   = $invoice->id;
            $item->agency_id    = $invoice->agency_id;
            $item->currency_code= getCurrencyCode();
            $item->name         = $invoice_item["name"];
            $item->description  = $invoice_item["description"] ?? '';
            $item->price        = $invoice_item["price"];
            $item->quantity     = $invoice_item["quantity"];
            $item->discount     = $invoice_item["discount"];
            $item->discount_val = $invoice_item["discount_val"] ?? '';
            $item->tax          = $invoice_item["tax"] ?? '';

            $total_price        = ($item->price * $item->quantity) + $item->tax;
            $item->sub_total    = $total_price;
            $total_price -= $item->discount_val;
            $item->total        = $total_price;
            $item->save();

            $invoice_total += $total_price;
        }

        flashMessage('success', Lang::get('admin_messages.success'), Lang::get('admin_messages.updated_successfully'));

        return redirect($this->base_url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->view_data['result'] = Invoice::with('invoice_items')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->view_data['customers'] = User::get();
        $this->view_data['tax_types'] = TaxTypes::activeOnly()->get();
        $this->view_data['result'] = Invoice::with('invoice_items')->findOrFail($id);
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
        flashMessage('success', Lang::get('admin_messages.success'), Lang::get('admin_messages.updated_successfully'));

        return redirect($this->base_url);
    }

    public function destroy($id)
    {
        $can_destroy = $this->canDestroy($id);
        
        if(!$can_destroy['status']) {
            flashMessage('danger', Lang::get('admin_messages.failed'), $can_destroy['status_message']);
            return redirect($this->base_url);
        }
        
        try {
            InvoiceItems::where('invoice_id',$id)->delete();
            Invoice::where('id',$id)->delete();
            flashMessage('success', Lang::get('admin_messages.success'), Lang::get('admin_messages.delete_success'));
        }
        catch (Exception $e) {
            flashMessage('danger', Lang::get('admin_messages.failed'), $e->getMessage());
        }

        return redirect($this->base_url);
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
            "customer"  => "required",
            "agency"    => "required",
        );

        $attributes = array(
            "customer"  => "Customer",
            "agency"    => "Agency",
        );

        $this->validate($request_data,$rules,[],$attributes);
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
}
