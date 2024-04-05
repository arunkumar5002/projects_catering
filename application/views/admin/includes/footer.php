<?php 
$package_list_count = $this->db->where('package_status', 1)->count_all('ca_package');
for($k=1;$k<=$package_list_count;$k++): ?>
    <div class="modal fade" id="backDropModal_<?=$k?>" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
        <div id="package_items_spin_id"></div>
        <form action="#" autocomplete="off" id="package_items_assigned_form_<?=$k?>" method="post">
            <input type="hidden" id="quote_no" name="quote_no">
            <input type="hidden" id="package_id_<?=$k?>" name="package_id">
            <div class="modal-header">
            <h5 class="modal-title" id="package_items_title_<?=$k?>">Package Items Add / Remove</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="row form-row">
                <div class="form-group col-12">
                    <select class="form-control dropdown-toggle" id="package_items_<?=$k?>" name="package_items[]" required="required" multiple="multiple" style="color: #777; margin-top: 0px; font-weight: 400; height: 40px;">
                    <?php
                        if (!empty($menu_items)) :
                        foreach ($menu_items as $item) : ?>
                            <option value="<?php echo $item->id;?>"><?php echo ucwords(strtolower($item->item_name));?></option>
                    <?php endforeach; endif; ?>
                    </select>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline btn-default btn-sm btn-rounded" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="package_items_assigned_btn_<?=$k?>" class="btn btn-outline btn-primary ">Add</button>
            </div>
        </form>
        </div>
    </div>
    </div>
<?php endfor;?>

<!-- Modal -->
<div class="modal fade" id="quotePackageDetailsModal" tabindex="-1" role="dialog" aria-labelledby="quotePackageDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="quotePackageDetailsModalLabel">Package Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Package Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Items</th>
                    </tr>
                </thead>
                <tbody id="result_id">                    
                </tbody>
            </table>
        </div>                                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

           
            
                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , made with ❤️ by
                            <a href="https://www.addobyte.com/" target="_blank" class="footer-link fw-bolder">Addobyte Technologies</a>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
    var modules = '<?php echo $module; ?>';
    var pages = '<?php echo $page; ?>';
</script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://kit.fontawesome.com/93f3819bfd.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url();?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?php echo base_url();?>assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo base_url();?>assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?php echo base_url();?>assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?php echo base_url();?>assets/js/dashboards-analytics.js"></script>

    <!-- Application JS -->            
    <script src="<?php echo base_url();?>assets/js/web.js"></script>
    <script src="<?php echo base_url();?>assets/toastr/js/toastr.js"></script>

    <!-- Include DataTables -->
    <script src="<?php echo base_url();?>assets/js/dataTable/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTable/dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTable/dataTables.bootstrap4.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTable/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTable/dataTables.dateTime.min.js"></script>

    <!-- Include SelectBox -->
    <script src="<?php echo base_url();?>assets/bootstrap-select/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/multiselect/dist/js/bootstrap-multiselect.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
	<!-- Select2 -->
<script src="<?php echo base_url();?>assets/select2/js/select2.full.min.js"></script>
<script>
	$(document).ready(function(){
	$('.select2').select2();

});
</script>
    </body>
</html>
