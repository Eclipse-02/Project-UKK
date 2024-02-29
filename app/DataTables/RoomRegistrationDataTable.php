<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\RoomRegistration;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class RoomRegistrationDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'scaffolds.registrations.action')
            ->addColumn('status', function($q) {
                if ($q->status == "AV") {
                    return "Available";
                } else if ($q->status == "BK") {
                    return "Booked";
                } else {
                    return "In Cleaning";
                }
            })
            ->addColumn('checkin', function ($q) {
                return Carbon::parse($q->checkin)->isoFormat('D MMMM Y');
            })
            ->addColumn('checkout', function ($q) {
                return Carbon::parse($q->checkout)->isoFormat('D MMMM Y');
            })
            ->addColumn('id', function ($q) {
                if ($q->for_another != null) {
                    return $q->for_another;
                } else {
                    return $q->user->name;
                }
            })
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RoomRegistration $model): QueryBuilder
    {
        return $model->with('user')->newQuery();
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
            Column::make('id')->width(100)->title('Guest Name'),
            Column::make('checkin')->width(100),
            Column::make('checkout')->width(100),
            Column::make('status')->width(100),
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
        return 'RoomRegistration_' . date('YmdHis');
    }
}
