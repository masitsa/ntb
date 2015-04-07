<a data-toggle="modal" data-target=".add-attachment"  class="btn btn-success btn-sm pull-right"  data-toggle="tooltip" data-placement="top" title="Add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add attachment</a>

<div class="modal fade add-attachment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="hgroup title">
             <h3>Attachments for</h3>
        </div>
    </div>
        <form enctype="multipart/form-data" meeting_id="<?php echo $meeting_id;?>" action="<?php echo base_url();?>site/upload_controller/do_upload/<?php echo $meeting_id;?>"  id = "attachment_form" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="control-group">
                            <label class="control-label">Attachment</label>
                            <div class="controls">
                               <input type="file" name="userfile"  class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button class="btn btn-danger btn-sm" type="submit"  data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary btn-sm" type="submit" onclick="">Upload Attachment</button>
                </div>
            </div> 
        </form>


    </div>
</div>
</div>
<table data-toggle="data-table" class="table" cellspacing="0" width="100%">
<thead>
    <th width="20">
       
    </th>
    <th>Created</th>
    <th>File Name</th>
    <th>Attachment</th>
    <th class="text-right" colspan="2">Actions</th>
</thead>
	<tbody id="responsive-table-body">
	     <?php
	        $meeting_attachments = $this->site_model->get_all_meeting_attachments($meeting_id);
	        if ($meeting_attachments->num_rows() > 0)
	        {
	          
	            $x =0;
	            foreach ($meeting_attachments->result() as $row)
	            {
	                $file_id = $row->file_id;
	                $created = $row->created_on;
	                $file_delete = $row->file_delete;
	                $file_name = $row->filename;
	                $created_by = $row->created_by;
	                 if($file_delete == 0)
	                {
	                    $status = '<span class="label label-success btn-xs">Active</span>';
	                    $button = '<a class="btn btn-danger btn-xs "  file_id="'.$file_id.'" onclick="deactivate_attachment('.$file_id.','.$meeting_id.')">Deactivate</a>';
	                }
	                
	                else
	                {
	                    $status = '<span class="label label-danger label-xs">Disabled</span>';
	                    $button = '<a class="btn btn-success btn-xs" onclick="activate_attachment('.$file_id.','.$meeting_id.')">Activate</a>';
	                }
	             
	                $x++;
	                ?>
	                <tr>
	                    <td>
	                        <?php echo $x;?>
	                    </td>
	                     <td>
	                        <span class="label label-default label-xs"><?php echo date('jS M Y H:i a',strtotime($created));?></span>
	                    </td>
	                    <td>
	                        <?php echo $file_name;?>
	                    </td>
	                    <td><a href="<?php echo base_url();?>assets/files/<?php echo $file_name;?>" target="_blank">Download attachment</a></td>
	                    <td><?php echo $button;?></td>
	                    <td>
	                        <a  class="btn btn-danger btn-xs " data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete" onclick="delete_attachment(<?php echo $file_id;?>,<?php echo $meeting_id;?>)"><i class="fa fa-times"></i> Delete from list</a>
	                    </td>

	                </tr>
	                <?php    
	            }
	        }
	        ?>
	</tbody>
</table>