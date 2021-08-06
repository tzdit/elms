<?php
use yii\helpers\Url;
?>
     
            <div class="row" style="height:400px">
              <?php if($currentvid){ ?>
              <div class="col-md-9 col-sm-12 col-xs-12 col-lg-9" style="max-height: 400px;">
                 <div class="thumbnail" height="30%">
                 <video   width="100%" height="400px" style="object-fit:fill"   preload controls autoplay muted>
                 <source src="/storage/temp/<?php echo $currentvid; ?>#t=0.5" type="video/mp4" id="theplayer">
                 </video>
               </div>
              </div>
             <?php }?>
              <div class="col-md-3 col-sm-12 col-xs-12 col-lg-3 clearfix d-flex" style="overflow-y: scroll;">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-lg-12 mb-2" style="height: 150px;">
                  <?php foreach($videoz as $vid){ ?>
            
                    <a href="#"  style="color:#030303; opacity: 0.7; ">
                      <div class="vide-encloseure col-md-12 col-sm-12 col-xs-12">
                         <div class="thumbnail">
                    <video id="/storage/temp/<?php echo $vid->fileName;?>" width="200" height="100%" onclick="getnewvid(this)" preload="metadata">
                    <source src="/storage/temp/<?php echo $vid->fileName; ?>#t=0.5" type="video/mp4">
                    </video>
                    </div>
                    <div class="caption col-md-12 col-sm-12 justify-content-center small align-items-between" style="word-wrap: break-word; width:200px;">
                    <?php echo strtolower($vid->title);?>
                    </div>
                      </div>
                   
                  </a>
                  <?php } ?>
                  </div>
                
                </div>
              </div>
              
              <script>
              $("document").ready(function() {
               //$("#theplayer").parent().prop('muted',true);
                setTimeout(function(){ 
                  $("#theplayer").parent().prop('muted',false);
                   }, 3000);
        

});
      //document.getElementById("theplayer").parentElement.load();
    
        //document.getElementById("theplayer").parentElement.click();
      document.getElementById("theplayer").parentElement.play();

        function getnewvid(z)
        {
          z.parentElement.addEventListener('click', function(event){
          event.preventDefault();
          });
           

            var ul=z.getAttribute('id');

            var player=document.getElementById("theplayer");

            player.setAttribute("src",ul);

            player.parentElement.load();
            player.parentElement.play();
        }
      

      </script>

       
       
