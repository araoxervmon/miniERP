<?php if ($change_pwd){ ?>
<div class="jqmWindow jqmWindowShow warning" id="change_pwd_notification">
	<p><?=lang('warn_change_default_pwd', $this->config->item('default_pwd', 'fuel'))?></p>

	<div class="buttonbar" id="yes_no_modal" style="width: 400px;">
		<ul>
			<li class="end"><a href="#" class="ico ico_no jqmClose" id="change_pwd_cancel"><?=lang('dashboard_change_pwd_later')?></a></li>
			<li class="end"><a href="<?=fuel_url('my_profile/edit/')?>" class="ico ico_yes" id="change_pwd_go"><?=lang('dashboard_change_pwd')?></a></li>
		</ul>
	</div>
	<div class="clear"></div>
</div>
<?php } ?>

<div id="main_top_panel">
	<h2 class="ico ico_tools_dashboard"><?=lang('section_dashboard')?></h2>
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  $(document).ready(function() {
      	  $("#jDashTop").jDashboard({ columns: 2 });
      	  $("#jDash").jDashboard({ columns: 2 });
      });
</script>
<div align="center">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td rowspan="2">&nbsp;</td>
<td align="center">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td width="15px">&nbsp;</td>
<td align="left" id="action-newsannouncement" style="width:901px !important;">
	<div style="width:40px; float:left">
		&nbsp;
	</div>
	<div style="width:170px; float:left">
		<a class="ico ico_inward_entry" href="<?=fuel_url('inward')?>">
			<strong>Inward Entry</strong>
		</a>
	</div>
	<div style="width:160px; float:left">
		<a class="ico ico_partyname_details" href="<?=fuel_url('partyname_details/create')?>">
			<strong>Create Partydetails</strong>
		</a>
	</div>
	<div style="width:160px; float:left">
		<a class="ico ico_material_description" href="<?=fuel_url('material_description/create')?>">
			<strong>Material Description</strong>
		</a>
	</div>
	<div style="width:180px; float:left">
		<a class="ico ico_inventory_adjustments" href="<?=fuel_url('tax_details')?>">
			<strong>Tax Details</strong>
		</a>
	</div>
	<div style="width:140px; float:left">
		<a class="ico ico_users" href="<?=fuel_url('users/create')?>">
			<strong>Create User</strong>
		</a>
	</div>
</td>
<td width="15px">&nbsp;</td>
</tr>
</table>
</td>

<td rowspan="2">&nbsp;</td>
</tr>
<tr>
<td width="910px" align="center">
<div id="jDashTop">
	<div class="jdash-item">
		<h1 class="jdash-head">Recent Inward Entry</h1>
		<div class="jdash-body">
			<div>
			<table id="data_table" class="data" cellspacing="0" cellpadding="0">
			<thead>
			<tr>
				<th>Coilnumber</th>
				<th>InvoiceNo</th>
				<th>Invoice Date</th>
				<th>Status</th>
			</tr>
			</thead>
			<tbody>
			<?php if(!empty($recentinward)){ ?>
			<?php foreach($recentinward as $rinwardt){ ?>
			<tr>
				<td><?php echo $rinwardt->vIRnumber; ?></td>
				<td><?php echo $rinwardt->vInvoiceNo; ?></td>
				<td><?php echo $rinwardt->dInvoiceDate; ?></td>
				<td><?php echo $rinwardt->vStatus; ?></td>
			</tr>
			<?php } ?>
			<? }else { ?>
			<tr>
				<td colspan="4">
					<b>No Record Present!</b>					
					<div>
						<a class="ico ico_inward" href="<?=fuel_url('fuel/inward_entry')?>">Click here to Check Inward Registry.</a>
					</div>
				</td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
			</div>
		</div>
	</div>
	
	<div class="jdash-item">
		<h1 class="jdash-head">Recent Workin Progress</h1>
		<div class="jdash-body">
			<div>
			<table id="data_table" class="data" cellspacing="0" cellpadding="0">
			<thead>
			<tr>
				<th>Coilnumber</th>
				<th>Partyname</th>
				<th>SlittingDate</th>
				<th>CuttingDate</th>
				<th>RecoilingDate</th>
			</tr>
			</thead>
			<tbody>
			<?php if(!empty($recentwip)){ ?>
			<?php foreach($recentwip as $rwip){ ?>
			<tr>
				<td><?php echo $rwip->coilnumber; ?></td>
				<td><?php echo $rwip->partyname; ?></td>
				<td><?php echo $rwip->cuttingdate; ?></td>
				<td><?php echo $rwip->recoilingdate; ?></td>
				<td><?php echo $rwip->slittingdate; ?></td>
			</tr>
			<?php } ?>
			<? }else { ?>
			<tr>
				<td colspan="4">
					<b>No Record Present!</b>					
					<div>
						<a class="ico ico_workin_progress" href="<?=fuel_url('workin_progress')?>">Click here to check workin progress.</a>
					</div>
				</td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
			</div>
		</div>
	</div>
	
<!--	<div class="jdash-item">
		<h1 class="jdash-head">Recent Reports</h1>
		<div class="jdash-body">
			<div>
			<table id="data_table" class="data" cellspacing="0" cellpadding="0">
			<thead>
			<tr>
				<th>SKU</th>
				<th>Name</th>
				<th>Quantity</th>
				<th>Price (&#8377;)</th>
			</tr>
			</thead>
			<tbody>
			<?php/* if(!empty($recentinv)){ ?>
			<?php foreach($recentinv as $rinv){ ?>
			<tr>
				<td><?php echo $rinv->item_sku; ?></td>
				<td><?php echo $rinv->item_name; ?></td>
				<td><?php echo $rinv->quantity_on_hand; ?></td>
				<td><?php echo $rinv->item_cost; ?></td>
			</tr>
			<?php } ?>
			<? }else { ?>
			<tr>
				<td colspan="4">
					<b>No Record Present!</b>					
					<div>
						<a class="ico ico_inventory_lists" href="<?=fuel_url('reports')?>">Click here to check reports.</a>
					</div>
				</td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
			</div>
		</div>
	</div>
	
	<div class="jdash-item">
		<h1 class="jdash-head">Recent Billing</h1>
		<div class="jdash-body">
			<div>
			<table id="data_table" class="data" cellspacing="0" cellpadding="0">
			<thead>
			<tr>
				<th>Bill Id</th>
				<th>Customer</th>
				<th>Total Items</th>
				<th>City</th>
				<th>Amounts (&#8377;)</th>
			</tr>
			</thead>
			<tbody>
			<?php if(!empty($recentbill)){ ?>
			<?php foreach($recentbill as $rbill){ ?>
			<tr>
				<td><?php echo 'bill_'.$rbill->id; ?></td>
				<td><?php echo $rbill->main_name; ?></td>
				<td><?php echo $rbill->item_count; ?></td>
				<td><?php echo $rbill->main_city; ?></td>
				<td><?php echo $rbill->total_amount; ?></td>
			</tr>
			<?php } ?>
			<? }else { ?>
			<tr>
				<td colspan="4">
					<b>No Record Present!</b>					
					<div>
						<a class="ico ico_inventory_billing" href="<?=fuel_url('inventory_billing')?>">Click here to create new inventory billing.</a>
					</div>
				</td>
			</tr>
			<?php } */?>
			</tbody>
			</table>
			</div>
		</div>
	</div>	-->				
</div>

</td>
</tr>
</table>
</div>
