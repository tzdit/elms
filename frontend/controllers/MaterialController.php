<?php

namespace frontend\controllers;

use yii;
use common\models\Material;
use yii\web\Controller;
use yii\filters\AccessControl;

class MaterialController extends Controller
{
    public function behaviors()
    {
    return [
        'access' => [
            'class' => AccessControl::className(),
            'rules' => [
              
                [
                    'actions' => [
                        'videoplayer',
                    ],
                    'allow' => true,
                    'actions' => ['player'],
                    'roles' => ['@'],
                ],
            ],
        ],
    ];
    }
public function actionPlayer($currentvid,$currenttitle)
{
  $courseCode=yii::$app->session->get('ccode');
  $videoz=Material::find()->where(['material_type'=>'Videos','course_code'=>$courseCode])->orderBy(['material_ID'=>SORT_DESC])->all();
  return $this->render('videomaterialplayer',['videoz'=>$videoz,'currentvid'=>$currentvid,'currentTitle'=>$currenttitle]);




}








}










?>