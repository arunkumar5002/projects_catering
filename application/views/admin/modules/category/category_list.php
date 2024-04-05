<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Category List</h5> 
                <a href="<?php echo base_url()?>admin/category/addEditCategoryItem" class="btn btn-primary d-block m-3">
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
                <div class="table-responsive text-nowrap">
                    <table id="categoryListTable" class="table table-bordered" style="width:100%">
                        <caption>List of Category</caption>
                        <thead>
                            <tr class="table-dark">
                                <th class="text-white">#</th>
                                <!-- <th class="text-white">Category ID</th> -->
                                <th class="text-white">Category Name</th>
                                <!-- <th class="text-white">Description</th> -->
                                <th class="text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($category_items as $item): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <!-- <td><?php //echo "ITM0".$item->id; ?></td> -->
                                    <td><?php echo ucwords(strtolower($item->category_name)); ?></td>
                                    <!-- <td><?php echo $item->description; ?></td> -->
                                    <td>
                                        <a href="<?php echo base_url() . 'admin/category/addEditCategoryItem/' . $item->id ?>" class="btn btn-icon btn-outline-primary">
                                            <span class="tf-icons bx bx-edit-alt"></span>
                                        </a>
                                        <a href="<?php echo base_url() . 'admin/category/deleteCategoryItem/' . $item->id ?>" class="btn btn-icon btn-outline-danger delete-btn">
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