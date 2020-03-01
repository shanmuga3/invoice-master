<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\Invoice;

class InvoiceDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
        ->addColumn('action',function($invoice) {
            $view = auth()->guard('admin')->user()->can('view-invoice') ? '<a href="'.route('admin.invoice.show',['id' => $invoice->id]).'" class=""> <i class="fas fa-eye"></i> </a>' : '';
            $edit = auth()->guard('admin')->user()->can('update-invoice') ? '<a href="'.route('admin.invoice.edit',['id' => $invoice->id]).'" class=""> <i class="fa fa-edit"></i> </a>' : '';
            $delete = auth()->guard('admin')->user()->can('delete-invoice') ? '<a href="" data-action="'.route('admin.invoice.delete',['id' => $invoice->id]).'" data-toggle="modal" data-target="#confirm-delete" class="text-danger"> <i class="fa fa-times"></i> </a>' : '';
            return $view." &nbsp; ".$edit." &nbsp; ".$delete;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Invoice $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Invoice $model)
    {
        return $model->get();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction()
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'invoice_number',
            'invoice_date',
            'sub_total',
            'discount',
            'tax',
            'total',
            'status',
            'paid_status',
        ];
    }

    /**
     * Get builder parameters.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        return array(
            // 'dom' => 'lfrtip',
            'buttons' => ['csv', 'excel', 'pdf', 'print'],
        );
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'invoice_' . date('YmdHis');
    }
}