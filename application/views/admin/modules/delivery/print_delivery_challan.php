<body onLoad="myFunction()">
	<div style='width:100%; margin-bottom:25px;' align="right">
		<label style="font-weight: bold; font-size: 15px;">Delivery Challan</label>
	</div>
	<div style='width:50%;' align='left'>
		<img src="<?php echo base_url(); ?>assets\img\catering_log.png" alt="AdminLTELogo" height="80" width="140">
	</div>

	<table style="margin-top:20px; border-collapse:collapse;">
		<tr>
			<td width='50%' align='left'>
				<label><b>Invoice Number : </b><?php echo $get_challan->invoice_number; ?></label>
			</td>
			<td width='50%' align='center'>
				<label><b>Driver Name : </b><?php echo $get_challan->driver_name; ?></label>
			</td>
		</tr>
	</table>
	
	<table style="margin-top:20px; border-collapse:collapse;">
		<tr>
		<td width='50%' align='center'>
				<label><b>Driver Number : </b><?php echo $get_challan->driver_phone; ?></label>
			</td>
			<td width='50%' align='right'>
				<label><b>Vehicle Number : </b><?php echo $get_challan->vehicle_number; ?></label>
			</td>
		</tr>
	</table>

	</br>
	</tr>
	
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
		}

		table {
			width: 100%;
			/* border-collapse: collapse; */
		}

		table th {
			padding: 13px;
		}

		.tables table th,
		table td {
			border: 1px solid #ccc;
			padding: 15px;
			text-align: left;
		}
	</style>


	<br>
	<table class="tables" width='100%' style="border-collapse: collapse;">
		<thead style='background-color:#09558F; color:white;align:left;text-align: -webkit-left;'>
			<tr class="bb">
				<th>S.No</th>
				<th>Vessels Name</th>
				<th>Quantity</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sno = 1;
			foreach ($get_challan_records as $tmp) {
			?>
				<tr class="bb">
					<td><?php echo $sno++; ?></td>
					<td><?php echo $tmp->vessels_name; ?></td>
					<td><?php echo $tmp->quantity; ?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
		
		<tfoot>
		</tfoot>
	</table>
	</br>

	<br>
	<div>
		<div align="right">
			<b> Thank You & Regards </b>
			</br>
			     தேவ் கேட்டரிங் சர்வீஸ்
		</div>
	</div>
</body>
<script>
	function myFunction() {
		window.print();
	}
</script>