<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Purchase Quotations</h5>
                    <a href="<?php echo base_url()?>admin/salesinvoice" class="btn btn-primary d-block m-3"><i class='bx bx-list-ul'></i>  List </a>
                    <!-- <a href="<?php //echo base_url() . 'admin/salesquote/addEditQuoteItem/' . $edit_quote_id ?>" class="btn btn-primary d-block m-3"><i class="tf-icons bx bx-edit-alt"></i>Edit</a> -->
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url() . 'admin/salesinvoice/insertSalesInvoceItem/'. (($quote_item) ? $quote_item->quote_id : '')?>" id="add_quotaion_form" name="add_quotaion_form" method="post" autocomplete="off">
                        <div class="row">
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="quote_no" class="form-label">Quote No</label>
                                    <input type="text" class="form-control" id="quote_no" name="quote_no" required="required" readonly value="<?php echo ($quote_item) ? $quote_item->quote_no : $quote_no;?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="booking_datetime" class="form-label">Booking Date</label>
                                    <input class="form-control" type="date" id="booking_datetime" name="booking_datetime" required="required" readonly value="<?php echo ($quote_item) ? $quote_item->booking_datetime : date('Y-m-d'); ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="customer_name" class="form-label">Customer Name</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" required="required" readonly placeholder="Enter name here" value="<?php echo ($quote_item) ? $quote_item->customer_name : set_value('customer_name'); ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mobile_no" class="form-label">Customer Mobile No:</label>
                                    <input type="tel" class="form-control" id="mobile_no" name="mobile_no" required="required" readonly pattern="[0-9]{10}"  placeholder="Enter 10 digt mobile number here" value="<?php echo ($quote_item) ? $quote_item->mobile_no : set_value('mobile_no'); ?>" />
                                </div>
                            </div>
                        </div>
                        
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-header">Selected Package List</h5>
                                </div> 
                                <div class="form-group">
                                    <div class="table-responsive">  
                                        <table class="table table-bordered" id="dynamic_field"> 
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-white">Package Name</th>
                                                    <th class="text-white">Pakage Category</th>
                                                    <th class="text-white">Pakage Items</th>
                                                    <th class="text-white">Package Price</th>
                                                    <th class="text-white">Order Date</th>
                                                    <th class="text-white">Quantity</th>
                                                    <th class="text-white">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php if($quote_package_details && $quote_package_details>0): 
                                                    foreach ($quote_package_details as $key => $value): ?>                                                      
                                                <tr>
                                                    <td><?php echo $value->package_name;?></td>
                                                    <td><?php echo $value->category_name;?></td>
                                                    <td><?php echo $value->item_name;?></td>
                                                    <td><?php echo $value->package_price;?></td>
                                                    <td><?php echo $value->order_date;?></td>
                                                    <td><?php echo $value->quantity;?></td>
                                                    <td><?php echo $value->final_price;?></td>
                                                </tr> 
                                                <?php endforeach; endif;?>
                                            </tbody> 
                                        </table>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        </br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-header">Payment History</h5>
                                </div> 
                                <div class="form-group">
                                    <div class="table-responsive">  
                                        <table class="table table-bordered" id="dynamic_field"> 
                                            <thead class="table-dark">
                                                <tr>
                                                    <th colspan="3" class="text-white center">Package Total Amount - Rs. <?php echo $quote_item->quote_total_price; ?></th>
                                                    <th colspan="3" class="text-white center">Invoice Number : #<?php echo $invoice_no; ?></th>
                                                </tr>
                                                <tr>
                                                    <th class="text-white">#</th>
                                                    <th class="text-white">Date & Time</th>
                                                    <th class="text-white">Discount Amount</th>
                                                    <th class="text-white">Paid Amount</th>
                                                    <th class="text-white">Balance Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php $i=1; if($invoice_payments && $invoice_payments>0): 
                                                    foreach ($invoice_payments as $key => $value): ?>                                                      
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $value->create_at;?></td>
                                                    <td><?php echo $value->discount_amount;?></td>
                                                    <td><?php echo $value->paid_amount;?></td>
                                                    <td><?php echo $value->balance_amount;?></td>
                                                </tr> 
                                                <?php $i++; endforeach; endif;?>
                                            </tbody> 
                                        </table>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        
                                                
                        <input type="hidden" name="edit_quote_id" id="edit_quote_id" value="<?php echo $edit_quote_id; ?>"/>
                        <input type="hidden" name="edit_quote_no" id="edit_quote_no" value="<?php echo $edit_quote_no; ?>"/>
                        
                        </br>
                                              
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

