<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Package List</h5> 
                <a href="<?php echo base_url()?>admin/package/addEditPackageItem" class="btn btn-primary d-block m-3">
                    <i class='bx bx-plus'></i>  Create </a>
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
                <div class="table-responsive text-wrap">
                    <table id="packageListTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr class="table-dark">
                                <th class="text-white">#</th>
                                <th class="text-white">Package Name</th>
                                <th class="text-white">Package Category(s)</th>
                                <th class="text-white">Package Item(s)</th>
                                <th class="text-white">Package Price</th>
                                <th class="text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i=1; foreach ($package_category_item as $key => $value): ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo ucwords(strtolower($value->package_name)); ?></td>
                                <td><?php echo ucwords(strtolower($value->category_name)); ?></td>
                                <td><?php echo ucwords(strtolower($value->item_name)); ?></td>
                                <td><?php echo "&#8377; ".$value->package_price; ?></td>
                                <td>
                                    <a href="<?php echo base_url() . 'admin/package/addEditPackageItem/' . $value->package_id ?>" class="btn btn-icon btn-outline-primary">
                                        <span class="tf-icons bx bx-edit-alt"></span>
                                    </a>
                                    <a href="<?php echo base_url() . 'admin/package/deletePackageItem/' . $value->package_id ?>" class="btn btn-icon btn-outline-danger delete-btn">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </a>
                                </td>
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