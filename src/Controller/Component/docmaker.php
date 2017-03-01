<?php
namespace App\Controller\Component;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\Style\Cell;
use PhpOffice\PhpWord\Style\Image;
/**
 * Created by PhpStorm.
 * User: David
 * Date: 2/9/2017
 * Time: 8:14 PM
 */
class docmaker {
    public function facturacion($facturas,$user)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
        $phpWord = new PHPWord();
        $sectionStyle=array('pageSizeH'=>Converter::cmToTwip(27.94),
            'pageSizeW'=>Converter::cmToTwip(21.59),
            'orientation'=>'landscape',
            'marginTop'=>Converter::cmToTwip(1.27),
            'marginBottom'=>Converter::cmToTwip(1.27),
            'marginRight'=>Converter::cmToTwip(1.27),
            'marginLeft'=>Converter::cmToTwip(1.27));
        $section = $phpWord->addSection($sectionStyle);
        $section->setStyle(array());
        $fancyTableStyle = array('borderSize' => 12, 'borderColor' => 'green');
        $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFFFF');
        $cellHCentered = array('alignment' => Jc::CENTER);
        $spanTableStyleName = 'Colspan Rowspan';
        $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
        $table = $section->addTable($spanTableStyleName);
        $table->addRow();
        $table->addCell(2500, array('vMerge' => 'restart', 'bgColor' => 'FFFFFF'))->addImage('../webroot/img/fertinitrorif.png',array(
            'width'            => Converter::cmToPixel(2.38),
            'height'           => Converter::cmToPixel(1.39),
            'positioning'      => Image::POSITION_ABSOLUTE,
            'posHorizontal'    => Image::POSITION_HORIZONTAL_LEFT,
            'posHorizontalRel' => Image::POSITION_RELATIVE_TO_COLUMN,
            'posVertical'      => Image::POSITION_VERTICAL_TOP,
            'posVerticalRel'   => Image::POSITION_RELATIVE_TO_PAGE,
        ));
        $cell2 = $table->addCell(10500, array('cellMargin' => 80,'gridSpan' => 2, 'valign' => 'center'));
        $textrun2 = $cell2->addTextRun( array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1));
        $textrun2->addText('Fertilizantes Nitrogenados de Venezuela, FERTINITRO, C.E.C.',array('name' => 'Arial Narrow','bold'=>true,'color'=>'green','size'=>'14'));
        $textrun2->addTextBreak(1,array('spacing' => 240, 'size' => 24));
        $textrun2->addTextBreak(1,array('spacing' => 240, 'size' => 14));
        $textrun2->addText('DETALLE DE FACTURACIÓN DEL MES DE '.strtoupper(strftime("%B")), array('name'=>'Arial','bold' => true,'color'=>'black', 'size'=>'10','valign' => 'center','line' => 24),$cellHCentered);
        $table->addCell(2000, $cellRowSpan)->addImage('../webroot/img/logoit.png',array(
            'positioning'      => Image::POSITION_RELATIVE,
            'posHorizontal'    => Image::POSITION_HORIZONTAL_CENTER,
            'posHorizontalRel' => Image::POSITION_RELATIVE_TO_COLUMN,
            'posVertical'      => Image::POSITION_VERTICAL_TOP,
            'posVerticalRel'   => Image::POSITION_RELATIVE_TO_LINE,
            'marginLeft'    => 1,
            'width'         => Converter::cmToPixel(1.82),
            'height'        => Converter::cmToPixel(1.47)));
        $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
        $table = $section->addTable(array('borderSize' => 6, 'alignment' => JcTable::CENTER,'borderColor' => 'green'));
        $colormovil='FFDAA1';
        $colormovis='a2e5ff';
        $extramovil=0;
        $balancemovil=0;
        $cmovil=0;
        $extramovis=0;
        $balancemovis=0;
        $cmovis=0;
        $ROW = $table->addRow();
        $ROW->addCell(400, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'eeeeee'))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1))
            ->addText('#',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $ROW->addCell(975, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'e3ece0'))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1))
            ->addText('Operadora',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $ROW->addCell(1000, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'eeeeee'))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1))
            ->addText('Numero',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $ROW->addCell(2000, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'e3ece0'))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1))
            ->addText('Propietario',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $ROW->addCell(2375, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'eeeeee'))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1))
            ->addText('Gerencia y cargo',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $ROW->addCell(2500, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'e3ece0'))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1))
            ->addText('Marca y modelo',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $ROW->addCell(2500, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'eeeeee'))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1))
            ->addText('Serial',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $ROW->addCell(1500, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'e3ece0'))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1))
            ->addText('Plan',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $ROW->addCell(750, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'eeeeee'))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1))
            ->addText('Extra',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $ROW->addCell(1000, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'e3ece0'))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1))
            ->addText('Monto',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $c=0;
        $textrunstyle=array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1);
        $textstyle=array('lineHeight'=>1,'name' => 'Arial','bold'=>false, 'size'=>8, 'valign' => 'center');
        foreach ($facturas as $factura)
        {
            if($c%2!=0)
                $color='e3ece0';
            else
                $color='ffffff';
            $c++;
            $propietario=$factura->linealt->propietarioent;
            $cargo='';
            $articulo=$factura->linealt->altarticulo;
            $serial='';
            $balance=$factura->balance;
            if($propietario!=null&&$propietario!='Sin propietario'){
                $cargo=$propietario->cargogerencial;
                $propietario=$propietario->titulo;
            }
            if($articulo!=null){
                $serial=$articulo->serial;
                $articulo=$articulo->modeloent->marca.' '.$articulo->modeloent->modelo;
            }
            $operadora=$factura->linealt->operadora;
            if($operadora=='Movilnet'){
                $colorop=$colormovil;
                $cmovil++;
                $extramovil+=$factura->cargos_extra;
                $balancemovil+=$balance;
            }
            else{
                $colorop=$colormovis;
                $cmovis++;
                $extramovis+=$factura->cargos_extra;
                $balancemovis+=$balance;
            }
            $cellstyle=array('cellMargin' => 80, 'valign' => 'center','bgColor' => $color);
            $ROW = $table->addRow();
            $ROW->addCell(500, $cellstyle)
                ->addTextRun($textrunstyle)
                ->addText($c,$textstyle);
            $ROW->addCell(775, array('cellMargin' => 80, 'valign' => 'center','bgColor' => $colorop))
                ->addTextRun($textrunstyle)
                ->addText($operadora,array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
            $ROW->addCell(1000, $cellstyle)
                ->addTextRun($textrunstyle)
                ->addText($factura->lineano,$textstyle);
            $ROW->addCell(2000, $cellstyle)
                ->addTextRun($textrunstyle)
                ->addText($propietario,$textstyle);
            $ROW->addCell(2475, $cellstyle)
                ->addTextRun($textrunstyle)
                ->addText($cargo,$textstyle);
            $ROW->addCell(2500, $cellstyle)
                ->addTextRun($textrunstyle)
                ->addText($articulo,$textstyle);
            $ROW->addCell(2500, $cellstyle)
                ->addTextRun($textrunstyle)
                ->addText($serial,$textstyle);
            $rentascell=$ROW->addCell(1500, $cellstyle);
            $rentas=$factura->linealt->rentasalt;
            if($rentas!=null)
                foreach ($rentas as $renta)
                    $rentascell
                        ->addTextRun($textrunstyle)
                        ->addText($renta->nombre.'.',$textstyle);
            else
                $rentascell
                ->addTextRun($textrunstyle)
                ->addText('',$textstyle);
            $ROW->addCell(750, $cellstyle)
                ->addTextRun($textrunstyle)
                ->addText($factura->cargos_extra,$textstyle);
            $ROW->addCell(1000, $cellstyle)
                ->addTextRun($textrunstyle)
                ->addText($balance,$textstyle);
        }
        $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
        $table = $section->addTable(array('borderSize' => 6, 'alignment' => JcTable::CENTER,'borderColor' => 'black'));
        $ROW = $table->addRow();
        $ROW->addCell(15000, array('cellMargin' => 80, 'valign' => 'center','bgColor' => $colormovil))
            ->addTextRun($textrunstyle)
            ->addText('En el mes de '.strftime("%B").' las '.$cmovil.' lineas de la operadora MOVILNET generaron consumos por un valor de '.$balancemovil.'Bs y el monto por excesos fue equivalente a '.$extramovil.'Bs.',
                array('lineHeight'=>1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
        $table = $section->addTable(array('borderSize' => 6, 'alignment' => JcTable::CENTER,'borderColor' => 'black'));
        $ROW = $table->addRow();
        $ROW->addCell(15000, array('cellMargin' => 80, 'valign' => 'center','bgColor' => $colormovis))
            ->addTextRun($textrunstyle)
            ->addText('En el mes de '.strftime("%B").' las '.$cmovis.' lineas de la operadora MOVISTAR generaron consumos por un valor de '.$balancemovis.'Bs y el monto por excesos fue equivalente a '.$extramovis.'Bs.',
                array('lineHeight'=>1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));

        $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
        $table = $section->addTable(array('borderSize' => 0, 'alignment' => JcTable::CENTER,'borderColor' => 'white'));
        $ROW = $table->addRow();
        $ROW->addCell(15000, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'white'))
            ->addTextRun($textrunstyle)
            ->addText('Este es un documento referencial, generado por el Sistema web de control de inventario y telefonía WIT, a petición del usuario '.$user.' a las '.date("H:i:s").' del '.date("Y-m-d").'.',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>false, 'size'=>8, 'valign' => 'center'));
        $file='Facturacion de '.date("Y-m-d H-i-s").'.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($file);
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename='.$file );
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Description: File Transfer");
        header("Content-Length: " . filesize($file));
        header('Cache-Control: must-revalidate, post-check=1, pre-check=1');
        header('Expires: 0');
        flush();
        $fp = fopen($file, "r");
        while (!feof($fp)) {
            echo fread($fp, 65536);
            flush();
        }
        fclose($fp);
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save("php://output");
        unlink($file);
    }
    public function tipoasignacion($proceso,$solicitante,$supervisor,$encargado)
    {
        $phpWord = new PHPWord();
        $sectionStyle=array('pageSizeH'=>Converter::cmToTwip(27.94),'pageSizeW'=>Converter::cmToTwip(21.59));
        $section = $phpWord->addSection($sectionStyle);
        $section->setStyle(array());
        $fancyTableStyle = array('borderSize' => 12, 'borderColor' => 'green');
        $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFFFF');
        $cellHCentered = array('alignment' => Jc::CENTER);
        $spanTableStyleName = 'Colspan Rowspan';
        $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
        $table = $section->addTable($spanTableStyleName);
        $table->addRow();
        $table->addCell(2500, array('vMerge' => 'restart', 'bgColor' => 'FFFFFF'))->addImage('../webroot/img/fertinitrorif.png',array(
            'width'            => Converter::cmToPixel(3.42),
            'height'           => Converter::cmToPixel(2),
            'positioning'      => Image::POSITION_ABSOLUTE,
            'posHorizontal'    => Image::POSITION_HORIZONTAL_LEFT,
            'posHorizontalRel' => Image::POSITION_RELATIVE_TO_COLUMN,
            'posVertical'      => Image::POSITION_VERTICAL_TOP,
            'posVerticalRel'   => Image::POSITION_RELATIVE_TO_PAGE,
        ));
        $cell2 = $table->addCell(6500, array('cellMargin' => 80,'gridSpan' => 2, 'valign' => 'center'));
        $textrun2 = $cell2->addTextRun( array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1));
        $textrun2->addText('Fertilizantes Nitrogenados de Venezuela, FERTINITRO, C.E.C.',array('name' => 'Arial Narrow','bold'=>true,'color'=>'green','size'=>'14'));
        $textrun2->addTextBreak(1,array('spacing' => 240, 'size' => 24));
        $textrun2->addText(' ');
        $textrun2->addTextBreak(1,array('spacing' => 240, 'size' => 24));
        $textrun2->addText('ASIGNACIÓN DE EQUIPOS DE INFORMÁTICA Y TELECOMUNICACIONES', array('name'=>'Arial','bold' => true,'color'=>'black', 'size'=>'10','valign' => 'center','line' => 24),$cellHCentered);
        $table->addCell(2000, $cellRowSpan)->addImage('../webroot/img/logoit.png',array(
            'positioning'      => Image::POSITION_RELATIVE,
            'posHorizontal'    => Image::POSITION_HORIZONTAL_CENTER,
            'posHorizontalRel' => Image::POSITION_RELATIVE_TO_COLUMN,
            'posVertical'      => Image::POSITION_VERTICAL_TOP,
            'posVerticalRel'   => Image::POSITION_RELATIVE_TO_LINE,
            'marginLeft'    => 1,
            'width'         => 88,
            'height'        => 70));
        $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
        $table = $section->addTable(array('borderSize' => 0, 'alignment' => JcTable::CENTER));
        $cell = $table->addRow()->addCell(11000, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'c0c0c0'));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1));
        $textrun->addText('IDENTIFICACIÓN DEL SOLICITANTE',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $cell = $table->addRow()->addCell(11000, array('bgColor' => 'ffffff','lineHeight'=>1.5));
        $innert1  = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow1=$innert1->addRow();
        $innercell11 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>16,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell11->addText('Nombre y Apellido: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell11->addText($solicitante->nombre.' '.$solicitante->apellido,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell12 =$innerrow1->addCell(4000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>16,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell12->addText('C.I.: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell12->addText($solicitante->cedula,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell13 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>16,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell13->addText('Extensión: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell13->addText($solicitante->extension,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innert2 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow2=$innert2->addRow();
        $innercell21=$innerrow2->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell21->addText('Correo: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell21->addText($solicitante->email,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell22=$innerrow2->addCell(4000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell22->addText('Supervisor: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell22->addText($solicitante->supervisor!=null ? $solicitante->supervisor->titulo : '',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell23=$innerrow2->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell23->addText('Area: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell23->addText($solicitante->area,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innert3 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow3=$innert3->addRow();
        $innercell31=$innerrow3->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell31->addText('Gerencia: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell31->addText($solicitante->gerencia,array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell32=$innerrow3->addCell(4000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell32->addText('Cargo: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell32->addText($solicitante->cargo,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell33=$innerrow3->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell33->addText('Ubicación: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell33->addText($solicitante->puesto_de_trabajo,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
        $table = $section->addTable(array('borderSize' => 0, 'alignment' => JcTable::CENTER));
        $cell = $table->addRow()->addCell(11000, array('gridSpan' => 7,'valign' => 'center','bgColor' => 'c0c0c0'));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 0,'size' => 1));
        $textrun->addText('EQUIPOS ASIGNADOS',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $row = $table->addRow();
        $row->addCell(1800, ['vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Tipo de Equipo',array('valign' => 'center','bold'=>true));
        $row->addCell(1200, ['vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Accesorios',array('valign' => 'center','bold'=>true));
        $row->addCell(1800, ['gridSpan' => 2, 'vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Asignación',array('valign' => 'center','bold'=>true));
        $row->addCell(5200, ['gridSpan' => 3, 'vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Identificación del equipo',array('valign' => 'center','bold'=>true));
        $row = $table->addRow();
        $row->addCell(null, ['vMerge' => 'continue','borderSize'=>0]);
        $row->addCell(null, ['vMerge' => 'continue','borderSize'=>0]);
        $row->addCell(900,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Desde',array('valign' => 'center','bold'=>true));
        $row->addCell(900,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('hasta',array('valign' => 'center','bold'=>true));
        $row->addCell(1100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Marca',array('valign' => 'center','bold'=>true));
        $row->addCell(2100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Modelo',array('valign' => 'center','bold'=>true));
        $row->addCell(3000,array('borderSize'=>0))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Serial',array('valign' => 'center','bold'=>true));
        foreach ($proceso->asignaciones as $asignacion)
        {
            $row = $table->addRow();
            $row->addCell(1800,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->articuloent->modeloent->tipo_de_articulo,array('valign' => 'center','bold'=>false));
            $row->addCell(1200,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->articuloent->accesorioent!=null ? $asignacion->articuloent->accesorioent->descripcion : '',array('valign' => 'center','bold'=>false));
            $row->addCell(900,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->created,array('valign' => 'center','bold'=>false));
            $row->addCell(900,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->hasta,array('valign' => 'center','bold'=>false));
            $row->addCell(1100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->articuloent->modeloent->marca,array('valign' => 'center','bold'=>false));
            $row->addCell(2100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->articuloent->modeloent->modelo,array('valign' => 'center','bold'=>false));
            $row->addCell(3000,array('borderSize'=>0))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->articuloent->serial,array('valign' => 'center','bold'=>false));
        }
        $cell = $table->addRow()->addCell(11000, array('gridSpan' => 7,'bgColor' => 'ffffff'));
        $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('Observaciones:',array('valign' => 'left'));
        $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText($proceso->observaciones,array('valign' => 'left'));
        $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('',array('valign' => 'left'));
        $row = $table->addRow();
        $row->addCell(11000,array('valign' => 'center','bgColor' => 'c0c0c0','gridSpan' => 7,'borderSize'=>3))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 0,'size' => 1))
            ->addText('CONDICIONES GENERALES DE LA ASIGNACIÓN',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $row = $table->addRow();
        $text = $row->addCell(11000,array('spaceAfter' => 0,'size' => 1,'gridSpan' => 7,'borderSize'=>3));
        $multilevelNumberingStyleName = 'multilevel';
        $phpWord->addNumberingStyle(
            $multilevelNumberingStyleName,
            array(
                'type'   => 'multilevel',
                'levels' => array(
                    array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
                    array('format' => 'upperLetter', 'text' => '%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
                ),
            )
        );
        $paragraphStyleName = 'P-Style';
        $phpWord->addParagraphStyle($paragraphStyleName, array('spaceAfter' => 5));
        $text->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('El solicitante declara:',array('valign' => 'left'));
        $text->addListItem('Que ha recibido de FERTINITRO, en calidad de préstamo y  por tiempo determinado, los equipos arriba descritos de su propiedad, en el entendido que los mismos serán utilizados en asuntos de trabajo relacionado con labores de la Empresa.',
            0,array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Conocer que conforme a lo dispuesto en el artículo 102 de la Ley Orgánica del trabajo literal G, constituyen causal justificada de despido: el perjuicio material causado intencionalmente o con negligencia grave en las máquinas, herramientas y útiles de trabajo y mobiliario de la empresa.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Conocer las normas de Protección de Activos de Información (PAI).',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Ser responsable por cualquier daño, robo o pérdida de los equipos causado o derivado de hechos o actuaciones intencionales o con negligencia y se compromete a restituirlo, pagando su costo de reposición.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Que en caso de daño, robo o perdida de los equipos hará un Reporte de Pérdida de Propiedad (RPP) de los equipos y lo presentará a Prevención y Control de Pérdida (PCP) el primer día hábil siguiente. En caso de robo o pérdida deberá anexar la denuncia realizada en la Cuerpo de Investigaciones Científicas, Penales y criminalistas (CICPC).',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Que está autorizado a sacar del edificio los equipos portátiles que tengan el debido  carnet de identificación. Queda terminantemente prohibido que los equipos pertenecientes a la Empresa, se intercambien o presten a terceros.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Que está consciente que los equipos forman parte de la infraestructura de tecnología de información de FERTINITRO y se compromete a salvaguardarlos con la debida diligencia. Se compromete a devolver  los equipos en las mismas condiciones operativas en las cuales les fueron entregados.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Que no hará reproducción parcial o total del "software" existente en los equipos suministrados, ni instalará "software" adicional en el mismo, dando cumplimiento a lo establecido en la Norma PAI.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $cell = $table->addRow()->addCell(11000, array('cellMargin' => 80,'gridSpan' => 7,'vMerge' => 'restart','bgColor' => 'ffffff'));
        $innert0 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow0=$innert0->addRow();
        $innercell01 =$innerrow0->addCell(3500, array('cellMargin' => 80,'bgColor' => 'ffffff'))->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>20,'spaceAfter' => 3,'size' => 16,'lineHeight'=>1.5));
        $innercell01->addText('CONTROL DE ACTIVOS',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $innercell02 =$innerrow0->addCell(4000, array('cellMargin' => 80,'bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>20,'spaceAfter' => 0,'size' => 1,'lineHeight'=>1.5));
        $innercell02->addText('SOPORTE Y ATENCIÓN A USUARIOS',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $innercell03 =$innerrow0->addCell(3500, array('cellMargin' => 80,'bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>20,'spaceAfter' => 3,'size' => 16,'lineHeight'=>1.5));
        $innercell03->addText('SOLICITANTE:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $innert1  = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow1=$innert1->addRow();
        $innercell11 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 2,'size' => 8,'lineHeight'=>1.5));
        $innercell11->addText('Fecha: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell11->addText('',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell12 =$innerrow1->addCell(4000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell12->addText('Fecha: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell12->addText('',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell13 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell13->addText('Fecha: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell13->addText('',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innert2 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow2=$innert2->addRow();
        $innercell21=$innerrow2->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 2,'size' => 16,'lineHeight'=>2));
        $innercell21->addText('Nombre: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell21->addText($supervisor->titulo,array('name' => 'Arial', 'size'=>10, 'valign' => 'left'));
        $innercell22=$innerrow2->addCell(4000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell22->addText('Nombre: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell22->addText($encargado->titulo,array('name' => 'Arial', 'size'=>10, 'valign' => 'left'));
        $innercell23=$innerrow2->addCell(3500, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell23->addText('Nombre: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell23->addText($solicitante->titulo,array('name' => 'Arial', 'size'=>10, 'valign' => 'left'));
        $innert3 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow3=$innert3->addRow();
        $innercell31=$innerrow3->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 2,'size' => 16,'lineHeight'=>1.5));
        $innercell31->addText('Firma: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left','lineHeight'=>1));
        $innercell31->addText('_______________',array('name' => 'Arial', 'size'=>8, 'valign' => 'left','lineHeight'=>1));
        $innercell32=$innerrow3->addCell(4000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8,'lineHeight'=>1));
        $innercell32->addText('Firma: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left','lineHeight'=>1));
        $innercell32->addText('_______________',array('name' => 'Arial', 'size'=>8, 'valign' => 'left','lineHeight'=>1));
        $innercell33=$innerrow3->addCell(3500, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8,'lineHeight'=>1));
        $innercell33->addText('Firma: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left','lineHeight'=>1));
        $innercell33->addText('_______________',array('name' => 'Arial', 'size'=>8, 'valign' => 'left','lineHeight'=>1));
        $section->addTextRun(array('spaceAfter' => 2,'size' => 16,'lineHeight'=>1.5,'alignment' => JcTable::END))->addText('REV-001-IT01-CA',array('name' => 'Arial','valign' => 'right'));
        $name='plantilla de '.$proceso->titulo;
        $no='__'.random_int(0,188);
        $file=$name.$no.'.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($file);
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename='.$file );
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Description: File Transfer");
        header("Content-Length: " . filesize($file));
        header('Cache-Control: must-revalidate, post-check=1, pre-check=1');
        header('Expires: 0');
        flush();
        $fp = fopen($file, "r");
        while (!feof($fp)) {
            echo fread($fp, 65536);
            flush();
        }
        fclose($fp);
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save("php://output");
        unlink($file);
    }
    public function tipodevolucion($proceso,$solicitante,$supervisor,$encargado)
    {
        $phpWord = new PHPWord();
        $sectionStyle=array('pageSizeH'=>Converter::cmToTwip(27.94),'pageSizeW'=>Converter::cmToTwip(21.59));
        $section = $phpWord->addSection($sectionStyle);
        $section->setStyle(array());
        $fancyTableStyle = array('borderSize' => 12, 'borderColor' => 'green');
        $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFFFF');
        $cellHCentered = array('alignment' => Jc::CENTER);
        $spanTableStyleName = 'Colspan Rowspan';
        $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
        $table = $section->addTable($spanTableStyleName);
        $table->addRow();
        $table->addCell(2500, array('vMerge' => 'restart', 'bgColor' => 'FFFFFF'))->addImage('../webroot/img/fertinitrorif.png',array(
            'width'            => Converter::cmToPixel(3.42),
            'height'           => Converter::cmToPixel(2),
            'positioning'      => Image::POSITION_ABSOLUTE,
            'posHorizontal'    => Image::POSITION_HORIZONTAL_LEFT,
            'posHorizontalRel' => Image::POSITION_RELATIVE_TO_COLUMN,
            'posVertical'      => Image::POSITION_VERTICAL_TOP,
            'posVerticalRel'   => Image::POSITION_RELATIVE_TO_PAGE,
        ));
        $cell2 = $table->addCell(6500, array('cellMargin' => 80,'gridSpan' => 2, 'valign' => 'center'));
        $textrun2 = $cell2->addTextRun( array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1));
        $textrun2->addText('Fertilizantes Nitrogenados de Venezuela, FERTINITRO, C.E.C.',array('name' => 'Arial Narrow','bold'=>true,'color'=>'green','size'=>'14'));
        $textrun2->addTextBreak(1,array('spacing' => 240, 'size' => 24));
        $textrun2->addText(' ');
        $textrun2->addTextBreak(1,array('spacing' => 240, 'size' => 24));
        $textrun2->addText('DEVOLUCIÓN DE EQUIPOS DE INFORMÁTICA Y TELECOMUNICACIONES', array('name'=>'Arial','bold' => true,'color'=>'black', 'size'=>'10','valign' => 'center','line' => 24),$cellHCentered);
        $table->addCell(2000, $cellRowSpan)->addImage('../webroot/img/logoit.png',array(
            'positioning'      => Image::POSITION_RELATIVE,
            'posHorizontal'    => Image::POSITION_HORIZONTAL_CENTER,
            'posHorizontalRel' => Image::POSITION_RELATIVE_TO_COLUMN,
            'posVertical'      => Image::POSITION_VERTICAL_TOP,
            'posVerticalRel'   => Image::POSITION_RELATIVE_TO_LINE,
            'marginLeft'    => 1,
            'width'         => 88,
            'height'        => 70));
        $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
        $table = $section->addTable(array('borderSize' => 0, 'alignment' => JcTable::CENTER));
        $cell = $table->addRow()->addCell(11000, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'c0c0c0'));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1));
        $textrun->addText('IDENTIFICACIÓN DEL SOLICITANTE',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $cell = $table->addRow()->addCell(11000, array('bgColor' => 'ffffff','lineHeight'=>1.5));
        $innert1  = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow1=$innert1->addRow();
        $innercell11 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>16,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell11->addText('Nombre y Apellido: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell11->addText($solicitante->nombre.' '.$solicitante->apellido,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell12 =$innerrow1->addCell(4000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>16,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell12->addText('C.I.: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell12->addText($solicitante->cedula,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell13 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>16,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell13->addText('Extensión: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell13->addText($solicitante->extension,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innert2 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow2=$innert2->addRow();
        $innercell21=$innerrow2->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell21->addText('Correo: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell21->addText($solicitante->email,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell22=$innerrow2->addCell(4000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell22->addText('Supervisor: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell22->addText($solicitante->supervisor!=null ? $solicitante->supervisor->titulo : '',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell23=$innerrow2->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell23->addText('Area: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell23->addText($solicitante->area,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innert3 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow3=$innert3->addRow();
        $innercell31=$innerrow3->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell31->addText('Gerencia: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell31->addText($solicitante->gerencia,array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell32=$innerrow3->addCell(4000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell32->addText('Cargo: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell32->addText($solicitante->cargo,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell33=$innerrow3->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell33->addText('Ubicación: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell33->addText($solicitante->puesto_de_trabajo,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
        $table = $section->addTable(array('borderSize' => 0, 'alignment' => JcTable::CENTER));
        $cell = $table->addRow()->addCell(11000, array('gridSpan' => 7,'valign' => 'center','bgColor' => 'c0c0c0'));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 0,'size' => 1));
        $textrun->addText('EQUIPOS ASIGNADOS',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $row = $table->addRow();
        $row->addCell(1800, ['vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Tipo de Equipo',array('valign' => 'center','bold'=>true));
        $row->addCell(1200, ['vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Accesorios',array('valign' => 'center','bold'=>true));
        $row->addCell(1800, ['gridSpan' => 2, 'vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Devuelto el',array('valign' => 'center','bold'=>true));
        $row->addCell(5200, ['gridSpan' => 3, 'vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Identificación del equipo',array('valign' => 'center','bold'=>true));
        $row = $table->addRow();
        $row->addCell(null, ['vMerge' => 'continue','borderSize'=>0]);
        $row->addCell(null, ['vMerge' => 'continue','borderSize'=>0]);
        $row->addCell(null, ['gridSpan' => 2,'vMerge' => 'continue','borderSize'=>0]);
        $row->addCell(1100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Marca',array('valign' => 'center','bold'=>true));
        $row->addCell(2100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Modelo',array('valign' => 'center','bold'=>true));
        $row->addCell(3000,array('borderSize'=>0))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Serial',array('valign' => 'center','bold'=>true));
        foreach ($proceso->devoluciones as $devolucion)
        {
            $row = $table->addRow();
            $row->addCell(1800,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($devolucion->articuloent->modeloent->tipo_de_articulo,array('valign' => 'center','bold'=>false));
            $row->addCell(1200,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($devolucion->articuloent->accesorioent!=null ? $devolucion->articuloent->accesorioent->descripcion : '',array('valign' => 'center','bold'=>false));
            $row->addCell(1800,array('gridSpan' => 2,'borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($proceso->fecha_de_aprobacion,array('valign' => 'center','bold'=>false));
            $row->addCell(1100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($devolucion->articuloent->modeloent->marca,array('valign' => 'center','bold'=>false));
            $row->addCell(2100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($devolucion->articuloent->modeloent->modelo,array('valign' => 'center','bold'=>false));
            $row->addCell(3000,array('borderSize'=>0))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($devolucion->articuloent->serial,array('valign' => 'center','bold'=>false));
        }
        $cell = $table->addRow()->addCell(11000, array('gridSpan' => 7,'bgColor' => 'ffffff'));
        $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('Observaciones:',array('valign' => 'left'));
        $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText($proceso->observaciones,array('valign' => 'left'));
        $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('',array('valign' => 'left'));
        $row = $table->addRow();
        $row->addCell(11000,array('valign' => 'center','bgColor' => 'c0c0c0','gridSpan' => 7,'borderSize'=>3))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 0,'size' => 1))
            ->addText('CONDICIONES GENERALES DE LA ASIGNACIÓN',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $row = $table->addRow();
        $text = $row->addCell(11000,array('spaceAfter' => 0,'size' => 1,'gridSpan' => 7,'borderSize'=>3));
        $multilevelNumberingStyleName = 'multilevel';
        $phpWord->addNumberingStyle(
            $multilevelNumberingStyleName,
            array(
                'type'   => 'multilevel',
                'levels' => array(
                    array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
                    array('format' => 'upperLetter', 'text' => '%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
                ),
            )
        );
        $paragraphStyleName = 'P-Style';
        $phpWord->addParagraphStyle($paragraphStyleName, array('spaceAfter' => 5));
        $text->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText(' El Usuario declara:',array('valign' => 'left'));
        $text->addListItem('El equipo (s) solo deberá ser recibido por el departamento de I.T de FERTINITRO, equipo que anteriormente  fue asignado en calidad de préstamo y  por tiempo determinado, serán recibido de acuerdo a las especificaciones  descritas  en el espacio de observación.',
            0,array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Todos los accesorios recibidos en el momento de la asignación de los equipos deberán ser devueltos junto con el equipo asignado.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('En caso de que se demuestre que el usuario del equipo asignado es responsable por cualquier daño, robo o pérdida de los equipos, causado o derivado por hechos o actuaciones intencionales o por negligencia, este se comprometerá a restituirlo, pagando el costo total de dicho equipo.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('El equipo solo podrá ser devuelto por la persona a la cual se le hizo la asignación del mismo ya que deberá firmar la constancia de la devolución del equipos.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $cell = $table->addRow()->addCell(11000, array('cellMargin' => 80,'gridSpan' => 7,'vMerge' => 'restart','bgColor' => 'ffffff'));
        $innert0 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow0=$innert0->addRow();
        $innercell01 =$innerrow0->addCell(3500, array('cellMargin' => 80,'bgColor' => 'ffffff'))->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>20,'spaceAfter' => 3,'size' => 16,'lineHeight'=>1.5));
        $innercell01->addText('CONTROL DE ACTIVOS',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $innercell02 =$innerrow0->addCell(4000, array('cellMargin' => 80,'bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>20,'spaceAfter' => 0,'size' => 1,'lineHeight'=>1.5));
        $innercell02->addText('SOPORTE Y ATENCIÓN A USUARIOS',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $innercell03 =$innerrow0->addCell(3500, array('cellMargin' => 80,'bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>20,'spaceAfter' => 3,'size' => 16,'lineHeight'=>1.5));
        $innercell03->addText('ENTREGADO POR:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $innert1  = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow1=$innert1->addRow();
        $innercell11 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 2,'size' => 8,'lineHeight'=>1.5));
        $innercell11->addText('Fecha: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell11->addText('',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell12 =$innerrow1->addCell(4000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell12->addText('Fecha: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell12->addText('',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell13 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell13->addText('Fecha: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell13->addText('',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innert2 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow2=$innert2->addRow();
        $innercell21=$innerrow2->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 2,'size' => 16,'lineHeight'=>2));
        $innercell21->addText('Nombre: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell21->addText($supervisor->titulo,array('name' => 'Arial', 'size'=>10, 'valign' => 'left'));
        $innercell22=$innerrow2->addCell(4000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell22->addText('Nombre: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell22->addText($encargado->titulo,array('name' => 'Arial', 'size'=>10, 'valign' => 'left'));
        $innercell23=$innerrow2->addCell(3500, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell23->addText('Nombre: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell23->addText($solicitante->titulo,array('name' => 'Arial', 'size'=>10, 'valign' => 'left'));
        $innert3 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow3=$innert3->addRow();
        $innercell31=$innerrow3->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 2,'size' => 16,'lineHeight'=>1.5));
        $innercell31->addText('Firma: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left','lineHeight'=>1));
        $innercell31->addText('_______________',array('name' => 'Arial', 'size'=>8, 'valign' => 'left','lineHeight'=>1));
        $innercell32=$innerrow3->addCell(4000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8,'lineHeight'=>1));
        $innercell32->addText('Firma: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left','lineHeight'=>1));
        $innercell32->addText('_______________',array('name' => 'Arial', 'size'=>8, 'valign' => 'left','lineHeight'=>1));
        $innercell33=$innerrow3->addCell(3500, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8,'lineHeight'=>1));
        $innercell33->addText('Firma: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left','lineHeight'=>1));
        $innercell33->addText('_______________',array('name' => 'Arial', 'size'=>8, 'valign' => 'left','lineHeight'=>1));
        $section->addTextRun(array('spaceAfter' => 2,'size' => 16,'lineHeight'=>1.5,'alignment' => JcTable::END))->addText('REV-001-IT02-CA',array('name' => 'Arial','valign' => 'right'));
        $name='plantilla de '.$proceso->titulo;
        $no='__'.random_int(0,188);
        $file=$name.$no.'.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($file);
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename='.$file );
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Description: File Transfer");
        header("Content-Length: " . filesize($file));
        header('Cache-Control: must-revalidate, post-check=1, pre-check=1');
        header('Expires: 0');
        flush();
        $fp = fopen($file, "r");
        while (!feof($fp)) {
            echo fread($fp, 65536);
            flush();
        }
        fclose($fp);
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save("php://output");
        unlink($file);
    }
    public function tipomixto($proceso,$solicitante,$supervisor,$encargado){
        $phpWord = new PHPWord();
        $sectionStyle=array('pageSizeH'=>Converter::cmToTwip(27.94),'pageSizeW'=>Converter::cmToTwip(21.59));
        $section = $phpWord->addSection($sectionStyle);
        $section->setStyle(array());
        $fancyTableStyle = array('borderSize' => 12, 'borderColor' => 'green');
        $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFFFF');
        $cellHCentered = array('alignment' => Jc::CENTER);
        $spanTableStyleName = 'Colspan Rowspan';
        $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
        $table = $section->addTable($spanTableStyleName);
        $table->addRow();
        $table->addCell(2500, array('vMerge' => 'restart', 'bgColor' => 'FFFFFF'))->addImage('../webroot/img/fertinitrorif.png',array(
            'width'            => Converter::cmToPixel(3.42),
            'height'           => Converter::cmToPixel(2),
            'positioning'      => Image::POSITION_ABSOLUTE,
            'posHorizontal'    => Image::POSITION_HORIZONTAL_LEFT,
            'posHorizontalRel' => Image::POSITION_RELATIVE_TO_COLUMN,
            'posVertical'      => Image::POSITION_VERTICAL_TOP,
            'posVerticalRel'   => Image::POSITION_RELATIVE_TO_PAGE,
        ));
        $cell2 = $table->addCell(6500, array('cellMargin' => 80,'gridSpan' => 2, 'valign' => 'center'));
        $textrun2 = $cell2->addTextRun( array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1));
        $textrun2->addText('Fertilizantes Nitrogenados de Venezuela, FERTINITRO, C.E.C.',array('name' => 'Arial Narrow','bold'=>true,'color'=>'green','size'=>'14'));
        $textrun2->addTextBreak(1,array('spacing' => 240, 'size' => 24));
        $textrun2->addText(' ');
        $textrun2->addTextBreak(1,array('spacing' => 240, 'size' => 24));
        $textrun2->addText('ASIGNACIÓN DE EQUIPOS DE INFORMÁTICA Y TELECOMUNICACIONES', array('name'=>'Arial','bold' => true,'color'=>'black', 'size'=>'10','valign' => 'center','line' => 24),$cellHCentered);
        $table->addCell(2000, $cellRowSpan)->addImage('../webroot/img/logoit.png',array(
            'positioning'      => Image::POSITION_RELATIVE,
            'posHorizontal'    => Image::POSITION_HORIZONTAL_CENTER,
            'posHorizontalRel' => Image::POSITION_RELATIVE_TO_COLUMN,
            'posVertical'      => Image::POSITION_VERTICAL_TOP,
            'posVerticalRel'   => Image::POSITION_RELATIVE_TO_LINE,
            'marginLeft'    => 1,
            'width'         => 88,
            'height'        => 70));
        $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
        $table = $section->addTable(array('borderSize' => 0, 'alignment' => JcTable::CENTER));
        $cell = $table->addRow()->addCell(11000, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'c0c0c0'));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1));
        $textrun->addText('IDENTIFICACIÓN DEL SOLICITANTE',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $cell = $table->addRow()->addCell(11000, array('bgColor' => 'ffffff','lineHeight'=>1.5));
        $innert1  = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow1=$innert1->addRow();
        $innercell11 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>16,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell11->addText('Nombre y Apellido: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell11->addText($solicitante->nombre.' '.$solicitante->apellido,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell12 =$innerrow1->addCell(4000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>16,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell12->addText('C.I.: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell12->addText($solicitante->cedula,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell13 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>16,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell13->addText('Extensión: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell13->addText($solicitante->extension,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innert2 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow2=$innert2->addRow();
        $innercell21=$innerrow2->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell21->addText('Correo: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell21->addText($solicitante->email,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell22=$innerrow2->addCell(4000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell22->addText('Supervisor: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell22->addText($solicitante->supervisor!=null ? $solicitante->supervisor->titulo : '',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell23=$innerrow2->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell23->addText('Area: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell23->addText($solicitante->area,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innert3 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow3=$innert3->addRow();
        $innercell31=$innerrow3->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell31->addText('Gerencia: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell31->addText($solicitante->gerencia,array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell32=$innerrow3->addCell(4000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell32->addText('Cargo: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell32->addText($solicitante->cargo,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell33=$innerrow3->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell33->addText('Ubicación: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell33->addText($solicitante->puesto_de_trabajo,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
        $table = $section->addTable(array('borderSize' => 0, 'alignment' => JcTable::CENTER));
        $cell = $table->addRow()->addCell(11000, array('gridSpan' => 7,'valign' => 'center','bgColor' => 'c0c0c0'));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 0,'size' => 1));
        $textrun->addText('EQUIPOS ASIGNADOS',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $row = $table->addRow();
        $row->addCell(1800, ['vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Tipo de Equipo',array('valign' => 'center','bold'=>true));
        $row->addCell(1200, ['vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Accesorios',array('valign' => 'center','bold'=>true));
        $row->addCell(1800, ['gridSpan' => 2, 'vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Asignación',array('valign' => 'center','bold'=>true));
        $row->addCell(5200, ['gridSpan' => 3, 'vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Identificación del equipo',array('valign' => 'center','bold'=>true));
        $row = $table->addRow();
        $row->addCell(null, ['vMerge' => 'continue','borderSize'=>0]);
        $row->addCell(null, ['vMerge' => 'continue','borderSize'=>0]);
        $row->addCell(900,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Desde',array('valign' => 'center','bold'=>true));
        $row->addCell(900,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('hasta',array('valign' => 'center','bold'=>true));
        $row->addCell(1100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Marca',array('valign' => 'center','bold'=>true));
        $row->addCell(2100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Modelo',array('valign' => 'center','bold'=>true));
        $row->addCell(3000,array('borderSize'=>0))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Serial',array('valign' => 'center','bold'=>true));
        foreach ($proceso->asignaciones as $asignacion)
        {
            $row = $table->addRow();
            $row->addCell(1800,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->articuloent->modeloent->tipo_de_articulo,array('valign' => 'center','bold'=>false));
            $row->addCell(1200,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->articuloent->accesorioent!=null ? $asignacion->articuloent->accesorioent->descripcion : '',array('valign' => 'center','bold'=>false));
            $row->addCell(900,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->created,array('valign' => 'center','bold'=>false));
            $row->addCell(900,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->hasta,array('valign' => 'center','bold'=>false));
            $row->addCell(1100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->articuloent->modeloent->marca,array('valign' => 'center','bold'=>false));
            $row->addCell(2100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->articuloent->modeloent->modelo,array('valign' => 'center','bold'=>false));
            $row->addCell(3000,array('borderSize'=>0))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($asignacion->articuloent->serial,array('valign' => 'center','bold'=>false));
        }
        $cell = $table->addRow()->addCell(11000, array('gridSpan' => 7,'bgColor' => 'ffffff'));
        $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('Observaciones:',array('valign' => 'left'));
        $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText($proceso->observaciones,array('valign' => 'left'));
        $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('',array('valign' => 'left'));
        $row = $table->addRow();
        $row->addCell(11000,array('valign' => 'center','bgColor' => 'c0c0c0','gridSpan' => 7,'borderSize'=>3))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 0,'size' => 1))
            ->addText('CONDICIONES GENERALES DE LA ASIGNACIÓN',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $row = $table->addRow();
        $text = $row->addCell(11000,array('spaceAfter' => 0,'size' => 1,'gridSpan' => 7,'borderSize'=>3));
        $multilevelNumberingStyleName = 'multilevel';
        $phpWord->addNumberingStyle(
            $multilevelNumberingStyleName,
            array(
                'type'   => 'multilevel',
                'levels' => array(
                    array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
                    array('format' => 'upperLetter', 'text' => '%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
                ),
            )
        );
        $paragraphStyleName = 'P-Style';
        $phpWord->addParagraphStyle($paragraphStyleName, array('spaceAfter' => 5));
        $text->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('El solicitante declara:',array('valign' => 'left'));
        $text->addListItem('Que ha recibido de FERTINITRO, en calidad de préstamo y  por tiempo determinado, los equipos arriba descritos de su propiedad, en el entendido que los mismos serán utilizados en asuntos de trabajo relacionado con labores de la Empresa.',
            0,array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Conocer que conforme a lo dispuesto en el artículo 102 de la Ley Orgánica del trabajo literal G, constituyen causal justificada de despido: el perjuicio material causado intencionalmente o con negligencia grave en las máquinas, herramientas y útiles de trabajo y mobiliario de la empresa.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Conocer las normas de Protección de Activos de Información (PAI).',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Ser responsable por cualquier daño, robo o pérdida de los equipos causado o derivado de hechos o actuaciones intencionales o con negligencia y se compromete a restituirlo, pagando su costo de reposición.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Que en caso de daño, robo o perdida de los equipos hará un Reporte de Pérdida de Propiedad (RPP) de los equipos y lo presentará a Prevención y Control de Pérdida (PCP) el primer día hábil siguiente. En caso de robo o pérdida deberá anexar la denuncia realizada en la Cuerpo de Investigaciones Científicas, Penales y criminalistas (CICPC).',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Que está autorizado a sacar del edificio los equipos portátiles que tengan el debido  carnet de identificación. Queda terminantemente prohibido que los equipos pertenecientes a la Empresa, se intercambien o presten a terceros.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Que está consciente que los equipos forman parte de la infraestructura de tecnología de información de FERTINITRO y se compromete a salvaguardarlos con la debida diligencia. Se compromete a devolver  los equipos en las mismas condiciones operativas en las cuales les fueron entregados.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Que no hará reproducción parcial o total del "software" existente en los equipos suministrados, ni instalará "software" adicional en el mismo, dando cumplimiento a lo establecido en la Norma PAI.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $cell = $table->addRow()->addCell(11000, array('cellMargin' => 80,'gridSpan' => 7,'vMerge' => 'restart','bgColor' => 'ffffff'));
        $innert0 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow0=$innert0->addRow();
        $innercell01 =$innerrow0->addCell(3500, array('cellMargin' => 80,'bgColor' => 'ffffff'))->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>20,'spaceAfter' => 3,'size' => 16,'lineHeight'=>1.5));
        $innercell01->addText('CONTROL DE ACTIVOS',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $innercell02 =$innerrow0->addCell(4000, array('cellMargin' => 80,'bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>20,'spaceAfter' => 0,'size' => 1,'lineHeight'=>1.5));
        $innercell02->addText('SOPORTE Y ATENCIÓN A USUARIOS',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $innercell03 =$innerrow0->addCell(3500, array('cellMargin' => 80,'bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>20,'spaceAfter' => 3,'size' => 16,'lineHeight'=>1.5));
        $innercell03->addText('SOLICITANTE:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $innert1  = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow1=$innert1->addRow();
        $innercell11 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 2,'size' => 8,'lineHeight'=>1.5));
        $innercell11->addText('Fecha: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell11->addText('',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell12 =$innerrow1->addCell(4000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell12->addText('Fecha: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell12->addText('',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell13 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell13->addText('Fecha: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell13->addText('',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innert2 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow2=$innert2->addRow();
        $innercell21=$innerrow2->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 2,'size' => 16,'lineHeight'=>2));
        $innercell21->addText('Nombre: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell21->addText($supervisor->titulo,array('name' => 'Arial', 'size'=>10, 'valign' => 'left'));
        $innercell22=$innerrow2->addCell(4000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell22->addText('Nombre: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell22->addText($encargado->titulo,array('name' => 'Arial', 'size'=>10, 'valign' => 'left'));
        $innercell23=$innerrow2->addCell(3500, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell23->addText('Nombre: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell23->addText($solicitante->titulo,array('name' => 'Arial', 'size'=>10, 'valign' => 'left'));
        $innert3 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow3=$innert3->addRow();
        $innercell31=$innerrow3->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 2,'size' => 16,'lineHeight'=>1.5));
        $innercell31->addText('Firma: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left','lineHeight'=>1));
        $innercell31->addText('_______________',array('name' => 'Arial', 'size'=>8, 'valign' => 'left','lineHeight'=>1));
        $innercell32=$innerrow3->addCell(4000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8,'lineHeight'=>1));
        $innercell32->addText('Firma: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left','lineHeight'=>1));
        $innercell32->addText('_______________',array('name' => 'Arial', 'size'=>8, 'valign' => 'left','lineHeight'=>1));
        $innercell33=$innerrow3->addCell(3500, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8,'lineHeight'=>1));
        $innercell33->addText('Firma: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left','lineHeight'=>1));
        $innercell33->addText('_______________',array('name' => 'Arial', 'size'=>8, 'valign' => 'left','lineHeight'=>1));
        $section->addTextRun(array('spaceAfter' => 2,'size' => 16,'lineHeight'=>1.5,'alignment' => JcTable::END))->addText('REV-001-IT01-CA',array('name' => 'Arial','valign' => 'right'));
        $section->addPageBreak();
        $table = $section->addTable($spanTableStyleName);
        $table->addRow();
        $table->addCell(2500, array('vMerge' => 'restart', 'bgColor' => 'FFFFFF'))->addImage('../webroot/img/fertinitrorif.png',array(
            'width'            => Converter::cmToPixel(3.42),
            'height'           => Converter::cmToPixel(2),
            'positioning'      => Image::POSITION_ABSOLUTE,
            'posHorizontal'    => Image::POSITION_HORIZONTAL_LEFT,
            'posHorizontalRel' => Image::POSITION_RELATIVE_TO_COLUMN,
            'posVertical'      => Image::POSITION_VERTICAL_TOP,
            'posVerticalRel'   => Image::POSITION_RELATIVE_TO_PAGE,
        ));
        $cell2 = $table->addCell(6500, array('cellMargin' => 80,'gridSpan' => 2, 'valign' => 'center'));
        $textrun2 = $cell2->addTextRun( array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1));
        $textrun2->addText('Fertilizantes Nitrogenados de Venezuela, FERTINITRO, C.E.C.',array('name' => 'Arial Narrow','bold'=>true,'color'=>'green','size'=>'14'));
        $textrun2->addTextBreak(1,array('spacing' => 240, 'size' => 24));
        $textrun2->addText(' ');
        $textrun2->addTextBreak(1,array('spacing' => 240, 'size' => 24));
        $textrun2->addText('DEVOLUCIÓN DE EQUIPOS DE INFORMÁTICA Y TELECOMUNICACIONES', array('name'=>'Arial','bold' => true,'color'=>'black', 'size'=>'10','valign' => 'center','line' => 24),$cellHCentered);
        $table->addCell(2000, $cellRowSpan)->addImage('../webroot/img/logoit.png',array(
            'positioning'      => Image::POSITION_RELATIVE,
            'posHorizontal'    => Image::POSITION_HORIZONTAL_CENTER,
            'posHorizontalRel' => Image::POSITION_RELATIVE_TO_COLUMN,
            'posVertical'      => Image::POSITION_VERTICAL_TOP,
            'posVerticalRel'   => Image::POSITION_RELATIVE_TO_LINE,
            'marginLeft'    => 1,
            'width'         => 88,
            'height'        => 70));
        $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
        $table = $section->addTable(array('borderSize' => 0, 'alignment' => JcTable::CENTER));
        $cell = $table->addRow()->addCell(11000, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'c0c0c0'));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 1,'size' => 1));
        $textrun->addText('IDENTIFICACIÓN DEL SOLICITANTE',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $cell = $table->addRow()->addCell(11000, array('bgColor' => 'ffffff','lineHeight'=>1.5));
        $innert1  = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow1=$innert1->addRow();
        $innercell11 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>16,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell11->addText('Nombre y Apellido: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell11->addText($solicitante->nombre.' '.$solicitante->apellido,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell12 =$innerrow1->addCell(4000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>16,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell12->addText('C.I.: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell12->addText($solicitante->cedula,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell13 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>16,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell13->addText('Extensión: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell13->addText($solicitante->extension,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innert2 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow2=$innert2->addRow();
        $innercell21=$innerrow2->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell21->addText('Correo: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell21->addText($solicitante->email,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell22=$innerrow2->addCell(4000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell22->addText('Supervisor: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell22->addText($solicitante->supervisor!=null ? $solicitante->supervisor->titulo : '',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell23=$innerrow2->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell23->addText('Area: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell23->addText($solicitante->area,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innert3 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow3=$innert3->addRow();
        $innercell31=$innerrow3->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell31->addText('Gerencia: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell31->addText($solicitante->gerencia,array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell32=$innerrow3->addCell(4000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell32->addText('Cargo: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell32->addText($solicitante->cargo,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $innercell33=$innerrow3->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceBefore'=>1,'spaceAfter' => 1, 'size' => 9,'lineHeight'=>1.5));
        $innercell33->addText('Ubicación: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell33->addText($solicitante->puesto_de_trabajo,array('name' => 'Arial', 'size'=>9, 'valign' => 'left'));
        $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
        $table = $section->addTable(array('borderSize' => 0, 'alignment' => JcTable::CENTER));
        $cell = $table->addRow()->addCell(11000, array('gridSpan' => 7,'valign' => 'center','bgColor' => 'c0c0c0'));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 0,'size' => 1));
        $textrun->addText('EQUIPOS ASIGNADOS',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $row = $table->addRow();
        $row->addCell(1800, ['vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Tipo de Equipo',array('valign' => 'center','bold'=>true));
        $row->addCell(1200, ['vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Accesorios',array('valign' => 'center','bold'=>true));
        $row->addCell(1800, ['gridSpan' => 2, 'vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Devuelto el',array('valign' => 'center','bold'=>true));
        $row->addCell(5200, ['gridSpan' => 3, 'vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Identificación del equipo',array('valign' => 'center','bold'=>true));
        $row = $table->addRow();
        $row->addCell(null, ['vMerge' => 'continue','borderSize'=>0]);
        $row->addCell(null, ['vMerge' => 'continue','borderSize'=>0]);
        $row->addCell(null, ['gridSpan' => 2,'vMerge' => 'continue','borderSize'=>0]);
        $row->addCell(1100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Marca',array('valign' => 'center','bold'=>true));
        $row->addCell(2100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Modelo',array('valign' => 'center','bold'=>true));
        $row->addCell(3000,array('borderSize'=>0))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Serial',array('valign' => 'center','bold'=>true));
        foreach ($proceso->devoluciones as $devolucion)
        {
            $row = $table->addRow();
            $row->addCell(1800,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($devolucion->articuloent->modeloent->tipo_de_articulo,array('valign' => 'center','bold'=>false));
            $row->addCell(1200,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($devolucion->articuloent->accesorioent!=null ? $devolucion->articuloent->accesorioent->descripcion : '',array('valign' => 'center','bold'=>false));
            $row->addCell(1800,array('gridSpan' => 2,'borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($proceso->fecha_de_aprobacion,array('valign' => 'center','bold'=>false));
            $row->addCell(1100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($devolucion->articuloent->modeloent->marca,array('valign' => 'center','bold'=>false));
            $row->addCell(2100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($devolucion->articuloent->modeloent->modelo,array('valign' => 'center','bold'=>false));
            $row->addCell(3000,array('borderSize'=>0))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText($devolucion->articuloent->serial,array('valign' => 'center','bold'=>false));
        }
        $cell = $table->addRow()->addCell(11000, array('gridSpan' => 7,'bgColor' => 'ffffff'));
        $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('Observaciones:',array('valign' => 'left'));
        $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText($proceso->observaciones,array('valign' => 'left'));
        $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('',array('valign' => 'left'));
        $row = $table->addRow();
        $row->addCell(11000,array('valign' => 'center','bgColor' => 'c0c0c0','gridSpan' => 7,'borderSize'=>3))
            ->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>5,'spaceAfter' => 0,'size' => 1))
            ->addText('CONDICIONES GENERALES DE LA ASIGNACIÓN',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $row = $table->addRow();
        $text = $row->addCell(11000,array('spaceAfter' => 0,'size' => 1,'gridSpan' => 7,'borderSize'=>3));
        $multilevelNumberingStyleName = 'multilevel';
        $phpWord->addNumberingStyle(
            $multilevelNumberingStyleName,
            array(
                'type'   => 'multilevel',
                'levels' => array(
                    array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
                    array('format' => 'upperLetter', 'text' => '%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
                ),
            )
        );
        $paragraphStyleName = 'P-Style';
        $phpWord->addParagraphStyle($paragraphStyleName, array('spaceAfter' => 5));
        $text->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText(' El Usuario declara:',array('valign' => 'left'));
        $text->addListItem('El equipo (s) solo deberá ser recibido por el departamento de I.T de FERTINITRO, equipo que anteriormente  fue asignado en calidad de préstamo y  por tiempo determinado, serán recibido de acuerdo a las especificaciones  descritas  en el espacio de observación.',
            0,array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('Todos los accesorios recibidos en el momento de la asignación de los equipos deberán ser devueltos junto con el equipo asignado.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $text->addListItem('En caso de que se demuestre que el usuario del equipo asignado es responsable por cualquier daño, robo o pérdida de los equipos, causado o derivado por hechos o actuaciones intencionales o por negligencia, este se comprometerá a restituirlo, pagando el costo total de dicho equipo.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
       $text->addListItem('El equipo solo podrá ser devuelto por la persona a la cual se le hizo la asignación del mismo ya que deberá firmar la constancia de la devolución del equipos.',
            0, array('spaceAfter' => 0,'name' => 'Arial', 'size'=>8, 'valign' => 'left'), $multilevelNumberingStyleName, $paragraphStyleName);
        $cell = $table->addRow()->addCell(11000, array('cellMargin' => 80,'gridSpan' => 7,'vMerge' => 'restart','bgColor' => 'ffffff'));
        $innert0 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow0=$innert0->addRow();
        $innercell01 =$innerrow0->addCell(3500, array('cellMargin' => 80,'bgColor' => 'ffffff'))->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>20,'spaceAfter' => 3,'size' => 16,'lineHeight'=>1.5));
        $innercell01->addText('CONTROL DE ACTIVOS',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $innercell02 =$innerrow0->addCell(4000, array('cellMargin' => 80,'bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>20,'spaceAfter' => 0,'size' => 1,'lineHeight'=>1.5));
        $innercell02->addText('SOPORTE Y ATENCIÓN A USUARIOS',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $innercell03 =$innerrow0->addCell(3500, array('cellMargin' => 80,'bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceBefore'=>20,'spaceAfter' => 3,'size' => 16,'lineHeight'=>1.5));
        $innercell03->addText('ENTREGADO POR:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
        $innert1  = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow1=$innert1->addRow();
        $innercell11 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 2,'size' => 8,'lineHeight'=>1.5));
        $innercell11->addText('Fecha: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell11->addText('',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell12 =$innerrow1->addCell(4000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell12->addText('Fecha: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell12->addText('',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innercell13 =$innerrow1->addCell(3500, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell13->addText('Fecha: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell13->addText('',array('name' => 'Arial', 'size'=>8, 'valign' => 'left'));
        $innert2 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow2=$innert2->addRow();
        $innercell21=$innerrow2->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 2,'size' => 16,'lineHeight'=>2));
        $innercell21->addText('Nombre: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell21->addText($supervisor->titulo,array('name' => 'Arial', 'size'=>10, 'valign' => 'left'));
        $innercell22=$innerrow2->addCell(4000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell22->addText('Nombre: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell22->addText($encargado->titulo,array('name' => 'Arial', 'size'=>10, 'valign' => 'left'));
        $innercell23=$innerrow2->addCell(3500, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8));
        $innercell23->addText('Nombre: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left'));
        $innercell23->addText($solicitante->titulo,array('name' => 'Arial', 'size'=>10, 'valign' => 'left'));
        $innert3 = $cell->addTable(array('alignment' => JcTable::CENTER));
        $innerrow3=$innert3->addRow();
        $innercell31=$innerrow3->addCell(3500, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 2,'size' => 16,'lineHeight'=>1.5));
        $innercell31->addText('Firma: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left','lineHeight'=>1));
        $innercell31->addText('_______________',array('name' => 'Arial', 'size'=>8, 'valign' => 'left','lineHeight'=>1));
        $innercell32=$innerrow3->addCell(4000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8,'lineHeight'=>1));
        $innercell32->addText('Firma: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left','lineHeight'=>1));
        $innercell32->addText('_______________',array('name' => 'Arial', 'size'=>8, 'valign' => 'left','lineHeight'=>1));
        $innercell33=$innerrow3->addCell(3500, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 2,'size' => 8,'lineHeight'=>1));
        $innercell33->addText('Firma: ',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'left','lineHeight'=>1));
        $innercell33->addText('_______________',array('name' => 'Arial', 'size'=>8, 'valign' => 'left','lineHeight'=>1));
        $section->addTextRun(array('spaceAfter' => 2,'size' => 16,'lineHeight'=>1.5,'alignment' => JcTable::END))->addText('REV-001-IT02-CA',array('name' => 'Arial','valign' => 'right'));
        $name='plantilla doble de '.$proceso->solicitante;
        $no='__'.random_int(0,188);
        $file=$name.$no.'.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($file);
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename='.$file );
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Description: File Transfer");
        header("Content-Length: " . filesize($file));
        header('Cache-Control: must-revalidate, post-check=1, pre-check=1');
        header('Expires: 0');
        flush();
        $fp = fopen($file, "r");
        while (!feof($fp)) {
            echo fread($fp, 65536);
            flush();
        }
        fclose($fp);
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save("php://output");
        unlink($file);
    }
}