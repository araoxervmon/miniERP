
<script language="javascript" type="text/javascript">
  $(window).load(function() {
	$("tr#childlist").hide();
	var lfScrollbar = $('#contentsfolder');	 
	fleXenv.updateScrollBars(lfScrollbar); 
  });
  
</script>

<div class="tab-boxpr"> 
	<div style="width:640px;">
    <a href="javascript:;"><div class="tabLinkpr activeLinkpr" id="contpr-1" style="float:left;"><h1>Workinprogress</h1></div></a> 
    </div>
</div>

<!-- MAIN Workinprogress @START -->
<div id="main_content" style="overflow:hidden;">  
<div>
<div class="tabcontentpr" id="contpr-1-1" >
<div id="party_list" style="width:100%; height:500px; overflow-x:hidden; overflow-y:auto;">
 
<script src="<?=$this->asset->js_path('jquery.tablesorter.pager', 'workin_progress')?>"></script>
<script src="<?=$this->asset->js_path('jquery.tablesorter', 'workin_progress')?>	"></script>
<script src="<?=$this->asset->js_path('jquery.tablesorter.widgets', 'workin_progress')?>	"></script>
  <div>
<div> 
<table id="myTable" class="tablesorter tablesorter-blue"  >
  <thead>
    <tr>
      <th>Coilnumber</th>
      <th>Received Date</th>
      <th>Size Given Date</th>
      <th>Partyname</th>
	 <th>Material Description</th>
      <th>Thickness</th>
      <th>Width</th>
	  <th>Weight</th>
      <th>Process</th>
	   <th>Action</th>
    </tr>
  </thead>
  <tbody>

    <?php for($i=0; $i<count($workinprogress_lists); $i++) { ?>
		
    <tr class="even">
     <td><?php echo $workinprogress_lists[$i]->coilnumber?></td>
	  <td><?php echo $workinprogress_lists[$i]->receiveddate?></td>
	   <td><?php echo $workinprogress_lists[$i]->sizegivendate?></td>
	   <td><?php echo $workinprogress_lists[$i]->partyname?></td>
	        <td><?php echo $workinprogress_lists[$i]->materialdescription?></td>
	  <td><?php echo $workinprogress_lists[$i]->thickness?></td>
	   <td><?php echo $workinprogress_lists[$i]->width?></td>
	        <td><?php echo $workinprogress_lists[$i]->weight?></td>
	  <td><?php echo $workinprogress_lists[$i]->process?></td>  
	  <td><?php	 echo $al = '<a title="Cutting Instruction" href="' .$workinprogress_lists[$i]->al .'"><span class="badge badge-success" style="color: #FFFFFF;">Cutting</span></a>';
			 echo $fi = '<a  title="Finish Task" href="' .$workinprogress_lists[$i]->fi .'"><span class="badge badge-info" style="color: #FFFFFF;">Finish</span></a>';
			 echo $bl = '<a title="Billing Instruction" href="' .$workinprogress_lists[$i]->bl .'"><span class="badge badge-important" style="color: #FFFFFF;">Billing</span></a>'; 
			 echo $cs = '<a title="Print" href="' .$workinprogress_lists[$i]->cs .'"  target="_blank"><span class="badge" style="color: #FFFFFF;">Cutting Slip</span></a>'; 
			 	  
			 ?> </td>
	   </tr>
	     <tr class="even"></tr>
	<?php } ?>	
  </tbody>
</table>
</div>
</div>
</div>
   

</div>

</div>
</div>
<input id= "txtcoilids" type="hidden" hidden/> 
<div align="right">
<label>Total Weight: in (Kgs)</label>
<input id="txtboxweight" type="text" value="<?php echo $tweight; ?>" DISABLED/> &nbsp; &nbsp; &nbsp;
</div>

<input id="coilid" type="hidden" value="" name="coilid">
<input id="partyid" type="hidden" value="" name="partyid">



  <script type="text/javascript">
  $(function(){
  $("#myTable").tablesorter();
});

</script>  
  <script type="text/javascript">
function finishtask(id)
{
	var coilnumber = $('#vnum'+id).val();
	var partyname = $('#pname'+id).val();
	document.getElementById('coilid').value = coilnumber;
	document.getElementById('partyid').value = partyname;
}

function cuttinginstruction(id)
{
	var coilnumber = $('#vno'+id).val();
	document.getElementById('partnamecheck').value = coilnumber;
}
</script>  