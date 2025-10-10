<?php

namespace App\Exports;

use App\Models\Visits;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use Illuminate\Contracts\View\View;

class AuditDetailExport implements FromView, ShouldAutoSize, WithCustomStartCell, WithEvents
{
    protected $audit;

    public function __construct(Visits $audit)
    {
        $this->audit = $audit;
    }

    public function view(): View
    {
        return view('exports.audit-detail', [
            'audit' => $this->audit
        ]);
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Set page orientation to portrait and paper size to A4
                $sheet->getPageSetup()
                    ->setOrientation(PageSetup::ORIENTATION_PORTRAIT)
                    ->setPaperSize(PageSetup::PAPERSIZE_A4)
                    ->setFitToPage(true)
                    ->setFitToWidth(1)
                    ->setFitToHeight(0);

                // Set margins
                $sheet->getPageMargins()
                    ->setTop(0.8)
                    ->setRight(0.7)
                    ->setBottom(0.8)
                    ->setLeft(0.7)
                    ->setHeader(0.3)
                    ->setFooter(0.3);

                // Header styling (rows 1-4)
                $sheet->mergeCells('A1:F1');
                $sheet->mergeCells('A2:F2');
                $sheet->mergeCells('A3:F3');
                $sheet->mergeCells('A4:F4');

                // Company header styling
                $sheet->getStyle('A1:F4')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => '1F2937']
                    ],
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'],
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);

                // Title styling
                $sheet->getStyle('A6:F6')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => '3B82F6']
                    ],
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'],
                        'bold' => true,
                        'size' => 14
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);

                // Data section headers styling
                $headerRows = [8, 16, 24]; // Adjust based on your layout
                foreach ($headerRows as $row) {
                    $sheet->getStyle("A{$row}:F{$row}")->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'color' => ['rgb' => 'F3F4F6']
                        ],
                        'font' => [
                            'bold' => true,
                            'color' => ['rgb' => '374151']
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_LEFT,
                            'vertical' => Alignment::VERTICAL_CENTER
                        ]
                    ]);
                }

                // Add borders to all data cells
                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle("A1:F{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'D1D5DB']
                        ]
                    ]
                ]);

                // Set row heights
                $sheet->getRowDimension(1)->setRowHeight(25);
                $sheet->getRowDimension(2)->setRowHeight(20);
                $sheet->getRowDimension(3)->setRowHeight(20);
                $sheet->getRowDimension(4)->setRowHeight(25);
                $sheet->getRowDimension(6)->setRowHeight(30);

                // Footer styling
                $footerRow = $lastRow + 2;
                $sheet->mergeCells("A{$footerRow}:F{$footerRow}");
                $sheet->getStyle("A{$footerRow}:F{$footerRow}")->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'F9FAFB']
                    ],
                    'font' => [
                        'italic' => true,
                        'size' => 10,
                        'color' => ['rgb' => '6B7280']
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);

                // Set column widths
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(25);
                $sheet->getColumnDimension('C')->setWidth(20);
                $sheet->getColumnDimension('D')->setWidth(25);
                $sheet->getColumnDimension('E')->setWidth(20);
                $sheet->getColumnDimension('F')->setWidth(25);
            }
        ];
    }
}