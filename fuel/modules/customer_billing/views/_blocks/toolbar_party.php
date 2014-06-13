<div id="action">
 <div id="actions" class="erpbuttonbar">
  <ul>
   <li class="end">
    <div id="dd_my_accounts" style="border:0px solid #ffffff;">
		<select id="party_individualaccount_name"  name="party_individualaccount_name" style="min-width:200px;" >
			<?php
				echo '<option value="'.Select.'">'.Select."</option>";
				echo '<option value="'.$chkuser[0]->nPartyName.'">'.$chkuser[0]->nPartyName."</option>";
			?>
		</select>
    </div>
   </li>  
  </ul>
 </div>
</div>
<div id="msgtext"></div>