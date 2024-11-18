<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SPMEexport implements FromArray, WithHeadings, WithEvents, WithStyles
{
    public function array(): array
    {
        // Data array contoh. Ganti dengan data Anda sesuai dengan kolom yang dibutuhkan.
        return [
            ['Pelayanan Kesehatan Ibu Hamil', 2888, 'Rp 2.868.010.064', 483, '17,02%', 0, 0, '524', '18,46%', 'Rp 510.810.276', '17,81%', '1007', '35,48%', 'Rp 3.379.020.340', '17,51%', 'Masalah', 'Rencana Tindak Lanjut'],
            // Tambahkan baris data lain sesuai kebutuhan
        ];
    }

    public function headings(): array
    {
        return [
            ["LAPORAN STANDAR PELAYANAN MINIMAL (SPM) TW II"],
            ["INDIKATOR", "SASARAN", "ANGGARAN", "TW 1", "", "", "", "TW 2", "", "", "", "TW 3", "", "", "", "REALISASI S.D TW II", "", "", "PERMASALAHAN", "RENCANA TINDAK LANJUT"],
            ["", "", "", "CAPAIAN", "%", "REALISASI ANGGARAN", "%", "CAPAIAN", "%", "REALISASI ANGGARAN", "%", "CAPAIAN", "%", "REALISASI ANGGARAN", "%", "CAPAIAN", "%", "REALISASI ANGGARAN", "%", "", ""]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Merge cells untuk heading utama
                $sheet->mergeCells('A1:U1'); // Contoh penggabungan judul utama
                $sheet->mergeCells('A2:A3'); // Indikator
                $sheet->mergeCells('B2:B3'); // Sasaran
                $sheet->mergeCells('C2:C3'); // Anggaran
                $sheet->mergeCells('D2:G2'); // TW 1
                $sheet->mergeCells('H2:K2'); // TW 2
                $sheet->mergeCells('L2:O2'); // TW 3
                $sheet->mergeCells('P2:R2'); // Realisasi S.D TW II
                $sheet->mergeCells('S2:S3'); // Permasalahan
                $sheet->mergeCells('T2:T3'); // Rencana Tindak Lanjut

                // Atur tinggi dan lebar kolom sesuai kebutuhan
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(10);
                $sheet->getColumnDimension('C')->setWidth(15);
                // Lanjutkan untuk kolom lain yang diperlukan

                // Style tambahan
                $sheet->getStyle('A1:U3')->getFont()->setBold(true); // Membuat teks header menjadi tebal
                $sheet->getStyle('A1:U3')->getAlignment()->setHorizontal('center'); // Mengatur teks header di tengah
                $sheet->getStyle('A1:U3')->getAlignment()->setVertical('center'); // Mengatur teks header vertikal di tengah
            }
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]],
            2 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
