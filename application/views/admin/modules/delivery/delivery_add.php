<style>
input{
    margin: 2px;
}
</style>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Add Challan </h5>
              
            </div>
            <div class="card-body">
                <?php if (!empty(validation_errors())): ?>
                    <div class="error">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="flash-message_success">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="flash-message_error">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
  
               <form autocomplete="OFF" id="DataForm">
			      <input type="hidden" id="challan_id" name="challan_id">
					<div class="form-group">
									<div class="row">
										<div class="form-group col-md-4">
                                            <span>Challan Number</span>
                                               <input type="text" style='text-align: right;' readonly value='<?php echo $challanno;?>' required="required" class="form-control form-control-sm">
                                        </div>
										
										<div class="form-group col-md-4">
                                            <span>Invoice Number</span>
											<select name="invoice_number" id='invoice_number' class="form-control-sm form-control invoice_number">
												<option value=''>Choose..</option>
												<?php
												if(!empty($invoicenumber)){
													foreach($invoicenumber as $tmp){
														echo "<option value='$tmp->quote_no'>$tmp->invoice_no</option>";
													}
												}
												?>
											</select>
                                        </div>
										
										<div class="form-group col-md-4">
                                            <span>Package Category</span>
											<input type="text" id="package_category" name="package_category" class="form-control-sm form-control">
                                        </div>
										
										<div class="form-group col-md-4">
                                            <span>Driver Name</span>
                                                <input type="text" value='' id="driver_name" name="driver_name" required="required" class="form-control form-control-sm">
                                        </div>
										
										<div class="form-group col-md-4">
                                            <span>Driver Phone</span>
                                                <input type="text" value='' id="driver_phone" name="driver_phone" required="required" class="form-control form-control-sm">
                                        </div>
										
										<div class="form-group col-md-4">
                                            <span>Vehicle Number</span>
                                                <input type="text" value='' id="vehicle_number" name="vehicle_number" required="required" class="form-control form-control-sm">
                                        </div>
									
									
									<div class='row'></div><br />
								<div class="form-group" style='background-color:#EAEAEA'>
									<div class='row'>
										<div class="col-md-5" align='center'>
											Vessels Name
										</div>
										<div class="col-md-3" align='center'>
											Quantity
										</div>
										<div class="col-md-3" align='right'>
										<a style='cursor:pointer;padding:0px 0px;color:white;' id='addNew' class="btn btn-primary btn-sm">Add Row</a>
										</div>
									</div>
								</div>
								<!-- Main Row -->
								<div id='firstLine'>
								        <div class="form-group mt-2">
											<div class="row">
												<div class="col-md-5">
												<select name="vessels[]" id='vessels' class="form-control-sm form-control">
												<option value=''>Choose..</option>
												<?php
												if(!empty($get_vessels)){
													foreach($get_vessels as $tmp){
														echo "<option value='$tmp->product_name'>$tmp->product_name</option>";
													}
												}
												?>
											</select>
												</div>
												
												<div class="col-md-3">
													<input type="text" name="quantity[]" class="tabp reference form-control form-control-sm">
												</div>

											</div>
										</div>
										
										<div class="form-group mt-2">
											<div class="row">
												<div class="col-md-5">
												<select name="vessels[]" id='vessels' class="form-control-sm form-control">
												<option value=''>Choose..</option>
												<?php
												if(!empty($get_vessels)){
													foreach($get_vessels as $tmp){
														echo "<option value='$tmp->product_name'>$tmp->product_name</option>";
													}
												}
												?>
											</select>
												</div>
												
												<div class="col-md-3">
													<input type="text" name="quantity[]" class="tabp reference form-control form-control-sm">
												</div>

											</div>
										</div>
										</div>
										
                    <div class="form-group col-md-12 mt-5" align=right>
					 <button type="submit" class="btn btn-primary btn-sm">Submit</button>
					 <button type="reset" class="btn btn-danger btn-sm" id="ResetBtn">Reset</button>
                    </div>
					</div>
					</div>
                </form>
                 
				 <div class="col-md-12 col-sm-12 col-12">
											<div class="table-responsive">
												<table class="table table-bordered" id="DataTable" width="100%">
													<thead>
														<tr>
															<th>#</th>
															<th>Invoice Number</th>
															<th>Driver Name</th>
															<th>Driver Phone</th>
															<th>Vehicle Number</th>
															<th width="20px;">Actionejcghuhugj</th>
														</tr>
													</thead>

												</table>
											</div>
										</div>
				 
            </div>
        </div>
    </div>
