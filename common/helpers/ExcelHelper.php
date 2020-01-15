<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/14/2018
 * Time: 6:05 PM
 */

namespace common\helpers;

class ExcelHelper {

	/**
	 * @param $data
	 */
	public static function export_group_uid( $data ) {

		$file_name        = 'group.xlsx';
		$path             = './excel/' . $file_name;
		$activeSheetIndex = 0;

		$attrBaocaobhxh = [
			'namKtbhxh'            => 'G',
			'soBhxhPhaiNop'        => 'M',
			'soBhxhDaNop'          => 'N',
			'soKpcdPhaiNop'        => 'P',
			'soKpcdDaNop'          => 'Q',
			'laoDongTrichBhxh'     => 'I',
			'laoDongChuaTrichBhxh' => 'J',
			'laoDongTrichKpcd'     => 'K',
			'laoDongChuaTrichKpcd' => 'L',
			'ghiChu'               => 'U',
		];

		$attrNguoiNt = [
			'maSoThue'            => 'C',
			'tenNguoiNop'         => 'B',
			'diaChi'              => 'D',
			'tenNganhNgheKdChinh' => 'F'
		];

		$attrCheckX = [
			'J' => 'S',
			'L' => 'T',
			'O' => 'V',
			'R' => 'W',
		];

		$startDataRow  = 11;
		$count         = 0;
		$countNguoint  = 1;
		$inputFileType = 'Xlsx';

		/** Load $inputFileName to a PHPExcel Object  **/
		$objReader   = IOFactory::createReader( $inputFileType );
		$objPHPExcel = $objReader->load( $inputFileName );
		$objPHPExcel->setActiveSheetIndex( $activeSheetIndex );
		$setCellValues = $objPHPExcel->getActiveSheet();

		$date = new \DateTime( $end );
		$objPHPExcel->getActiveSheet()->setTitle( "Tháng " . (int) $date->format( 'm' ) . '-' . $date->format( 'Y' ) );

		$sheet = [];

		$dataNew = ExportExcelHelper::createData( 'A', 'AA' );

		$configStyle = [];

		foreach ( $dataProvider as $key => $value ) {
			$data      = $dataNew;
			$data['A'] = $countNguoint;

			$data['Y'] = $value['truongDoan'];

			foreach ( $attrNguoiNt as $colNum => $colText ) {
				$data[ $colText ] = $value['mst0'][ $colNum ];
			}

			$data['Z']  = $value['soQdxl']['soQdXuLy'];
			$data['AA'] = DateTimeHelpers::convertDate( $value['soQdxl']['ngayQdXuLy'] );

			foreach ( $attrCheckX as $colNum => $colText ) {
				switch ( $colText ) {
					case 'V':
					case 'W':
						$data[ $colText ] = "=IF((SUM(" . 'O' . ( $startDataRow + $count + 1 ) . ':' . 'O' . ( $startDataRow + $count + count( $value['baocaobaohiemxahoitheonams'] ) ) . ")+SUM(" . 'R' . ( $startDataRow + $count + 1 ) . ':' . 'R' . ( $startDataRow + $count + count( $value['baocaobaohiemxahoitheonams'] ) ) . "))>0,\"X\",\"\"" . ")";
						break;
					default:
						$data[ $colText ] = "=IF((SUM(" . $colNum . ( $startDataRow + $count + 1 ) . ':' . $colNum . ( $startDataRow + $count + count( $value['baocaobaohiemxahoitheonams'] ) ) . "))>0,\"X\",\"\"" . ")";
						break;
				}

			}

			$baocaobaohiemxahoi = Baocaobaohiemxahoi::find()->where( [
				'and',
				[ '=', 'mst', $value['mst'] ],
				[ '=', 'soQdxlId', $value['soQdxlId'] ]
			] )->one();
			$data['E']          = $baocaobaohiemxahoi['phongChiCucThue'];
			$data['U']          = $baocaobaohiemxahoi['ghiChu'];
			$data['X']          = $baocaobaohiemxahoi['soDvThanhTraKiemTraHoanThanh'];

			$configStyle[] = $startDataRow + $count;
			$sheet[]       = $data;
			$count ++;

			$countYear = count( $value['baocaobaohiemxahoitheonams'] );
			if ( $value['baocaobaohiemxahoitheonams'][0] ) {
				$data = $dataNew;
				foreach ( $attrBaocaobhxh as $colNum => $colText ) {
					$data[ $colText ] = $value['baocaobaohiemxahoitheonams'][0][ $colNum ];
				}
				$data['H'] = "=(" . 'I' . ( $startDataRow + $count ) . " + " . 'J' . ( $startDataRow + $count ) . ")";
				$data['O'] = "=(" . 'M' . ( $startDataRow + $count ) . " - " . 'N' . ( $startDataRow + $count ) . ")";
				$data['R'] = "=(" . 'P' . ( $startDataRow + $count ) . " - " . 'Q' . ( $startDataRow + $count ) . ")";
				$count ++;
				$sheet[] = $data;
			}
			for ( $i = 1; $i < $countYear; $i ++ ) {
				$data = $dataNew;
				foreach ( $attrBaocaobhxh as $colNum => $colText ) {
					$data[ $colText ] = $value['baocaobaohiemxahoitheonams'][ $i ][ $colNum ];
				}
				$data['H'] = "=(" . 'I' . ( $startDataRow + $count ) . " + " . 'J' . ( $startDataRow + $count ) . ")";
				$data['O'] = "=(" . 'O' . ( $startDataRow + $count - 1 ) . "+" . 'M' . ( $startDataRow + $count ) . " - " . 'N' . ( $startDataRow + $count ) . ")";
				$data['R'] = "=(" . 'P' . ( $startDataRow + $count ) . " - " . 'Q' . ( $startDataRow + $count ) . ")";
				$count ++;
				$sheet[] = $data;
			}
			$countNguoint ++;
		}

		if ( count( $sheet ) > 1 ) {
			$setCellValues->insertNewRowBefore( $startDataRow + 1, count( $sheet ) - 1 );
		}

		$setCellValues->fromArray( $sheet, null, 'A' . $startDataRow );
		$setCellValues->getStyle( 'M' . ( $startDataRow - 1 ) . ':R' . ( $startDataRow + count( $sheet ) - 1 ) )->getNumberFormat()->setFormatCode( '#,#' );

		foreach ( $configStyle as $key => $value ) {
			$setCellValues->getRowDimension( $value )->setRowHeight( - 1 );
		}

		$newFile   = './result/' . time() . $fileName;
		$objWriter = IOFactory::createWriter( $objPHPExcel, $inputFileType );
		$objWriter->save( $newFile );
		ExportExcelHelper::download( $newFile );
	}
}