<style>.input-group { width: 25% !important;}

.input-group form-control multiselect-search{ width:100%;}
.multiselect-container{
    transform: translate3d(0px, 40px, 0px) !important;
}

.dropdown-menu{
	min-width: 30rem !important;
}

</style>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Package <?php echo ($package_category_item) ? ' Edit' : ' Add'; ?> </h5>
                <a href="<?php echo base_url()?>admin/package" class="btn btn-primary d-block m-3">
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
                <form id="package_add_eidt_form" action="<?php echo base_url() . 'admin/package/insertPackageItem/'. (($package_category_item) ? $package_category_item->package_id : '')?>" method="post">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label" for="package_name">Package Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="package_name" name="package_name" placeholder="Enter package name" required="required" value="<?php echo ($package_category_item) ? $package_category_item->package_name : set_value('package_name'); ?>" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label" for="package_category_id">Package Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="package_category_id" name="package_category_id">
                                <option value="">Select Category</option>
                                <?php if(!empty($category_items) && count($category_items)>0) :
                                    foreach ($category_items as $category) : ?>
                                    <option value="<?php echo $category->id;?>" <?php if($package_category_item) { if($package_category_item->category_id == $category->id) { echo "selected";} }?> <?php echo set_select('package_category_id', $category->id); ?> ><?php echo ucwords(strtolower($category->category_name)); ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label" for="pacakge_item_list">Package Item(s)</label>
                        <div class="col-sm-10">
                        <select  id="pacakge_item_list" class="form-control dropdown-toggle" name="pacakge_item_list[]" required="required" multiple="multiple" style="color: #777;  font-weight: 400; height: 40px; top:93px; ">
                        <?php
                            if (!empty($menu_items)) :
                            foreach ($menu_items as $item) : ?>
                                
                                <option style="z-index:9999;"value="<?php echo $item->id;?>"><?php echo ucwords(strtolower($item->item_name));?></option>
                        <?php endforeach; endif; ?>
                        </select>
                        </div>
                    </div>
				
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label" for="package_price">Package Price</label>
                        <div class="col-sm-10 input-group" style="display: contents;">
                            <div class="input-group-prepend">
                                <div class="input-group-text">&#8377;</div>
                            </div>
                            <input type="number" class="form-control" id="package_price" name="package_price" placeholder="Enter price" required="required" value="<?php echo ($package_category_item) ? $package_category_item->package_price : set_value('package_price'); ?>" />
                        </div>
                    </div>

                    <input type="hidden" id="edit_package_id" name="edit_package_id" value="<?php echo ($package_category_item) ? $package_category_item->package_id : ''; ?>">

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

</body>
</html>
<style>
    @media (max-width:591px) {
       

       
        .container-xxl {
    padding-right: 0rem;
    
}
    }
</style>