</div>

<div class="content-backdrop fade"></div>

<script>
 $(document).ready(function () {
		
				i = 1;
				$("#addNew").click(function(){
					 i++;
					 $.ajax({
					  url: "<?= base_url().'get_row' ?>",
					  type:"POST",
					  data: {
						rowid : i
					  },
					  success: function( data ) {
						  $("#firstLine").append(data);		
					  }
					});
				});
 });
 
 $(document).on("click",".delrow",function(){
				  $(this).parent().parent().remove(); 
			   });
				
$(document).ready(function(){
	$('#DataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"order": [[ 1, "asc" ]],
		'ajax': {
			'url':	"<?= base_url().'list_delivery_challan' ?>",
			'type':	"POST"
		},
		"columnDefs": [{ 
			"targets": [0,2],
			"orderable": false
		}]
	});
});

$("#ResetBtn").click(function(){
	clear_data_form();
});

$("#DataForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#DataForm")[0]);
	$.ajax({
		url: "<?= base_url().'add_delivery_challan' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#DataForm [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				clear_data_form();
				$('#DataTable').DataTable().ajax.reload(null, false);
				toastr.success(data['msg']);
			}
		},
		complete: function(data) {
			$("#DataForm [type='submit']").attr('disabled', false);
		},
	});
}));

function clear_data_form(){
	$('#challan_id').val('');
	$("#DataForm [type='submit']").html('Submit');
	$("#DataForm").trigger('reset');
}

$(document).on("click",".delete_data",function(){
	var val = confirm("Are You Sure to Delete !!!");
	if(val==true){
		$.ajax({
			url: "<?= base_url().'delete_delivery_challan' ?>",
			type: "POST",
			data:  { keys : $(this).attr('data-challan_id') },
			dataType: "JSON",
			success: function(data)
			{
				if(data['status']=="Warning"){
					toastr.warning(data['msg']);
				}else{
					toastr.info(data['msg']);
					$('#DataTable').DataTable().ajax.reload(null, false);
				}
			}
		});
	}
});

$(document).on("click",".edit_data",function(){
	$("#DataForm [type='submit']").html('Update');
	$('#challan_id').val($(this).attr('data-challan_id'));
	$('#invoice_number').val($(this).attr('data-invoice_number'));
	$('#driver_name').val($(this).attr('data-driver_name'));
	$('#driver_phone').val($(this).attr('data-driver_phone'));
	$('#vehicle_number').val($(this).attr('data-vehicle_number'));
	
	
	window.scroll({top: 0, behavior: "smooth"})
});


$(document).on("change",".invoice_number",function(){
				if($(this).val() != ''){
					var id = $(this).attr("id");
					id = id.split("_");
					
					$.ajax({
						url: "<?= base_url().'get_invoicedetails' ?>",
						method: "POST",
						dataType: "json",
						data: {
							quote_no: $(this).val()
						},
						success: function( data ) {
							$("#package_category").val(data.quote_package_id);
						}
					});
				}
			});
			   
</script>
<style>
    @media (max-width:591px) {
        .btn-icon {
            width: calc(2.309375rem + -6px);
        }

        .page-item:not(:first-child) .page-link {
            margin-left: -1.8125rem;
        }
        .container-xxl {
    padding-right: 0rem;
    
}

    }

	@media (max-width:845px){
		.edit_data {
			width: 50%;
    display: grid;



}
.delete_data {
			width: 50%;
    display: grid;



}
.print_data {
			width: 50%;
    display: grid;



}



	}
</style>