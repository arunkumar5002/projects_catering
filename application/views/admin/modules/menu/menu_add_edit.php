<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Menu <?php echo ($menu_item) ? ' Edit' : ' Add'; ?> </h5>
                <a href="<?php echo base_url()?>admin/menu" class="btn btn-primary d-block m-3">
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
                <form action="<?php echo base_url() . 'admin/menu/insertMenuItem/'. (($menu_item) ? $menu_item->id : '')?>" method="POST">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="item_name">Item Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Enter Item Name" required="required" value="<?php echo ($menu_item) ? $menu_item->item_name : set_value('item_name'); ?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="quantity">Quantity</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Enter Quantity" required="required" value="<?php echo ($menu_item) ? $menu_item->quantity : set_value('quantity'); ?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="price">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="price" id="price" placeholder="Enter price" required="required" value="<?php echo ($menu_item) ? $menu_item->price : set_value('price'); ?>"/>
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