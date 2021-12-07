<?php

use common\models\Student;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Forum';

$this->params['courseTitle'] ='MY THREADS';
$this->params['breadcrumbs'] = [
    ['label'=>'class', 'url'=>Url::to(['/student/classwork', 'cid' => $cid])],
    ['label'=>$this->title]
];

?>


<div class="container mt-100">
<!--        --><?php
//
//        echo '<pre>';
//        print_r($topics);
//        echo  '</pre>';
//        //exit();
//
//        ?>

    <a href="<?= Url::toRoute('forum/add-thread') ?>"  class="btn btn-shadow btn-wide btn-primary mb-4"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-plus fa-w-20"></i> </span> New Thread </a>

    <?php if (empty($topic)): ?>
    <div class="d-block flex-wrap justify-content-between">
                <div class="card card1 mb-3">
                    <div class="card-header card-header1 pl-0 pr-0">
                        <div class="row no-gutters w-100 align-items-center">
                            <div class="col ml-3">Topics</div>
                            <div class="col-4 text-muted">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-4">Replies</div>
                                    <div class="col-8"></div>
                                </div>
                            </div>
                        </div>
                    </div>


            <?php foreach ($topics as $column => $topic):?>

                <div class="card-body py-3">
                    <div class="row no-gutters align-items-center">
                        <div class="col"> <a href="javascript:void(0)" class="text-big" data-abc="true"><?= $topic['question_tittle'] ?></a>

                            <?php
                            $name = Student::find()->select('fname,mname, lname')->where('reg_no = :reg_no', [':reg_no' => $topic['username']])->one();
                            ?>

                            <div class="text-muted small mt-1">Started <?php echo Yii::$app->formatter->format($topic['time_add'], 'relativeTime') ?>&nbsp; <a href="javascript:void(0)" class="text-muted font-italic" data-abc="true"><?=  ucwords($name->fname." ".$name->mname."".$name->lname) ?></a></div>
                        </div>
                        <!--                --><?php
                        //                print_r($topic->$key[question_id]);
                        //                die();
                        //
                        //                ?>
                        <div class="d-none d-md-block col-4">
                            <div class="row no-gutters align-items-center">
                                <div class="col-4">12</div>
                                <div class="col-8 align-items-center">
                                    <a href="<?= Url::toRoute(['forum/edit-thread','id' => $topic['question_id'] ]) ?>"><i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i></a>
                                    <a href="#" class="btn-qn-delete" id="btn-qn-delete" forum_qn_id = "<?= $topic['question_id'] ?>"><i class="fa fa-minus-circle fa-lg text-danger" aria-hidden="true"></i></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="m-0">

            <?php endforeach ?>

        </div>
        <nav>
            <ul class="pagination mb-5">
                <li class="page-item disabled"><a class="page-link" href="javascript:void(0)" data-abc="true">«</a></li>
                <li class="page-item active"><a class="page-link" href="javascript:void(0)" data-abc="true">1</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" data-abc="true">2</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" data-abc="true">3</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" data-abc="true">»</a></li>
            </ul>
        </nav>
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