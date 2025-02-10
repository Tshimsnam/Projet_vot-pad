<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

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
            $row->age,
            $row->statut,
            $row->universite,
            $row->promotion,
            ...array_values($row->juryCotes),
            $row->cote, // Total Cotes
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Définition de la colonne après les jurys
                $lastColumn = chr(75 + count($this->juryNames)); // 'K' + nombre de jurys

                // 🎨 Style du titre
                $event->sheet->mergeCells('A1:' . $lastColumn . '1');
                $event->sheet->setCellValue('A1', strtoupper($this->evenement_nom . ': ' . $this->phase_name));
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14, 'color' => ['argb' => Color::COLOR_WHITE]],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => '000000']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // 🏷️ En-têtes
                $headers = ['N°', 'Noms', 'Email', 'Téléphone', 'Genre', 'Âge', 'Statut', 'Université', 'Promotion'];
                $indexs = range('J', 'Z'); 

                foreach ($headers as $key => $value) {
                    $col = chr(65 + $key);
                    $event->sheet->setCellValue($col . '2', $value);
                }

                // Ajouter les noms des jurys
                foreach ($this->juryNames as $key => $value) {
                    $event->sheet->setCellValue($indexs[$key] . '2', 'jury ' . $value);
                }

                // Ajouter "Total Cotes"
                $totalCotesColumn = $indexs[count($this->juryNames)];
                $event->sheet->setCellValue($totalCotesColumn . '2', 'Total Cotes');

                // 🎨 Style des en-têtes
                $event->sheet->getStyle('A2:' . $totalCotesColumn . '2')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFD700']], // Or
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                ]);

                // 🔢 Ajouter les données
                $startRow = 3;
                foreach ($this->intervenants as $index => $intervenant) {
                    $row = $startRow + $index;
                    $event->sheet->setCellValue('A' . $row, $index + 1);
                    $event->sheet->setCellValue('B' . $row, $intervenant->noms);
                    $event->sheet->setCellValue('C' . $row, $intervenant->email);
                    $event->sheet->setCellValue('D' . $row, $intervenant->telephone);
                    $event->sheet->setCellValue('E' . $row, $intervenant->genre);
                    $event->sheet->setCellValue('F' . $row, ($intervenant->age ?? '') . ' ans');
                    $event->sheet->setCellValue('G' . $row, $intervenant->statut);
                    $event->sheet->setCellValue('H' . $row, $intervenant->universite);
                    $event->sheet->setCellValue('I' . $row, $intervenant->promotion);

                    // Ajouter les cotes des jurys
                    foreach ($intervenant->juryCotes as $key => $totalCote) {
                        $colIndex = array_search($key, $this->juryNames);
                        if ($colIndex !== false) {
                            $event->sheet->setCellValue($indexs[$colIndex] . $row, $totalCote);
                        }
                    }

                    // Ajouter "Total Cotes"
                    $event->sheet->setCellValue($totalCotesColumn . $row, $intervenant->cote);
                }

                // 📏 Ajustement des colonnes pour une meilleure lisibilité
                foreach (range('A', $totalCotesColumn) as $columnID) {
                    $event->sheet->getColumnDimension($columnID)->setWidth(15);
                }

                // 🎨 Ajout des bordures pour toutes les cellules
                $event->sheet->getStyle('A2:' . $totalCotesColumn . ($startRow + count($this->intervenants)))->applyFromArray([
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    'font' => ['size' => 11],
                ]);
            },
        ];
    }
}