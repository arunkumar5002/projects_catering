	<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Get Quotations </h5>
                </div>
                <div class="card-body">
                    <div class="justify-content-center">
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="flash-message_error">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                        <div class="input-group">
                            <input type="text" class="form-control" id="input_search" name="input_search" placeholder="Quote No / Mobile No" aria-label="Quote No / Mobile No" aria-describedby="button-addon1" />
                        </div>
                        </br>
                        <button class="btn btn-primary" type="button" id="go_search" data-mdb-ripple-color="dark">Add</button>
                        <button class="btn btn-primary" type="button" id="go_view" data-mdb-ripple-color="dark">View</button>
                        <button class="btn btn-primary" type="button" id="go_history" data-mdb-ripple-color="dark">History</button>

                        
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Invoice List</h5> 
            </div>
            <div class="card-body"> 	
            <div class="table-responsive text-wrap">
			<form method="post" action="<?php echo base_url('admin/salesinvoice'); ?>">
                        <table border="0" cellspacing="4" cellpadding="4">
                            <tbody>
                                <tr>
								    <td>Start Date :</td>
                                    <td><input type="date" id="fromdate" name="fromdate" class="form-control rounded-0" value="<?php echo set_value('fromdate');?>"></td>
									<td>End date :</td>
                                    <td><input type="date" id="todate" name="todate" class="form-control rounded-0" value="<?php echo set_value('todate');?>"></td>
									<td>Status :</td>
									<td>
									<select id="type" name="type" class="form-control rounded-0">
									<option value="">Select One type..</option>
									<option value="Paid">Paid</option>
									<option value="Partially">Partially</option>
									<option value="Pending">Pending</option>
									</select>
									</td>
                                    <td><button class="btn btn-primary" type="submit" id="date_search" name="date_search" value="filter">Go</button></td>
                                    <td class="right"><button class="btn btn-primary" type="submit" id="date_reset" name="date_reset" value="filter">Reset</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    </br>                        
                    </br>
                    <table id="invoiceListTable" class="table table-bordered" style="width:100%">
                        <caption>List of Invoices</caption>
                        <thead>
                            <tr class="table-dark">
                                <th class="text-white">#</th>
                                <th class="text-white">Invoice No</th>
                                <th class="text-white">Customer Name</th>
                                <th class="text-white">Mobile No</th>
                                <th class="text-white">Booking Date</th>
                                <th class="text-white">Order Date</th>
                                <th class="text-white">Package Amount</th>
                                <th class="text-white">Paid Amount</th>
                                <th class="text-white">Balance Amount</th>
                                <th class="text-white">Status</th> 
                            </tr>
                        </thead>
                        <tbody>
                             <?php $i=1; if($invoice_details_list): foreach ($invoice_details_list as $value):
                                    $invoice_number = $this->db->where(array('quote_id'=>$value->quote_id,'quote_no'=>$value->quote_no))->select('invoice_no')->get('ca_invoice_number')->row();
                                    $invoice_no =($invoice_number) ? $invoice_number->invoice_no : null;
									
									$total_package_amount = $value->total_package_amount;
                                    $total_paid_amount = $value->total_paid_amount;
									
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $invoice_no; ?></td>
                                    <td><?php echo ucwords(strtolower($value->customer_name)); ?></td>
                                    <td><?php echo $value->mobile_no; ?></td>
                                    <td><?php echo date('d-m-y',strtotime($value->booking_datetime)); ?></td>
                                    <td><?php echo date('d-m-y',strtotime($value->order_date)); ?></td>
                                    <td><?php echo $value->total_package_amount; ?></td>
                                    <td><?php echo $value->total_paid_amount; ?></td>
                                    <!-- <td><?php //echo date('d-m-Y', strtotime($value->create_at)); ?></td> -->
                                    <td><?php echo $value->total_balance_amount; ?></td>
                                    <td align=center><?php 
								if ($total_paid_amount >= $total_package_amount) {
										
								echo "<p class='btn btn-success' style='font-size:11px;padding:0px 10px!important;color:black;margin-bottom: 0px'>Paid</p>";
								
								} elseif ($total_paid_amount > 0 && $total_paid_amount < $total_package_amount) {
									echo "<p class='btn btn-warning' style='font-size:11px;padding:0px 10px!important;color:black;margin-bottom: 0px'>Partially</p>";
								} elseif ($total_paid_amount == 0) {
									echo "<p class='btn btn-danger' style='font-size:11px;padding:0px 10px!important;color:white;margin-bottom: 0px'>Pending</p>";
								}
									?>
									</td> 
                                    <?php $i++; ?>
                                </tr>
                            <?php endforeach; endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    @media (max-width:591px) {
       

        .page-item:not(:first-child) .page-link {
            margin-left: -1.8125rem;
        }
        .container-xxl {
    padding-right: 0rem;
    
}
    }
</style>