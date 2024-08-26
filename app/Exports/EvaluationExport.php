<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\Color;

class EvaluationExport implements FromCollection, WithMapping, WithEvents
{
    protected $intervenants;
    protected $phase_name;
    protected $evenement_nom;

    public function __construct($intervenants, $phase_name, $evenement_nom)
    {
        $this->intervenants = collect($intervenants)->map(function ($item) {
            return (object) $item;
        });
        $this->phase_name = $phase_name;
        $this->evenement_nom = $evenement_nom;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->intervenants;
    }

    public function map($row): array
    {
        return [
            $row->noms,
            $row->email,
            $row->telephone,
            $row->genre,
            $row->pourcentage,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Nom de l'evenement et la phase
                $event->sheet->mergeCells('A1:F1');
                $event->sheet->setCellValue('A1', strtoupper($this->evenement_nom . ': ' . $this->phase_name));
                $styleArray = [
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => Color::COLOR_BLACK], // Texte en noir
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => Color::COLOR_YELLOW], // Fond en jaune
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $event->sheet->getStyle('A1')->applyFromArray($styleArray);

                // Ajouter les en-têtes sur la deuxième ligne
                $event->sheet->getCell('A2')->setValue('N°');
                $event->sheet->getCell('B2')->setValue('Noms');
                $event->sheet->getCell('C2')->setValue('Email');
                $event->sheet->getCell('D2')->setValue('Téléphone');
                $event->sheet->getCell('E2')->setValue('Genre');
                $event->sheet->getCell('F2')->setValue('Pourcentage');

                $event->sheet->getStyle('A2:F2')->getFont()->setBold(true);

                // Ajouter les données
                $startRow = 3;
                foreach ($this->intervenants as $index => $intervenant) {
                    $row = $startRow + $index;
                    $event->sheet->setCellValue('A' . $row, $index + 1);
                    $event->sheet->setCellValue('B' . $row, $intervenant->noms);
                    $event->sheet->setCellValue('C' . $row, $intervenant->email);
                    $event->sheet->setCellValue('D' . $row, $intervenant->telephone);
                    $event->sheet->setCellValue('E' . $row, $intervenant->genre);
                    $event->sheet->setCellValue('F' . $row, $intervenant->pourcentage);
                }
            },
        ];
    }
}
