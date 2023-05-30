<?php

namespace App\DataTables\Admin;

use App\Models\Musician;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MusicianDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('applications', function(Musician $model){
                return $model->application;
            })
            ->addColumn('band_fk', function(Musician $model){
                return $model->musicBand->name ?? '--';
            })
            ->editColumn('created_at', function (Musician $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->created_at);
            })
            ->editColumn('updated_at', function (Musician $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->updated_at);
            })
            ->rawColumns(['created_at', 'updated_at', 'action'])
            ->addColumn('action', 'admin.musicians.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Musician $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Musician $model)
    {
        return $model->newQuery();
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
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'responsive'=> true,
                'dom'       => 'B<\'row p-t-15\' <\'col-sm-6\'l><\'col-sm-6\'f>>rt<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
//                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'colvis', 'className' => 'btn btn-default btn-sm no-corner']
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name',
            'applications' => ['orderable' => false, 'searchable' => false,],
            'band_fk' => ['title' => 'Music band'],
            'order',
            'created_at' => ['title' => 'Added on'],
            'updated_at' => ['title' => 'Updated on'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'musiciansdatatable_' . time();
    }
}
