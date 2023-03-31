<?php

namespace App\Export;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TokensReport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    private $tokensReport;

    public function __construct($tokensReport)
    {
        $this->tokensReport = $tokensReport;
    }

    public function collection()
    {
        return $this->tokensReport->map(function ($report) {
            return [
                'token' => $report->token->token,
                'prize' => $report->item->item,
                'date_used' => $report->created_at->format('d-m-Y'),
                'time_used' => $report->created_at->format('H : i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Token',
            'Prize',
            'Date Used',
            'Time Used',
        ];
    }

    public function title(): string
    {
        return 'Report Tokens';
    }

    public function styles(Worksheet $sheet)
    {
        $headingStyle = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        $sheet->getStyle('A1:D1')->applyFromArray($headingStyle);
    }
}
