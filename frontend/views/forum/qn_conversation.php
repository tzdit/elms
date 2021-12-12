<?php

use common\models\ForumAnswer;
use common\models\ForumComment;
use common\models\Student;
use common\models\ForumQnTag;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\file\FileInput;


/* @var $this yii\web\View */

$this->title = 'Question';

$this->params['courseTitle'] ='QUESTION';
$this->params['breadcrumbs'] = [
    ['label'=>'Forum', 'url'=>Url::to(Yii::$app->request->referrer)],
    ['label'=>$this->title]
];

?>


<div class="container mt-100">
<!--        --><?php
//
//        echo '<pre>';
//        print_r($question);
//        echo  '</pre>';
//        //exit();
//
//        ?>

    <a href="<?= Url::toRoute('forum/add-thread') ?>"  class="btn btn-shadow btn-wide bg-gradient-dark mb-4"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-plus fa-w-20"></i> </span> New Thread </a>
    <a href="<?= Url::toRoute(['forum/my-thread', 'cid' => $cid]) ?>"  class="btn btn-shadow btn-wide btn-primary mb-4"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-server" aria-hidden="true"></i></span> My Threads </a>

        <div class="d-block flex-wrap justify-content-between">



            <div class="card card1 border-bottom-0">

                <div class="card-header bg-gradient-dark">
                    <div>
                        <h6 class="text-muted">Asked <?php echo Yii::$app->formatter->format($question['time_add'], 'relativeTime') ?></h6>
                    </div>
                    <p class="text-white">
                        <?= $question['question_tittle'] ?>
                    </p>

                    <?php  $tags = ForumQnTag::find()->select('course.course_name')->join('INNER JOIN','course','forum_qn_tag.course_code = course.course_code')->where('forum_qn_tag.question_id = :question_id', [':question_id' => $question['question_id']])->asArray()->all() ?>

                    <h4>Tags</h4>
                    <ul class="pl-0" style="list-style: none;">
                        <?php foreach ($tags as $tag): ?>
                            <li class="shadow-lg  bg-blue p-1" style="display: inline"><?= $tag['course_name'] ?></li>
                        <?php endforeach; ?>
                    </ul>

                </div>
                <div class="card-header border-0">
                    <h4><i class="fa fa-star icon-color-count" aria-hidden="true"></i> Question</h4>
                    <?php
                    $reply_count = ForumAnswer::find()->where('question_id = :question_id ',[':question_id' => $question['question_id']])->count();
                    ?>
                    <h6 class="text-muted card-text qn-replay"><i class="fa fa-reply float-left mr-1 icon-color-count" aria-hidden="true"></i> <?= $reply_count ?> Reply</h6>
                </div>
                <div class="card-body shadow-sm">
                    <p class="p-3">
                        <?= $question['question_desc'] ?>
                    </p>
                    <div class="row">
                        <div class="col-sm-5">
                           <?php if (!empty($question['fileName'])): ?>
                                <img src="<?= Yii::getAlias('@web/img/').$question['fileName']  ?>" class="img-thumbnail" height="400" width="500">
                            <?php else: ?>
                                <?php echo "" ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-7">
                            <?php if (!empty($question['code'])): ?>
                                <pre class="p-2"><code><?= Html::encode($question['code']) ?></code></pre>
                            <?php else: ?>
                                <?php echo "" ?>
                            <?php endif; ?>
                           </div>
                    </div>
                </div>

                <div class="card-header mt-5 border-0 bg-gradient-dark">
                    <h4> <i class="fa fa-reply float-left mr-1" aria-hidden="true"></i> Replies</h4>
                </div>
