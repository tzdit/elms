<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;

/*
A class to manage files database such as config files

written by khalid hassan, thewinner016@gmail.com, +255755189736

25/12/2021, christmas work OMG!!
*/

class ClassroomMiniDbManager extends Model
{
  private $minidatabase='@runtime/minidatabase';
  private $dirMode = 0775;
  private $fileMode=""; 

  private function database_setup()
  {
    
  }
  public function create($filename)
  {

  }
}
