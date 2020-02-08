<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\Admin;

class AdminUsersDataTable extends DataTable
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
        ->addColumn('role',function($admin_users) {
            return $admin_users->role_name;
        })
        ->addColumn('status',function($admin_users) {
            return $admin_users->status_text;
        })
        ->addColumn('action',function($admin_users) {
            $edit = auth()->guard('admin')->user()->can('update-admin_users') ? '<a href="'.route('admin.admin_users.edit',['id' => $admin_users->id]).'" class=""> <i class="fa fa-edit"></i> </a>' : '';
            $delete = auth()->guard('admin')->user()->can('delete-admin_users') ? '<a href="" data-action="'.route('admin.admin_users.delete',['id' => $admin_users->id]).'" data-toggle="modal" data-target="#confirm-delete" class="text-danger"> <i class="fa fa-times"></i> </a>' : '';
            return $edit." &nbsp; ".$delete;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
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
            'username',
            'email',
            'role',
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
        return 'admins_' . date('YmdHis');
    }
}