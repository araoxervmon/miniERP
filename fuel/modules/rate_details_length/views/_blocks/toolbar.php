<div id="action">
 <div id="actions" class="erpbuttonbar">
  <ul>
   <li class="end">

    <div id="dd_my_accounts" style="border:0px solid #ffffff;">
      <select id="coil"  name="coil"  style="min-width:120px;">
	   <?php 
	     echo '<option value="'.Select.'">'.Select."</option>";
         foreach($data as $record) {
          echo '<option value="'.$record->vDescription.'">'.$record->vDescription."</option>";
         } 
     ?>
     </select>
    </div>
   </li> 
  </ul>
 </div>
</div>