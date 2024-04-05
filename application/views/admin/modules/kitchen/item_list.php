<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Items List</h5> 
            </div>
            <div class="card-body">                
                <div class="table-responsive text-nowrap">
                    <form method="post" action="<?php echo base_url('admin/kitchen/items'); ?>">
                        <table border="0" cellspacing="5" cellpadding="5">
                            <tbody>
                                <tr>
                                    <td>Start date :</td>
                                <td><input type="date" id="fromdate" name="fromdate" class="form-control rounded-0" value="<?php echo set_value('fromdate');?>"></td>
                                <td>Category :</td>
                                <td><select id="category" name="category" class="form-control rounded-0">
									<option value=''>Choose category ..</option>
										<?php
										if(!empty($categorys)){
											foreach($categorys as $tmp){
												echo "<option value='$tmp->category_name'>$tmp->category_name</option>";
											}
										}
										?>
									</select></td>
                                    <td><button class="form-control-sm btn btn-primary" type="submit" id="date_search" name="date_search" value="filter">Go</button></td>
                                    <td class="right"><button class="form-control-sm btn btn-primary" type="submit" id="date_reset" name="date_reset" value="filter">Reset</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    </br>                        
                    </br>
					<!-- <?php 
$total_quantity = 0;
foreach ($kitchen_items as $items) {
    $total_quantity += $items->quantity;
}
?>
<p style="display: flex;justify-content: end;font-family: monospace;color:green;font-size:20px;"> Total Quantity : <?php echo $total_quantity; ?></p> -->
                    <table id="kitchenItemListTable" class="table table-bordered" style="width:100%">
                        <caption>List of orders</caption>
                        <thead>
                            <tr class="table-dark">
                                <th class="text-white">#</th>
                                <!-- <th class="text-white">Order ID</th>
                                <th class="text-white">Order Date</th>
                                <th class="text-white">Category</th> -->
                                <th class="text-white">Items</th>
                                <th class="text-white">Quantity</th>
                                <!-- <th class="text-white">Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
								$i = 1; 
								$get_items = []; 
								foreach ($kitchen_items as $items):
									$quantity = $items->quantity;
									$item_names = explode(',', $items->item_name);
								   
									foreach ($item_names as $item_name):
										
										if (!array_key_exists(trim($item_name), $get_items)) {
											$get_items[trim($item_name)] = $quantity; 
										} else {
										   
											$get_items[trim($item_name)] += $quantity;
										}
										
									endforeach; 
								endforeach; 

								foreach ($get_items as $item_name => $total_quantity):
								?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $item_name; ?></td>
										<td><?php echo $total_quantity; ?></td>
									</tr>
								<?php 
									$i++; 
								endforeach; 
								?>

                        </tbody>								
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    @media (max-width:591px) {
        .btn-icon {
            width: calc(2.309375rem + -3px);
        }

        .page-item:not(:first-child) .page-link {
            margin-left: -1.8125rem;
        }
        .container-xxl {
    padding-right: 0rem;
    
}
    }
</style>