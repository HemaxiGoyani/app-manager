<?php

namespace App\DataTables\Admin;

use App\Http\Requests\Admin\AppAdditionalSpecificValueRequest;
use App\Models\AppAdditionalSpecificValue;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\AppAdditionalSpecificValueRepository;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class AppAdditionalSpecificValueDataTable extends DataTable
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
            ->addColumn('app_fk', function(AppAdditionalSpecificValue $model){
                return $model->application->name ?? '--';
            })
            ->addColumn('attribute_fk', function(AppAdditionalSpecificValue $model){
                return $model->attribute->name ?? '--';
            })
            ->editColumn('created_at', function (AppAdditionalSpecificValue $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->created_at);
            })
            ->editColumn('updated_at', function (AppAdditionalSpecificValue $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->updated_at);
            })
            ->rawColumns(['created_at', 'updated_at', 'action'])
            ->addColumn('action', 'admin.app_additional_specific_values.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AppAdditionalSpecificValue $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AppAdditionalSpecificValue $model, AppAdditionalSpecificValueRequest $request)
    {
        $query = $model->newQuery()->with(['application', 'attribute']);
        return AppAdditionalSpecificValueRepository::applyFilters($query, $request);
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
            ->minifiedAjax(route('admin.appAdditionalSpecificValues.index'),
                'return $.extend({}, data, additional_dt_data());')
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
            'app_fk' => ['title' => 'Application'],
            'attribute_fk' => ['title' => 'Attribute'],
            'value',
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
        return 'app_additional_specific_valuesdatatable_' . time();
    }
}
