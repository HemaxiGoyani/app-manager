<?php

namespace App\DataTables\Admin;

use App\Models\MusicAlbum;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MusicAlbumDataTable extends DataTable
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
            ->addColumn('avatar', function(MusicAlbum $model){
                $content = "<div class='text-center'><img src={$model->avatar_url['100']} alt=\"{$model->name}'s Avatar\" width='90'/></div>";
                return $content;
            },0)
            ->addColumn('applications', function(MusicAlbum $model){
                return $model->application;
            })
            ->addColumn('musicBands', function(MusicAlbum $model){
                return $model->music_band;
            })
            ->editColumn('created_at', function (MusicAlbum $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->created_at);
            })
            ->editColumn('updated_at', function (MusicAlbum $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->updated_at);
            })
            ->rawColumns(['avatar', 'created_at', 'updated_at', 'action'])
            ->addColumn('action', 'admin.music_albums.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MusicAlbum $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MusicAlbum $model)
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
                'order'     => [[4, 'desc']],
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
            'avatar',
            'name',
            'applications' => ['orderable' => false, 'searchable' => false,],
            'musicBands' => ['orderable' => false, 'searchable' => false,],
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
        return 'music_albumsdatatable_' . time();
    }
}
