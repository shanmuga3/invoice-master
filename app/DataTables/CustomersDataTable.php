<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\User;

class CustomersDataTable extends DataTable
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
        ->addColumn('action',function($customer) {
            $edit = auth()->guard('admin')->user()->can('update-customers') ? '<a href="'.route('admin.customers.edit',['id' => $customer->id]).'" class=""> <i class="fa fa-edit"></i> </a>' : '';
            $delete = auth()->guard('admin')->user()->can('delete-customers') ? '<a href="" data-action="'.route('admin.customers.delete',['id' => $customer->id]).'" data-toggle="modal" data-target="#confirm-delete" class="text-danger"> <i class="fa fa-times"></i> </a>' : '';
            return $edit." &nbsp; ".$delete;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
            'first_name',
            'last_name',
            'email',
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
        return 'customers_' . date('YmdHis');
    }
}