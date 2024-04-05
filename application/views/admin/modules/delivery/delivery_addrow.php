<div class="form-group mt-2">
											<div class="row">
												<div class="col-md-5">
												<select name="vessels[]" id='vessels' class="form-control-sm form-control">
												<option value=''>Choose..</option>
												<?php
												if(!empty($get_vessels)){
													foreach($get_vessels as $tmp){
														echo "<option value='$tmp->product_name'>$tmp->product_name</option>";
													}
												}
												?>
											</select>
												</div>
												
												<div class="col-md-3">
													<input type="text" name="quantity[]" class="tabp reference form-control form-control-sm">
												</div>
												 <div class="col-md-1">
												 <a style='cursor:pointer;padding:0px 0px' class="delrow btn btn-warning">Delete</a>	
												</div>	

											</div>
										</div>