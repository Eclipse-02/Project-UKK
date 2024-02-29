<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\PromotionCode;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PromotionCodeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'scaffolds.codes.action')
            ->addColumn('discount', function ($q) {
                return '% ' . $q->discount;
            })
            ->addColumn('begin_at', function ($q) {
                return Carbon::parse($q->begin_at)->isoFormat('D MMMM Y');
            })
            ->addColumn('end_at', function ($q) {
                return Carbon::parse($q->end_at)->isoFormat('D MMMM Y');
            })
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PromotionCode $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->width(50)->title('No'),
            Column::make('code_name')->width(100)->title('Code'),
            Column::make('discount')->width(100),
            Column::make('begin_at')->width(100),
            Column::make('end_at')->width(100),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PromotionCode_' . date('YmdHis');
    }
}
