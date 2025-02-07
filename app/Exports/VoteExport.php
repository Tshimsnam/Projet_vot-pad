<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\Color;

class VoteExport implements FromCollection, WithMapping, WithEvents
{
    protected $intervenants;
    protected $phase_name;
    protected $evenement_nom;
    protected $juriesByCandidat;
    protected $juryNames;

    public function __construct($intervenants, $phase_name, $evenement_nom, $juriesByCandidat, $juryNames)
    {
        $this->intervenants = collect($intervenants);
        $this->phase_name = $phase_name;
        $this->evenement_nom = $evenement_nom;
        $this->juriesByCandidat = $juriesByCandidat;
        $this->juryNames = $juryNames;
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
        // Le compteur n'est pas nécessaire ici
        return [
            $row->noms,
            $row->email,
            $row->telephone,
            $row->genre,
            $row->pourcentage
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('A1:' . chr(72 + count($this->juriesByCandidat)) . '1');
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
                $indexs = ['I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
                $event->sheet->getStyle('A1')->applyFromArray($styleArray);
                // Ajouter les en-têtes sur la deuxième ligne
                $event->sheet->getCell('A2')->setValue('N°');
                $event->sheet->getCell('B2')->setValue('Noms');
                $event->sheet->getCell('C2')->setValue('Email');
                $event->sheet->getCell('D2')->setValue('Téléphone');
                $event->sheet->getCell('E2')->setValue('Genre');
                $event->sheet->getCell('F2')->setValue('Pourcentage');
                $event->sheet->getCell('G2')->setValue('Total Cotes');
                $event->sheet->getCell('H2')->setValue('Commentaires');
                foreach ($this->juryNames as $key => $value) {
                    $event->sheet->getCell($indexs[$key] . '2')->setValue($value);
                }

                $event->sheet->getStyle('A2:F2')->getFont()->setBold(true);

                // Ajouter les données
                $startRow = 3;
                $juriesPerCandidat = $this->juriesByCandidat->toArray();
                foreach ($this->intervenants as $index => $intervenant) {
                    $row = $startRow + $index;
                    $event->sheet->setCellValue('A' . $row, $index + 1);
                    $event->sheet->setCellValue('B' . $row, $intervenant->noms);
                    $event->sheet->setCellValue('C' . $row, $intervenant->email);
                    $event->sheet->setCellValue('D' . $row, $intervenant->telephone);
                    $event->sheet->setCellValue('E' . $row, $intervenant->genre);
                    $event->sheet->setCellValue('F' . $row, $intervenant->pourcentage);
                    $event->sheet->setCellValue('G' . $row, $intervenant->cote);
                    $commentsText = '';
                    // Ajouter chaque commentaire sur une nouvelle ligne
                    foreach ($intervenant->comments as $comment) {
                        if ($comment->commentaires != null){
                            $commentsText .= $comment->commentaires . "\n";
                        }
                    }
                    // Supprimer le dernier retour à la ligne pour éviter un espace inutile
                    $commentsText = rtrim($commentsText, "\r");
                    $event->sheet->getStyle('H' . $row)->getAlignment()->setWrapText(true);
                    $event->sheet->setCellValue('H' . $row, $commentsText);
                    foreach ($intervenant->juryCotes as $key => $totalCote) {
                        $colIndex = array_search($key, $this->juryNames);
                        if ($colIndex !== false) {
                            $event->sheet->setCellValue($indexs[$colIndex] . $row, $totalCote);
                        }
                    }
                }
            },
        ];
    }
}