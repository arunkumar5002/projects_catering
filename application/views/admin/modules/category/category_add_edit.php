<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Category <?php echo ($category_item) ? ' Edit' : ' Add'; ?> </h5>
                <a href="<?php echo base_url()?>admin/category" class="btn btn-primary d-block m-3">
                    <i class='bx bx-list-ul'></i>  List </a>
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
                <form action="<?php echo base_url() . 'admin/category/insertCategoryItem/'. (($category_item) ? $category_item->id : '')?>" method="POST">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="category_name">Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Product Name" required="required" value="<?php echo ($category_item) ? $category_item->category_name : set_value('category_name'); ?>" />
                        </div>
                    </div>                    
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="content-backdrop fade"></div>


<style>
    @media (max-width:591px) {
       

       
        .container-xxl {
    padding-right: 0rem;
    
}
    }
</style>