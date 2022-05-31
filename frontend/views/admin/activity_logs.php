<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
/* @var $this yii\web\View */

$this->title = 'Activity Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">



    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

        <div class="container-fluid">
            <!-- Info boxes -->

                <section class="col-lg-12">
                    <!-- Custom tabs (Charts with tabs)-->
                

                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    'audit_entry_id',
                                    'audit_entry_timestamp',
                                    'audit_entry_model_name',
                                    'audit_entry_operation',
                                    'audit_entry_field_name',
                                    'audit_entry_old_value:ntext',
                                    'audit_entry_new_value:ntext',
                                    'audit_entry_user_id',
                                    'audit_entry_ip',
                                    'audit_entry_affected_record_reference',
                                    'audit_entry_affected_record_reference_type',
                                     ['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]); ?>

                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->

    

    </div>
</div>