<!--                --><?php
//
//                echo '<pre>';
//                print_r($answers);
//                echo  '</pre>';
//                //exit();
//
//                ?>

                 <?php foreach ($answers as $answer): ?>

                     <div class="card-body my-4 ml-xl-5">

                         <?php
                         $answer_name = Student::find()->select('fname,mname, lname')->where('userID = :userID', [':userID' => $answer['user_id']])->one();
                         if (empty($answer_name)){
                             $inst_answer_name = Instructor::find()->select('full_name')->where('userID = :userID', [':userID' => $answer['user_id']])->one();
                         }

                         ?>
                         <p class="mx-3">
                             <i class="fa fa-reply float-left mr-1 icon-color-count" aria-hidden="true"></i>
                             <?= $answer['answer_content'] ?>
                         <div class="row">
                             <div class="col-sm-5">
                                 <?php if (!empty($answer['fileName'])): ?>
                                    <img src="<?= Yii::getAlias('@web/img/').$answer['fileName']  ?>" class="img-thumbnail" height="400" width="500">
                                 <?php else: ?>
                                    <?php echo "" ?>
                                 <?php endif; ?>
                             </div>
                             <div class="col-sm-7">
                                 <?php if (!empty($answer['code'])): ?>
                                     <pre class="p-2"><code><?= Html::encode($answer['code']) ?></code></pre>
                                 <?php else: ?>
                                     <?php echo "" ?>
                                 <?php endif; ?>

                             </div>
                         </div>
                             <span class="float-right font-italic m-4"><i class="fa fa-user icon-color-count" aria-hidden="true"></i> <?php
                                 if (!empty($answer_name)){
                                     echo ucwords($answer_name->fname." ".$answer_name->lname);
                                 }
                                 else{
                                     echo  ucwords($inst_answer_name->full_name);
                                 }
                                 ?>
                                 </span>
                         </p>

                         <div class="card-footer border-0 mt-5">
                             <?php
                             $comments = ForumComment::find()->where('forum_comment.answer_id = :answer_id ',[':answer_id' => $answer['answer_id']])->orderBy(['forum_comment.time_added' => SORT_DESC])->asArray()->all();
                             $comment_count = ForumComment::find()->where('forum_comment.answer_id = :answer_id ',[':answer_id' => $answer['answer_id']])->count();
                             ?>
                             <h6 class="text-muted card-text qn-replay"><i class="fa fa-comment ml-n2 mr-1 icon-color-count" ></i><?= $comment_count ?> Comment</h6>

                             <?php $form = ActiveForm::begin([
                                 'options'=>['enctype'=>'multipart/form-data']]); ?>
                             <div class="form-group row">
                                 <?= $form->field($model1, 'comment_content')->textInput([ 'placeholder' => 'Add comment', 'class' => 'col-sm-11', 'size' => 100])->label(false) ?>
                                 <?= $form->field($model1, 'answer_id')->hiddenInput(['value' => $answer['answer_id']])->label(false) ?>
                                 <?= Html::submitButton('Post', ['class' => 'btn  col-sm-1 p-0', 'id' => 'comment-btn']) ?>
                             </div>
                             <?php ActiveForm::end(); ?>

                         <div class="card-footer border-0 p-0">
                             <?php foreach ($comments as $comment): ?>
                             <?php
                                 $comment_name = Student::find()->select('student.fname, student.lname')->join('INNER JOIN', 'user', 'student.userID = user.id')->where('user.id = :id', [':id' => $comment['user_id']])->one();

                                 if (empty($comment_name)){
                                     $inst_comment_name = Instructor::find()->select('full_name')->where('userID = :userID', [':userID' => $comment['user_id']])->one();
                                 }


                                 ?>
                                 <hr class="m-0">
                                <div class="row">
                                    <li class="ml-xl-5 p-1 col-md-9" style="display: inline-block"><i class="fa fa-comment ml-n2 mr-1 icon-color" ></i><?= $comment['comment_content'] ?> <span class="float-right font-italic"><i class="fa fa-user icon-color-count" aria-hidden="true"></i> <?php

                                            if (!empty($comment_name)){
                                                echo ucwords($comment_name->fname." ".$comment_name->lname);
                                            }
                                            else{
                                                echo  ucwords($inst_comment_name->full_name);
                                            }
                                            ?>
                                        </span></li>
                                </div>
                                 <hr class="m-0">
                             <?php endforeach; ?>
                         </div>
                         </div>
                     </div>

                <?php endforeach; ?>


                <div class="card-footer">
                    <div class="card-header mt-5 border-0 bg-gradient-dark">
                        <h4> <i class="fa fa-reply float-left mr-1" aria-hidden="true"></i> Add answer to reply</h4>
                    </div>
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'answer_content')->textarea(['class'=>'form-control form-control-sm', 'rows' => 10, 'maxlength' => 1000, 'row' => 50, 'placeholder' => 'Write your answer here with in short words' ])->label('Answer') ?>
                    <?= $form->field($model, 'code')->textarea(['class'=>'form-control form-control-sm', 'rows' => 7, 'maxlength' => 1000, 'row' => 15, 'placeholder' => 'write your code snippets for clarification if you have any', 'style'=>'width:70%' ])->label('Code  Snippets') ?>
                    <div class="row">
                        <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'],
                            'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => false,],
                        ])->label('Choose to select image if you have any for support your answer');   ?>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Submit your answer', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>

            </div>

        </div>

</div>