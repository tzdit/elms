<?php
/**
 *Describe
 * @author zcy
 * @date 2019/8/16
 */

namespace app\controllers;

use app\models\uploadForm;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class UploadController extends Controller
{
  /**
   *Import
   * @author zcy
   * @date 2019/8/16
   */
  public function actionImport()
  {
    $model = new uploadForm();

    if (Yii::$app->request->isPost) {
      $model->file = UploadedFile::getInstance($model,'file');
//      if ($model->upload()) {
//        print <<<EOT
//< script > alert ('upload succeeded ') < / script >
//EOT;
//      } else {
//        print <<<EOT
//< script > alert ('upload failed ') < / script >
//EOT;
//      }
      if (!$model->upload()) {
        print <<<EOT
 < script > alert ('upload failed ') < / script >
EOT;
      }
    }

    $ok = 0;
    if ($model->load(Yii::$app->request->post())) {
      $file = UploadedFile::getInstance($model,'file');

      if ($file) {
        $filename = 'upload/Files/' . $file->name;
        $file->saveAs($filename);

        if (in_array($file->extension,array('xls','xlsx'))) {
          $fileType = \PHPExcel_Iofactory:: identify ($filename); // the file name automatically determines the type
          $excelReader = \PHPExcel_IOFactory::createReader($fileType);

          $phpexcel = $ExcelReader -> Load ($filename) -> getsheet (0); // load the file and get the first sheet
          $total_Line = $phpexcel -> gethighestrow(); // total number of rows
          $total_Column = $phpexcel -> gethighestcolumn(); // total number of columns

          if (1 < $total_line) {
            for ($row = 2;$row <= $total_line;$row++) {
              $data = [];
              for ($column = 'A';$column <= $total_column;$column++) {
                $data[] = trim($phpexcel->getCell($column.$row));
              }

              $info = Yii::$app->db->createCommand()
->insert('{{%shop_info}}',['shop_name' => $data[0],'shop_type' => $data[1]])
->execute();

              if ($info) {
                $ok = 1;
              }
            }
          }

          if ($ok == 1) {
            echo "< script > alert ('import succeeded '); window.history.back ();</script>";
          } else {
            echo "< script > alert ('operation failed '); window.history.back ();</script>";
          }
        }
      }
    } else {
      return $this->render('import',['model' => $model]);
    }
  }
}