<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Purchase Quotations Edit</h5>
                    <a href="<?php echo base_url()?>admin/salesquote" class="btn btn-primary d-block m-3"><i class='bx bx-list-ul'></i>  List </a>
                </div>
                <div class="card-body">
                    <!-- <form action="#" id="add_quotaion_form" name="add_quotaion_form" method="post" autocomplete="off"> -->
                    <form action="<?php echo base_url() . 'admin/salesquote/insertSalesquoteItem/'. (($quote_item) ? $quote_item->quote_id : '')?>" id="edit_quotaion_form" name="edit_quotaion_form" method="post" autocomplete="off">
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
                                    <input class="form-control" type="date" id="booking_datetime" name="booking_datetime" required="required" value="<?php echo ($quote_item) ? $quote_item->booking_datetime : date('Y-m-d'); ?>" />
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
                                    <h5 class="card-header">Select Package</h5>
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
                                                    <th class="text-white">Final Price</th>
                                                    <th class="text-white">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php if($package_list_count && $package_list_count>0): 
                                                    for($i=1; $i<=$package_list_count; $i++): ?>
                                                <tr id="row<?=$i?>">
                                                    <td>
                                                        <select class="form-control dropdown-toggle quote_package_name" id="quote_package_name_<?=$i?>" name="quote_package_name[]" data-package-index=<?=$i?> required="required" style="color: #777; margin-top: 0px; font-weight: 400; height: 40px;">
                                                            <option value="">Select Package</option>
                                                            <?php if(!empty($packages) && count($packages)>0) :
                                                                    foreach ($packages as $key => $package) :?>
                                                                        <option value="<?php echo $package->id;?>" <?php if($quote_package_details[$key]->quote_package_id == $package->id) { echo "selected";} ?> <?php echo set_select('quote_package_name', $package->id); ?> ><?php echo $package->package_name; ?></option>
                                                            <?php   endforeach; endif; ?>
                                                        </select>
                                                    </td>
                                                    
                                                </tr> 
                                                <?php endfor; endif;?>
                                            </tbody> 
                                        </table>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        
                        <input type="hidden" name="edit_package_id" id="edit_package_id" />
                        <input type="hidden" name="edit_quote_id" id="edit_quote_id" value="<?php echo $edit_quote_id; ?>"/>
                        <input type="hidden" name="package_list_count" id="package_list_count" value="<?php echo $package_list_count; ?>"/>
                        
                        </br>
                        <div class="row">
                            <div class="col-md-12">  
                                <button type="submit" class="btn btn-outline btn-primary" id="add_quotaion_form_btn">Submit</button>
                                <!-- <button type="submit" class="btn btn-danger">Reset</button> -->
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- for Add more -->
<!-- <script type="text/javascript">
    $(document).ready(function(){      
      var i=1;  
      $('#add').click(function(){  
           i++;  
        //    $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"> <td><select class="form-control dropdown-toggle quote_package_name" id="quote_package_name" name="quote_package_name[]" required="required" style="color: #777; margin-top: 0px; font-weight: 400; height: 40px;"><option value="">Select Package</option><?php if(!empty($packages) && count($packages)>0) :foreach ($packages as $package) : ?><option value="<?php echo $package->id;?>" <?php if($quote_item){ if($quote_item->quote_package_id == $package->id) { echo "selected";} }?> <?php echo set_select('quote_package_name', $package->id); ?> ><?php echo $package->package_name; ?></option><?php   endforeach; endif; ?></select></td><td><input type="text" class="form-control" id="quote_package_category" name="quote_package_category" required="required" readonly /></td><td><input type="text" class="form-control" id="package_items"  name="package_items[]" required="required" placeholder="Package Items" aria-describedby="defaultFormControlHelp" data-bs-toggle="modal" data-bs-target="#backDropModal"></td><td><input type="text" class="form-control" id="price" name="price" required="required" readonly value="<?php echo ($quote_item) ? $quote_item->final_price : set_value('price'); ?>" /></td><td><input type="date" class="form-control" id="order_date" name="order_date" required="required" value="<?php echo ($quote_item) ? $quote_item->order_date : set_value('order_date'); ?>" /></td><td><input type="text" class="form-control" id="quantity" name="quantity" required="required" value="<?php echo ($quote_item) ? $quote_item->quantity : set_value('quantity'); ?>" /></td><td><input type="text" class="form-control" id="final_price" name="final_price" required="required" value="<?php echo ($quote_item) ? $quote_item->final_price : set_value('final_price'); ?>" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"> <td><select class="form-control dropdown-toggle quote_package_name" id="quote_package_name_'+i+'" name="quote_package_name[]" data-package-index='+i+' required="required" style="color: #777; margin-top: 0px; font-weight: 400; height: 40px;"><option value="">Select Package</option><?php if(!empty($packages) && count($packages)>0) :foreach ($packages as $package) : ?><option value="<?php echo $package->id;?>" <?php if($quote_item){ if($quote_item->quote_package_id == $package->id) { echo "selected";} }?> <?php echo set_select('quote_package_name', $package->id); ?> ><?php echo $package->package_name; ?></option><?php   endforeach; endif; ?></select></td><td><input type="text" class="form-control quote_package_category" id="quote_package_category_'+i+'" name="quote_package_category[]" required="required" readonly /></td><td><input type="text" class="form-control package_items_txt" id="package_items_txt_'+i+'"  name="package_items_txt[]" required="required" placeholder="Package Items" aria-describedby="defaultFormControlHelp" data-bs-toggle="modal" data-bs-target="#backDropModal"></td><td><input type="text" class="form-control price" id="price_'+i+'" name="price[]" required="required" readonly value="<?php echo ($quote_item) ? $quote_item->final_price : set_value('price'); ?>" /></td><td><input type="date" class="form-control order_date" id="order_date_'+i+'" name="order_date[]" required="required" value="<?php echo ($quote_item) ? $quote_item->order_date : set_value('order_date'); ?>" /></td><td><input type="text" class="form-control quantity" id="quantity_'+i+'" name="quantity[]" required="required" value="<?php echo ($quote_item) ? $quote_item->quantity : set_value('quantity'); ?>" /></td><td><input type="text" class="form-control final_price" id="final_price_'+i+'" name="final_price[]" required="required" value="<?php echo ($quote_item) ? $quote_item->final_price : set_value('final_price'); ?>" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      });

      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();  
      }); 

    });  
</script> -->

<!-- for reset -->
<script>
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        //$('#row'+button_id+'').remove(); 
        var row = $(this).closest('tr');
        // Find form inputs within the row and reset their values
        row.find('input, select, textarea').val('');
        // Reset checkboxes and radio buttons
        row.find('input[type=checkbox], input[type=radio]').prop('checked', false); 
    });  

</script>
