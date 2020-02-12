<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\TaxTypes;

class TaxTypesDataTable extends DataTable
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
            ->addColumn('status',function($tax_types) {
                return $tax_types->status_text;
            })
            ->addColumn('action',function($tax_types) {
                $edit = auth()->guard('admin')->user()->can('update-tax_types') ? '<a href="'.route('admin.tax_types.edit',['id' => $tax_types->id]).'" class=""> <i class="fa fa-edit"></i> </a>' : '';
                $delete = auth()->guard('admin')->user()->can('delete-tax_types') ? '<a href="" data-action="'.route('admin.tax_types.delete',['id' => $tax_types->id]).'" data-toggle="modal" data-target="#confirm-delete" class="text-danger"> <i class="fa fa-times"></i> </a>' : '';
                return $edit." &nbsp; ".$delete;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \TaxTypes $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TaxTypes $model)
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
            'name',
            'type',
            'value',
            'status',
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