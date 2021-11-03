<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
$this->params['courseTitle'] =$cid;
$this->title = 'Groups';
$this->params['breadcrumbs'] = [
    ['label'=>$this->title]
];

?>

<?php
//echo '<pre>';
//                                             var_dump($studentGroupsList);
//                                         echo '</pre>';
//                                         exit;
?>
<div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

        <div class="container-fluid">

            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12">
                    <div class="card-body" >
                          <div class="row container-fluid">
                              <?php foreach($studentGroupsList as $groupList) : ?>
                              <?php foreach($groupList->studentGroups as $groupAssLoop) : ?>
                            <div class="col-sm-3 col-12 ">

                                <a href="<?=Url::to(['student/group-assignment/', 'cid'=>$cid, 'generationType' => $groupList->generation_type, 'groupID' => $groupList->groupID])  ?>" class="card px-4 py-2 row result-card mx-1 my-2 ">
                                    <h6>
                                        <i class="fa fa-users"></i>
                                       <?php
                                       echo $groupList->groupName;
                                       ?>
                                    </h6>
                                </a>

                            </div>
                                  <?php endforeach ?>
                              <?php endforeach ?>



                        </div>

                    </div>
                </section>
            </div>
        </div><!--/. container-fluid -->
    </div>
</div>
