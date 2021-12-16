<?php
/** @var $model \common\models\Material */

use frontend\models\ClassRoomSecurity;
use \yii\helpers\StringHelper;
use yii\helpers\Url;

?>



    <a href="<?= Url::toRoute(['/videos-and-notes/view_document','material_ID'=> ClassRoomSecurity::encrypt($model->material_ID)]) ?>"  class="document-body">
    <i class="fa fa-file fa-7x document-icon"></i>
      <div class="document  success">
  
        <div class="document-footer ">
          <span class="document-name"> <?php echo $model->fileName ?> </span>  
        
        </div>
      </div>
    </a>


