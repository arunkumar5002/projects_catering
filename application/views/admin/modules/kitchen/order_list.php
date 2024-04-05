<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Order List</h5> 
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <form method="post" action="<?php echo base_url('admin/kitchen'); ?>">
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

                    <table id="kitchenOrderListTable" class="table table-bordered" style="width:100%">
                        <caption>List of orders</caption>
                        <thead>
                            <tr class="table-dark">
                                <th class="text-white">#</th>
                                <th class="text-white">Order ID</th>
                                <th class="text-white">Booking Date</th>
                                <th class="text-white">Order Date</th>
                                <th class="text-white">Name</th>
                                <th class="text-white">Package Name</th>
                                <th class="text-white">Category</th>
                                <th class="text-white">Items</th>
                                <!-- <th class="text-white">Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; if($kitchen_orders): foreach ($kitchen_orders as $orders): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $orders->quote_no; ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($orders->booking_datetime)); ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($orders->order_date)); ?></td>
                                    <td><?php echo ucwords(strtolower($orders->customer_name)); ?></td>
                                    <td><?php echo $orders->package_name; ?></td>
                                    <td><?php echo $orders->category_name; ?></td>
                                    <td><?php echo $orders->item_name; ?></td>
                                    
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