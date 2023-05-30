<?php

namespace App\DataTables\Admin;

use App\Models\Wallpaper;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class WallpaperDataTable extends DataTable
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
            ->addColumn('avatar', function(Wallpaper $model){
                $content = "<div class='text-center'><img src={$model->avatar_url['100']} alt=\"{$model->name}'s Avatar\" width='90'/></div>";
                return $content;
            },0)
            ->addColumn('musicians', function(Wallpaper $model){
                return $model->musician;
            })
            ->addColumn('wallpaper_tags', function(Wallpaper $model){
                return $model->tag;
            })
            ->addColumn('category_fk', function(Wallpaper $model){
                return $model->category->name ?? '--';
            })
            ->editColumn('created_at', function (Wallpaper $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->created_at);
            })
            ->editColumn('updated_at', function (Wallpaper $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->updated_at);
            })
            ->rawColumns(['avatar', 'created_at', 'updated_at', 'action'])
            ->addColumn('action', 'admin.wallpapers.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Wallpaper $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Wallpaper $model)
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
                'order'     => [[5, 'desc']],
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
            'musicians' => ['orderable' => false, 'searchable' => false,],
            'wallpaper_tags' => ['orderable' => false, 'searchable' => false,],
            'name',
            'category_fk' => ['title' => 'Category'],
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
        return 'wallpapersdatatable_' . time();
    }
}
