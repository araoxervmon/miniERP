<div id="action">
 <div id="actions" class="erpbuttonbar">
  <ul>
   <li class="end">
    <div id="dd_my_accounts" style="border:0px solid #ffffff;">
		<select id="party_account_name"  name="party_account_name" style="min-width:200px;" >
			<?php
				echo '<option value="'.Select.'">'.Select."</option>";
				foreach($data as $record) {
                    echo '<option value="'.$record->cust_id.'">'.$record->cust_id."</option>";
				}
			?>
		</select>
    </div>
   </li>  
  </ul>
 </div>
</div>
<div id="msgtext"></div>