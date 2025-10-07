<?php

namespace App\Exports;

use App\Models\Visits;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AuditReportExport implements FromArray, WithStyles, WithTitle, ShouldAutoSize, WithEvents
{
    protected $dateFrom;
    protected $dateTo;
    protected $status;

    public function __construct($dateFrom = null, $dateTo = null, $status = null)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->status = $status;
    }

    public function array(): array
    {
        // Get filtered data
        $query = Visits::with(['author', 'auditor']);
        
        if ($this->dateFrom) {
            $query->whereDate('tanggal', '>=', $this->dateFrom);
        }
        
        if ($this->dateTo) {
            $query->whereDate('tanggal', '<=', $this->dateTo);
        }
        
        if ($this->status) {
            $query->where('status', $this->status);
        }
        
        $visits = $query->orderBy('created_at', 'desc')->get();
        
        // Status mapping
        $statusMap = [
            'pending' => 'Menunggu Konfirmasi Author',
            'confirmed_by_author' => 'Dikonfirmasi Author',
            'confirmed_by_admin' => 'Dikonfirmasi Admin',
            'in_progress' => 'Sedang Berlangsung',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            'rejected' => 'Ditolak'
        ];

        // Build export array
        $data = [];
        
        // Title row
        $data[] = ['LAPORAN AUDIT', '', '', '', '', '', '', '', '', '', ''];
        
        // Filter info row (if any filters applied)
        if ($this->dateFrom || $this->dateTo || $this->status) {
            $filterParts = [];
            if ($this->dateFrom && $this->dateTo) {
                $filterParts[] = 'Periode: ' . \Carbon\Carbon::parse($this->dateFrom)->format('d/m/Y') . ' - ' . \Carbon\Carbon::parse($this->dateTo)->format('d/m/Y');
            } elseif ($this->dateFrom) {
                $filterParts[] = 'Dari: ' . \Carbon\Carbon::parse($this->dateFrom)->format('d/m/Y');
            } elseif ($this->dateTo) {
                $filterParts[] = 'Sampai: ' . \Carbon\Carbon::parse($this->dateTo)->format('d/m/Y');
            }
            
            if ($this->status) {
                $filterParts[] = 'Status: ' . ($statusMap[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status)));
            }
            
            $filterInfo = implode(', ', $filterParts);
            $data[] = [$filterInfo, '', '', '', '', '', '', '', '', '', ''];
        }
        
        // Empty row for spacing
        $data[] = ['', '', '', '', '', '', '', '', '', '', ''];
        
        // Header row
        $data[] = [
            'No',
            'Author',
            'Email Author',
            'Auditor',
            'Email Auditor',
            'Tanggal Kunjungan',
            'Alamat',
            'Status',
            'Hasil Kunjungan',
            'Koordinat',
            'Tanggal Dibuat'
        ];
        
        // Data rows
        $no = 1;
        foreach ($visits as $visit) {
            $data[] = [
                $no++,
                $visit->author->name ?? '-',
                $visit->author->email ?? '-',
                $visit->auditor->name ?? '-',
                $visit->auditor->email ?? '-',
                \Carbon\Carbon::parse($visit->tanggal)->format('d/m/Y'),
                $visit->alamat,
                $statusMap[$visit->status] ?? ucfirst(str_replace('_', ' ', $visit->status)),
                $visit->hasil ?? '-',
                $visit->lat && $visit->long ? $visit->lat . ', ' . $visit->long : '-',
                $visit->created_at->format('d/m/Y H:i')
            ];
        }
        
        return $data;
    }

    public function title(): string
    {
        return 'Laporan Audit';
    }

    public function styles(Worksheet $sheet)
    {
        $totalRows = count($this->array());
        $headerRow = $this->getHeaderRowNumber();
        $dataStartRow = $headerRow + 1;
        
        return [
            // Title row (baris 1)
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 16,
                    'color' => ['rgb' => '000000']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E3F2FD']
                ]
            ],
            
            // Filter info row (baris 2 jika ada filter)
            2 => [
                'font' => [
                    'italic' => true,
                    'size' => 11,
                    'color' => ['rgb' => '555555']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F8F9FA']
                ]
            ],
            
            // Header row
            $headerRow => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1976D2']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => ['rgb' => '1976D2']
                    ]
                ]
            ],
            
            // Data rows
            'A' . $dataStartRow . ':K' . $totalRows => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC']
                    ]
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ]
            ]
        ];
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Merge cells untuk title (A1 sampai K1 - semua kolom)
                $sheet->mergeCells('A1:K1');
                
                // Merge cells untuk filter info jika ada
                if ($this->dateFrom || $this->dateTo || $this->status) {
                    $sheet->mergeCells('A2:K2');
                }
                
                // Set row heights untuk spacing yang lebih baik
                $sheet->getRowDimension('1')->setRowHeight(35); // Title row lebih tinggi
                if ($this->dateFrom || $this->dateTo || $this->status) {
                    $sheet->getRowDimension('2')->setRowHeight(25); // Filter info row
                }
                $sheet->getRowDimension('3')->setRowHeight(20); // Empty row
                $headerRow = $this->getHeaderRowNumber();
                $sheet->getRowDimension($headerRow)->setRowHeight(30); // Header row
                
                // Set column widths untuk proporsi yang lebih baik
                $sheet->getColumnDimension('A')->setWidth(6);   // No
                $sheet->getColumnDimension('B')->setWidth(18);  // Author
                $sheet->getColumnDimension('C')->setWidth(28);  // Email Author
                $sheet->getColumnDimension('D')->setWidth(18);  // Auditor
                $sheet->getColumnDimension('E')->setWidth(28);  // Email Auditor
                $sheet->getColumnDimension('F')->setWidth(18);  // Tanggal
                $sheet->getColumnDimension('G')->setWidth(35);  // Alamat
                $sheet->getColumnDimension('H')->setWidth(25);  // Status
                $sheet->getColumnDimension('I')->setWidth(30);  // Hasil
                $sheet->getColumnDimension('J')->setWidth(25);  // Koordinat
                $sheet->getColumnDimension('K')->setWidth(18);  // Tanggal Dibuat
            }
        ];
    }
    
    private function getHeaderRowNumber()
    {
        $headerRow = 1; // Start from title
        
        // Check if filter info exists
        if ($this->dateFrom || $this->dateTo || $this->status) {
            $headerRow += 1; // Filter info row
        }
        
        $headerRow += 1; // Empty row
        $headerRow += 1; // Header row
        
        return $headerRow;
    }
}