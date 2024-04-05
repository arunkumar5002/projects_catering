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
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" required="required" placeholder="Enter name here" value="<?php echo ($quote_item) ? $quote_item->customer_name : set_value('customer_name'); ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mobile_no" class="form-label">Customer Mobile No:</label>
                                    <input type="tel" class="form-control" id="mobile_no" name="mobile_no" required="required" pattern="[0-9]{10}"  placeholder="Enter 10 digt mobile number here" value="<?php echo ($quote_item) ? $quote_item->mobile_no : set_value('mobile_no'); ?>" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Customer Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required="required"><?php echo ($quote_item) ? $quote_item->address : set_value('address'); ?></textarea>
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
                                    <h5 class="card-header">Invoice Payment</h5>
                                    <h5 class="card-header">Invoice No : <?php echo $invoice_number;?></h5>
                                </div>
                                <div class="form-group">
                                    <div class="table-responsive">  
                                        <table class="table table-bordered" id="dynamic_field"> 
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-white">Package Total Price [A]</th>
                                                    <th class="text-white">Discount Amount [B]</th>
                                                    <th class="text-white">Paid Amount [C]</th>
                                                    <th class="text-white">To Pay [A-(B+C)]</th>
                                                    <th class="text-white">Discount [C]</th>
                                                    <th class="text-white">Advance</th>
                                                    <th class="text-white">Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <tr>
                                                    <td><input type="number" class="form-control" id="total_price" name="total_price" value="<?php echo $quote_item->quote_total_price;?>" readonly></td>
                                                    <td><input type="number" class="form-control" id="total_discount" name="total_discount" value="<?php echo $total_discount;?>" readonly></td>
                                                    <td><input type="number" class="form-control" id="paid_amount" name="paid_amount" value="<?php echo $paid_amount;?>" readonly></td>
                                                    <td><input type="number" class="form-control" id="topay_amount" name="topay_amount" value="<?php echo $topay_amount;?>" readonly></td>
                                                    <td><input type="number" class="form-control" id="discount_amount" name="discount_amount"></td>
                                                    <td><input type="number" class="form-control" id="advance_amount" name="advance_amount" required="required"></td>
                                                    <td><input type="number" class="form-control" id="balance_amount" name="balance_amount" required="required" readonly ></td>
                                                </tr>
                                            </tbody> 
                                        </table>
                                    </div>
                                </div> 
                            </div>

                            <!-- <div class="col-md-2">
                                <label for="total_price" class="form-label">Package Total Price</label>
                                <input type="number" class="form-control" id="total_price" name="total_price" value="<?php echo $quote_item->quote_total_price;?>" readonly>
                            </div>
                            <div class="col-md-2">
                                <label for="paid_amount" class="form-label">Paid Amount</label>
                                <input type="number" class="form-control" id="paid_amount" name="paid_amount" value="<?php echo $paid_amount;?>" readonly>
                            </div>
                            <div class="col-md-2">
                                <label for="discount_amount" class="form-label">Discount</label>
                                <input type="number" class="form-control" id="discount_amount" name="discount_amount" required="required">
                            </div>
                            <div class="col-md-3">
                                <label for="advance_amount" class="form-label">Advance</label>
                                <input type="number" class="form-control" id="advance_amount" name="advance_amount" required="required">
                            </div>
                            <div class="col-md-3">
                                <label for="balance_amount" class="form-label">Balance</label>
                                <input type="number" class="form-control" id="balance_amount" name="balance_amount" required="required" readonly >
                            </div> -->

                        </div>
                                                
                        <input type="hidden" name="edit_quote_id" id="edit_quote_id" value="<?php echo $edit_quote_id; ?>"/>
                        <input type="hidden" name="edit_quote_no" id="edit_quote_no" value="<?php echo $edit_quote_no; ?>"/>
                        <input type="hidden" name="package_list_count" id="package_list_count" value="<?php echo $package_list_count; ?>"/>
                        
                        </br>
                        <div class="row">
                            <div class="col-md-12">  
                                <button type="submit" class="btn btn-outline btn-primary" id="add_quotaion_form_btn">Submit</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
