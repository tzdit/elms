<?php

use common\models\Instructor;

/** @var $model \common\models\Materials */
?>
<div>

    <p class="text-muted m-0 p-0">
        <?php 
        $instractorName = Instructor::findOne($model->instructorID);
        echo $instractorName->full_name;
        ?>
        
      </p>

</div>
