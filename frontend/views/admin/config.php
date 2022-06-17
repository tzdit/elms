<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->params['courseTitle']='<i class="fa fa-cogs"></i> Configurations';
$this->title = 'Configurations';
$this->params['breadcrumbs'] = [
    ['label'=>$this->title]
];
?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
          
            <form class="form-group" action="<?=Url::to('/admin/validate-receipt')?>" method="post" accept-charset="utf-8">
              <textarea rows=12 class="form-control text-lg" name="content" style="background:none" placeholder="Configurations" required></textarea>
              <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
              <button type="submit" class="btn btn-lg btn-default float-right mt-2"><i class="fa fa-save"></i> Save Changes</button>
            </form>
            
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
         
     

    </div>
</div>
<?php 
$script = <<<JS
$(document).ready(function(){


  
});
JS;
$this->registerJs($script);
?>
