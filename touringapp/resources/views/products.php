<?php global $mobile_country_code,$singapour_country;?>
<div class="dashboard-content">
	<div class="">
	<div class="row">
		<div class="col-lg-12 col-md-12 padding-right-30">

			<!-- Titlebar -->
			<div id="titlebar" class="listing-titlebar">
				<div class="listing-titlebar-title">
					<h2>Products Management</h2>
				</div>
			</div>
		</div>
		
		<!-- Apartment List -->
		<div class="col-lg-6 col-md-12 padding-right-30 margin-bottom-30">
			<div class="dashboard-list-box margin-top-0">
				<h4 class="gray">Products Listings</h4>

				<ul class="list-group">
                	<?php foreach($get_packages_list as $allpackages)
					{ ?>
                        <li class="package-listing">
                            <div class="list-box-listing">
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                    <?php $message =  wordwrap($allpackages->prod_desc, 40, "\n", TRUE); ?>
                                        <p><?php echo $allpackages->prod_name;?></p>
                                        <span><?php echo $message;?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a href="<?php echo $base_url.'admin/products/update_products/'.$allpackages->prod_id; ?>" class="button gray"><i class="sl sl-icon-note"></i> Edit</a>
                                <a href="<?php echo $base_url.'admin/products/delete_products/'.$allpackages->prod_id;?>" class="button gray"><i class="sl sl-icon-close"></i> Delete</a>
                            </div>
                        </li>
                    <?php }?>
				</ul>

			</div>
		</div>
		
		<!-- New Apartment -->
		<div class="col-lg-6 col-md-12 padding-right-30 margin-bottom-30">
			<div class="dashboard-list-box margin-top-0">
				<h4 class="gray">Add Products</h4>
				<div class="dashboard-list-box-static">
				
					<div class="my-profile">
                    	<form name="add-package-frm" id="add-package-frm" action="<?php echo $base_url.'admin/products/save_products_admin';?>" method="POST">
                             <label>Product Name*</label>
                            <input type="text" required placeholder="Product Name" name="prod_name"/>
                         
                            <label>Description*</label>
                            <textarea name="prod_desc" required  placeholder="Description"></textarea>
                           
                            <label>Status*</label>
                            <select name="status" id="status" required>
                               <option value="">Choose anyone</option>
                               <option value="1">active</option>	
                               <option value="2">deactive</option>	
                              
                            </select>
							<div class="gallimg"></div>
              
                        </form>
                           <div class="add-listing-section margin-top-45">

							<!-- Headline -->
							<div class="add-listing-headline">
							<label><i class="sl sl-icon-picture"></i> Product Image</label>
							</div>
								<!-- Dropzone -->
							<div class="submit-section">
								<form action="<?php echo $base_url; ?>admin/products/upload_product_gallery" class="dropzone " >
								</form>
							</div>

						</div>
					 <button type="button" id="sub_product" class="button margin-top-15" value="Add">Add</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div></div>
<!--
 <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>      
    <script> 

         jQuery(".dropzone").dropzone({

			  contentType: "application/json",
			dataType: "json",
            success : function(file, response) {
               var objres = jQuery.parseJSON(response);
               					console.log(objres);

                if (objres.target_file != '') {
					console.log(objres.target_file);
					
					     //       tmpHTML += "<input type=\"file\" name=\"file1\" onchange=\"changed()\">";
            var tmpHTML = $('.gallimg').html();

               tmpHTML += "<input type=\"hidden\" name=\"galleryimg[]\" id=\"galleryimg\" class=\"galleryimg\" value=\""+objres.target_file+"\">";
                   
                   $('.gallimg').html(tmpHTML);
                }
            }

        });
-->    <script> 
        $("#sub_product").bind("click",function() {
        	$('#add-package-frm').validate({    		           
       		});
    		$('#add-package-frm').submit();
		}); 
    </script>
