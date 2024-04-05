<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Vessels <?php echo ($vessels_item) ? ' Edit' : ' Add'; ?> </h5>
                <a href="<?php echo base_url()?>admin/vessels" class="btn btn-primary d-block m-3">
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
                <form action="<?php echo base_url() . 'admin/vessels/insertVesselsItem/'. (($vessels_item) ? $vessels_item->id : '')?>" method="POST">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="product_name">Product Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter Product Name" required="required" value="<?php echo ($vessels_item) ? $vessels_item->product_name : set_value('product_name'); ?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="quantity">Quantity</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Enter Quantity" required="required" value="<?php echo ($vessels_item) ? $vessels_item->quantity : set_value('quantity'); ?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="cost_of_vessels">Cost of Vessels</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="cost_of_vessels" id="cost_of_vessels" placeholder="Enter Cost of Vessels" required="required" value="<?php echo ($vessels_item) ? $vessels_item->cost_of_vessels : set_value('cost_of_vessels'); ?>"/>
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