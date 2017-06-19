<?php

namespace app\modules\client\controllers;

use app\modules\client\models\Product;
use PHPExcel;
use Yii;

class ExportController extends AppClientController
{
    public function actionPriceList() {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $active_sheet = $objPHPExcel->getActiveSheet();
        $active_sheet->getPageSetup()->setHorizontalCentered(true);
        $active_sheet->getPageSetup()->setScale(53);
        $active_sheet->getPageMargins()->setTop(0.3);
        $active_sheet->getPageMargins()->setRight(0);
        $active_sheet->getPageMargins()->setLeft(0);
        $active_sheet->getPageMargins()->setBottom(0.3);

        $active_sheet->setTitle('Товары');
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(15);

        $active_sheet->getColumnDimension('A')->setWidth(10);
        $active_sheet->getColumnDimension('B')->setWidth(90);
        $active_sheet->getColumnDimension('C')->setWidth(12);
        $active_sheet->getColumnDimension('D')->setWidth(12);

        $style_allborders = [
            'borders' => [
                'outline' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THICK
                ],
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'rgb' => '000000'
                    ]
                ]
            ]
        ];

        $style_text = [
            'font' => [
                'name' => 'Times New Roman',
                'size' => 18
            ],
            'alignment' => [
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ],
            'fill' => [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccf2ff')
            ]
        ];

        $style_text_h1 = [
            'font' => [
                'name' => 'Times New Roman',
                'size' => 32
            ],
            'alignment' => [
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ]
        ];

        /*---/Раздел объединение ячеек/---*/
        $active_sheet->mergeCells('C5:D5');
        $active_sheet->mergeCells('B5:B6');
        $active_sheet->mergeCells('B1:D3');

        /*---/Раздел простого заполнения/---*/
        $active_sheet->setCellValue('B1', 'Прайс-лист');
        $active_sheet->setCellValue('B4', 'Дата: ' . date('d-m-Y'));
        $active_sheet->setCellValue('B5', 'Номенклатура / Характеристика номенклатуры');
        $active_sheet->setCellValue('C5', 'Цена');
        $active_sheet->setCellValue('C6', 'Опт.');
        $active_sheet->setCellValue('D6', 'Розница');
        $active_sheet->getStyle('B1')->applyFromArray($style_text_h1);
        $active_sheet->getStyle('B5:D6')->applyFromArray($style_text);

        $model = Product::find()->all();
        $i = 6;
        foreach ($model as $value) {
            $i++;
            $active_sheet->getStyle('B5:D'.$i.'')->applyFromArray($style_allborders);
            $active_sheet->setCellValue('B'.$i.'', $value->name);
            $active_sheet->getStyle('C'.$i.'')->getNumberFormat()->setFormatCode('#,##0.00');
            $active_sheet->setCellValue('C'.$i.'', $value->wholesale_price);
            $active_sheet->getStyle('D'.$i.'')->getNumberFormat()->setFormatCode('#,##0.00');
            $active_sheet->setCellValue('D'.$i.'', $value->price);
        }

        header('Content-Type:application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Прайс-лист.xls"');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
}