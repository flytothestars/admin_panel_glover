<?php

namespace App\Http\Livewire\Tables;

use App\Models\EarningReport;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class VendorEarningHistoryTable extends BaseDataTableComponent
{

    public $model = EarningReport::class;

    public function filters(): array
    {
        return [
            'start_date' => Filter::make(__('Start Date'))
                ->date([
                    'min' => now()->subYear()->format('Y-m-d'), // Optional
                    'max' => now()->format('Y-m-d') // Optional
                ]),
            'end_date' => Filter::make(__('End Date'))
                ->date([
                    'min' => now()->subYear()->format('Y-m-d'), // Optional
                    'max' => now()->format('Y-m-d') // Optional
                ])
        ];
    }

    public function query()
    {
        return EarningReport::with('earnings')->whereHas('earnings', function ($q) {
            $q->whereNotNull('vendor_id');
        })
            ->when($this->getFilter('start_date'), fn ($query, $sDate) => $query->whereDate('created_at', ">=", $sDate))
            ->when($this->getFilter('end_date'), fn ($query, $eDate) => $query->whereDate('created_at', "<=", $eDate));
    }

    public function columns(): array
    {
        return [
            Column::make(__('ID'), "id")->searchable()->sortable(),
            Column::make(__('Vendor'), "earnings.vendor.name")->searchable()->sortable(),
            Column::make(__('Earning'), "earning")->format(function ($value, $column, $row) {
                return view('components.table.price', $data = [
                    "model" => $row,
                    "value" => $value,
                ]);
            })->searchable()->sortable(),
            Column::make(__('Commission'), "commission")->format(function ($value, $column, $row) {
                return view('components.table.price', $data = [
                    "model" => $row,
                    "value" => $value,
                ]);
            })->searchable()->sortable(),
            Column::make(__('Balance'), "balance")->format(function ($value, $column, $row) {
                return view('components.table.price', $data = [
                    "model" => $row,
                    "value" => $value,
                ]);
            })->searchable()->sortable(),
            Column::make(__('Created At'), 'formatted_date'),
        ];
    }
}
