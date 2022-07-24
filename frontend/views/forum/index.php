<?php

use common\models\ForumAnswer;
use common\models\Instructor;
use common\models\Student;
use frontend\models\ClassRoomSecurity;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Forum';

$this->params['courseTitle'] ='<i class="fa fa-comments"></i> Forum';
$this->params['breadcrumbs'] = [
    ['label'=>$cid.' dashboard', 'url'=>Url::to(['/student/classwork', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
    ['label'=>$this->title]
];

?>


<div class="container mt-100">
<!--    --><?php
//
//    echo '<pre>';
//    print_r($topics);
//    echo  '</pre>';
//    //exit();
//
//    ?>

    <a href="<?= Url::toRoute('forum/add-thread') ?>"  class="btn btn-shadow btn-wide bg-gradient-dark mb-4"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-plus fa-w-20"></i> </span> New Thread </a>
    <a href="<?= Url::toRoute(['forum/my-thread', 'cid' => ClassRoomSecurity::encrypt($cid)]) ?>"  class="btn btn-shadow btn-wide btn-info mb-4"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-server" aria-hidden="true"></i></span> My Threads </a>

    <?php if (empty($topic)): ?>
    <div class="d-block flex-wrap justify-content-between">

         <div class="card card1 mb-3">
        <div class="card-header card-header1 pl-0 pr-0">
            <div class="row no-gutters w-100 align-items-center">
                <div class="col ml-3">Topics</div>
                <div class="col-4 text-muted">
                    <div class="row no-gutters align-items-center">
                        <div class="col-4">Replies</div>
                        <div class="col-8">Last update</div>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($topics as $column => $topic):?>

            <div class="card-body py-3">
                <div class="row no-gutters align-items-center">
                    <div class="col-8"> <a href="<?= Url::toRoute(["forum/qn-conversation",'cid' => ClassRoomSecurity::encrypt($cid), 'question_id' => ClassRoomSecurity::encrypt($topic['question_id'])]) ?>" class="text-big" data-abc="true"><?= $topic['question_tittle'] ?></a>

                        <?php
                        $name = Student::find()->select('fname,mname, lname')->where('userID = :userID', [':userID' => $topic['user_id']])->one();
                        if (empty($name)){
                            $inst_name = Instructor::find()->select('full_name')->where('userID = :userID', [':userID' => $topic['user_id']])->one();
                        }
                        ?>

                        <div class="text-muted small mt-1">Started <?php echo Yii::$app->formatter->format($topic['time_add'], 'relativeTime') ?>&nbsp; <a href="javascript:void(0)" class="text-muted font-italic" data-abc="true"><?php
                            if (!empty($name)){
                                echo ucwords($name->fname." ".$name->lname);
                            }
                            else{
                               echo  ucwords($inst_name->full_name);
                            }
                            ?>
                            </a>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-4">
                        <div class="row no-gutters align-items-center">
                            <?php
                            $reply_count = ForumAnswer::find()->where('question_id = :question_id ',[':question_id' => $topic['question_id']])->count();
                            $reply_last = ForumAnswer::find()->select('user_id, time_added')->where('question_id = :question_id ',[':question_id' => $topic['question_id']])->orderBy(['time_added' => SORT_DESC ])->asArray()->all();

                            ?>
<!--                            --><?php
//
//                            echo '<pre>';
//                            print_r($reply_last);
//                            echo  '</pre>';
//                            //exit();
//
//                            ?>
                            <div class="col-4"><i class="fa-sm mb-5"> &nbsp;&nbsp;<img src="<?= Yii::getAlias('@web/img/reply.png') ?>" width="30px" height="30px"></i><?= $reply_count ?></div>
                            <div class="media col-8 align-items-center"> <img src="<?= Yii::getAlias('@web/img/user.png') ?>" alt="" class="d-block ui-w-30 rounded-circle" height="40px" width="40px">

                                <div class="media-body flex-truncate ml-2">
                                    <?php foreach ($reply_last as $key => $last):?>
                                        <?php
                                        $reply_name = Student::find()->select('fname,mname, lname')->where('userID = :userID', [':userID' => $last['user_id']])->one();
                                        if (empty($reply_name)){
                                            $reply_inst_name = Instructor::find()->select('full_name')->where('userID = :userID', [':userID' => $last['user_id']])->one();
                                        }
                                        ?>

                                    <div class="line-height-1 text-truncate"><?php echo Yii::$app->formatter->format($last['time_added'], 'relativeTime') ?></div> <a href="javascript:void(0)" class="text-muted small text-truncate" data-abc="true">by <?php
                                            if (!empty($reply_name)){
                                                echo ucwords($reply_name->fname." ".$reply_name->lname);
                                            }
                                            else{
                                                echo  ucwords($reply_inst_name->full_name);
                                            }
                                            ?>
                                        </a>
                                        <?php if ($key == 0){break;}?>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-0">

        <?php endforeach ?>

    </div>
    </div>

    <?php else: ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body cart">
                        <div class="col-sm-12  text-center"> <img src="<?= Yii::getAlias("@web/img/exclamation-mark.png") ?>" width="100" height="100" class="img-fluid mb-4 mr-3">
                            <h3><strong>No any thread found</strong></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>