<?php

namespace App\DataTables\Admin;

use App\Models\MusicRecord;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MusicRecordDataTable extends DataTable
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
            ->addColumn('applications', function(MusicRecord $model){
                return $model->application;
            })
            ->addColumn('musicBands', function(MusicRecord $model){
                return $model->music_band;
            })
            ->addColumn('musicAlbums', function(MusicRecord $model){
                return $model->music_album;
            })
            ->addColumn('music', function(MusicRecord $model){
                if(!is_null($model->music_record_url))
                    return "<audio controls><source src='{$model->music_record_url['url']}'  type='audio/mpeg'></audio>";
                else
                    return "NA";
            },0)
            ->editColumn('created_at', function (MusicRecord $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->created_at);
            })
            ->editColumn('updated_at', function (MusicRecord $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->updated_at);
            })
            ->rawColumns(['music', 'created_at', 'updated_at', 'action'])
            ->addColumn('action', 'admin.music_records.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MusicRecord $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MusicRecord $model)
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
            'musicBands' => ['orderable' => false, 'searchable' => false,],
            'musicAlbums' => ['orderable' => false, 'searchable' => false,],
            'music',
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
        return 'music_recordsdatatable_' . time();
    }
}
