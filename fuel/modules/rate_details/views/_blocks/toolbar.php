<div id="main_top_panel">
<div id="action">
 <div id="actions" class="buttonbar">
  <ul>
   <li class="end">
    <div id="dd_my_accounts" style="border:0px solid #ffffff;">
    <form method="POST">
     <?php 
       echo '<select id="coil"  name="coil" onClick="pullFolders(this.options[selectedIndex].text);" style="min-width:120px;" onchange="this.form.submit();"><br/>';
       foreach($data as $record) {
        if ($_POST['coil'] == $record->vDescription) {
         echo '<option value="'.$record->vDescription.'" selected>'.$record->vDescription."</option>";
         } else {
          echo '<option value="'.$record->vDescription.'">'.$record->vDescription."</option>";
         } 
       }
       echo '</select>';
     ?>
     </form>
    </div>
   </li>
   
     
  </ul>
 </div>
</div>
</div>