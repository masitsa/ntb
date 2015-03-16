 <div class="container-fluid">

 	<div class="col-md-12 col-lg-12 text-right" style="margin-top:5px;">
 		 <a href="<?php echo base_url();?>events" class="btn btn-info btn-sm">Back to events</a>
 	</div>
 	<div class="col-md-12 col-lg-12">
     	<h4 class="page-section-heading">Booking : Audit Staff Training Workshop: Coast Branch</h4>
     		
	        <!-- Tabbable Widget -->
	        <div class="tabbable tabs-blocks">
	            <!-- Tabs -->
	            <ul class="nav nav-tabs">
	                <li class="active"><a href="#blocks-home-1" data-toggle="tab"><i class="fa fa-home"></i>Personal details</a>
	                </li>
	                <li><a href="#blocks-profile-1" data-toggle="tab"><i class="fa fa-user "></i> Payment</a>
	                </li>
	                <li><a href="#blocks-settings-1" data-toggle="tab"><i class="fa fa-cog"></i> Order review</a>
	                </li>
	            </ul>
	            <!-- // END Tabs -->
	            <!-- Panes -->
	            <div class="tab-content">
	                <div id="blocks-home-1" class="tab-pane active">
	                   	<h4 class="page-section-heading">Basic info</h4>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-control-default">
                                                <label for="exampleInputFirstName">First name</label>
                                                <input type="email" class="form-control" id="exampleInputFirstName" placeholder="Adrian">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-control-default">
                                                <label for="exampleInputLastName">Last name</label>
                                                <input type="email" class="form-control" id="exampleInputLastName" placeholder="Dan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-control-default required">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="adrian@gmail.com">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Next</button>
                                </form>
                            </div>
                        </div>
	                </div>
	                <div id="blocks-profile-1" class="tab-pane">
	                  	Choose a payment method
	                </div>
	               
	                <div id="blocks-settings-1" class="tab-pane">
	                  	 <!-- Progress table -->
		        <div class="table-responsive">
		            <table class="table v-middle">
		                <thead>
		                    <tr>
		                        <th width="20">
		                            <div class="checkbox checkbox-single margin-none">
		                                <input id="checkAll" data-toggle="check-all" data-target="#responsive-table-body" type="checkbox" checked>
		                                <label for="checkAll">Check All</label>
		                            </div>
		                        </th>
		                        <th>Date</th>
		                        <th>Event Name</th>
		                        <th>Location</th>
		                        <th>Attendants</th>
		                        <th class="text-right" colspan="4" width="100">Action</th>
		                    </tr>
		                </thead>
		                <tbody id="responsive-table-body">
		                    <tr>
		                        <td>
		                            <div class="checkbox checkbox-single">
		                                <input id="checkbox1" type="checkbox" checked>
		                                <label for="checkbox1">Label</label>
		                            </div>
		                        </td>
		                        <td><span class="label label-default">Tue 17.02 - Wed 18.02.2015</span>
		                        </td>
		                        <td>
		                            Audit Staff Training Workshop: Coast Branch
		                        </td>
		                        </td>
		                        <td>Kisumu beach resort<a href="#"><i class="fa fa-map-marker fa-fw text-muted"></i></a>
		                        </td>
		                        <td>
		                            <div class="progress">
		                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
		                                </div>
		                            </div>
		                        </td>
		                        <td >
		                           	 <a href="<?php echo base_url();?>view-event/1" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="view">Remove event</a>
		                        </td>
		                    </tr>
		                  
		                </tbody>
		            </table>
		        </div>
		        <!-- // Progress table -->
		        <div class="panel-footer padding-none text-center">
		            <ul class="pagination">
		                <li class="disabled"><a href="#">&laquo;</a>
		                </li>
		                <li class="active"><a href="#">1</a>
		                </li>
		                <li><a href="#">&raquo;</a>
		                </li>
		            </ul>
		        </div>
	                </div>
	            </div>
	            <!-- // END Panes -->
	        </div>
     </div>

 </div>