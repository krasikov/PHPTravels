<div class="col-md-6">
   <div class="form-group">
      <dl class="calendar-legend">
         <dt class="calendar-key"><span class="calendar-key-box today"></span></dt>
         <dd class="calendar-label"><?php echo trans('0365');?></dd>
         <dt class="calendar-key"><span class="calendar-key-box available-key"></span></dt>
         <dd class="calendar-label"><?php echo trans('0252');?></dd>
         <dt class="calendar-key"><span class="calendar-key-box availability-key blocked-key"></span></dt>
         <dd class="calendar-label"><?php echo trans('0152');?></dd>
      </dl>
   </div>
</div>
<div class="clearfix"></div>
<hr>
<?php
   $month = $initialmonth;
   $finalmonth = $initialmonth + 6;
   for($i=$initialmonth;$i<$finalmonth;$i++){

   echo $calendar->frontgenerate($year,$month,$roomid);
   $month++;
     if($month > 12){
         $year += 1;
         $month = 1;
     }
   }

   ?>