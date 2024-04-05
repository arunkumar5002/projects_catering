<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Order List</h5> 
            </div>
            <div class="card-body">
                
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <caption>List of orders</caption>
                        <thead>
                            <tr class="table-dark">
                                <th class="text-white">#</th>
                                <th class="text-white">Order ID</th>
                                <th class="text-white">Booking Date</th>
                                <th class="text-white">Order Date</th>
                                <th class="text-white">Package Name</th>
                                <th class="text-white">Category</th>
                                <th class="text-white">Items</th>
                                <th class="text-white">Quantity</th>
                                <!-- <th class="text-white">Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($kitchen_items as $items): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $items->quote_no; ?></td>
                                    <td><?php echo $items->booking_datetime; ?></td>
                                    <td><?php echo $items->order_date; ?></td>
                                    <!-- <td><?php echo ucwords(strtolower($items->customer_name)); ?></td> -->
                                    <td><?php echo $items->package_name; ?></td>
                                    <td><?php echo $items->category_name; ?></td>
                                    <td><?php echo $items->item_name; ?></td>
                                    <td><?php echo $items->quantity; ?></td>
                                    
                                    <?php $i++; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
