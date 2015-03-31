 <footer class="footer">
    <strong>Meeting Scheduler </strong> v0.1 &copy; Copyright 2015
</footer><script>
    var colors = {
        "danger-color": "#e74c3c",
        "success-color": "#81b53e",
        "warning-color": "#f0ad4e",
        "inverse-color": "#2c3e50",
        "info-color": "#2d7cb5",
        "default-color": "#6e7882",
        "default-light-color": "#cfd9db",
        "purple-color": "#9D8AC7",
        "mustard-color": "#d4d171",
        "lightred-color": "#e15258",
        "body-bg": "#f6f6f6"
    };
    var config = {
        theme: "social-2",
        skins: {
            "default": {
                "primary-color": "#16ae9f"
            },
            "orange": {
                "primary-color": "#e74c3c"
            },
            "blue": {
                "primary-color": "#4687ce"
            },
            "purple": {
                "primary-color": "#af86b9"
            },
            "brown": {
                "primary-color": "#c3a961"
            },
            "default-nav-inverse": {
                "color-block": "#242424"
            }
        }
    };
    </script>
    <script type="text/javascript">
    $(document).on("submit","form.send_message2",function(e)
    {
        e.preventDefault();
        
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success:function(data){
                
                if(data == "false")
                {
                    $("#send_error").html('<div class="alert alert-danger">Unable to send message. Please try again</div>');
                }
                else
                {
                    var prev_message_count = parseInt($('#prev_message_count').val());//count the number of messages displayed
                    prev_message_count = prev_message_count + 1;
                    //$('#prev_message_count').val(prev_message_count);
                    $('#instant_message2').val('');
                    $("#view_message").html(data.messages);
                    //$("#available_credit").html(data.account_balance);
                }
            },
            error: function(xhr, status, error) {
                alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
            }
        });
        return false;
    });


        //Add to cart and redirect
       $(document).on("submit","form#action_point_form",function(e)
         {
          e.preventDefault();
          
          var formData = new FormData(this);
          
           var meeting_id = $(this).attr('meeting_id');
          $.ajax({
           type:'POST',
           url: $(this).attr('action'),
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           dataType: 'json',
           success:function(data){
            
            if(data.result == "success")
            {
                alert('The action point has been successfully added.');
                 parent.location ='<?php echo base_url(); ?>calendar';   
            }
            else
            {
                alert('Sorry, something went wrong make sure your have rated and entered your name.');
            }
           },
           error: function(xhr, status, error) {
            alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
           
           }
          });
          return false;
         });

        //Add to attendee
       $(document).on("submit","form#attendee_form",function(e)
         {
          e.preventDefault();
          
          var formData = new FormData(this);
          
           var meeting_id = $(this).attr('meeting_id');
          $.ajax({
           type:'POST',
           url: $(this).attr('action'),
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           dataType: 'json',
           success:function(data){
            
            if(data.result == "success")
            {
                alert('You have successfully added a new attendee.');
                 parent.location ='<?php echo base_url(); ?>calendar';   
            }
            else
            {
                alert('Sorry, something went wrong all the fields are filled.');
            }
           },
           error: function(xhr, status, error) {
            alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
           
           }
          });
          return false;
         });
        //Add to conveyee
       $(document).on("submit","form#convenor_form",function(e)
         {
          e.preventDefault();
          
          var formData = new FormData(this);
          
           var meeting_id = $(this).attr('meeting_id');
          $.ajax({
           type:'POST',
           url: $(this).attr('action'),
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           dataType: 'json',
           success:function(data){
            
            if(data.result == "success")
            {
                alert('You have successfully added a new convenor.');
                 parent.location ='<?php echo base_url(); ?>calendar';   
            }
            else
            {
                alert('Sorry, something went wrong all the fields are filled.');
            }
           },
           error: function(xhr, status, error) {
            alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
           
           }
          });
          return false;
         });

         //Add to meeting data
       $(document).on("submit","form#meeting_notes_form",function(e)
         {
          e.preventDefault();
          
          var formData = new FormData(this);
          
           var meeting_id = $(this).attr('meeting_id');
          $.ajax({
           type:'POST',
           url: $(this).attr('action'),
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           dataType: 'json',
           success:function(data){
            
            if(data.result == "success")
            {
                alert('Minutes have been updated.'); 
            }
            else
            {
                alert('Sorry, something went wrong, you might not have the rights to update or create this, only the person who created the meeting should be able to do this action.');
            }
           },
           error: function(xhr, status, error) {
            alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
           
           }
          });
          return false;
         });


          //Add to attachments
       $(document).on("submit","form#attachment_form",function(e)
         {
          e.preventDefault();
          
          var formData = new FormData(this);
          
           var meeting_id = $(this).attr('meeting_id');
          $.ajax({
           type:'POST',
           url: $(this).attr('action'),
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           dataType: 'json',
           success:function(data){
            
            if(data.result == "success")
            {
                alert('Attachment has been successfully uploaded.'); 
            }
            else
            {
                alert('Sorry, something went wrong all the fields are filled.');
            }
           },
           error: function(xhr, status, error) {
            alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
           
           }
          });
          return false;
         });


       //Add to cart
        $(document).on("click","a.delete_facilitator",function()
        {
            var facilitator_id = $(this).attr('facilitator_id');
      
            $.ajax({
                type:'POST',
                url: '<?php echo site_url();?>deactivate_meeting_facilitator/'+facilitator_id,
                cache:false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(data){
                    
                    if(data.result == "success")
                    {
                       


                    }
                    else
                    {
                        alert('Could not diactivate user');
                    }
                },
                error: function(xhr, status, error) {
                    alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
                }
            });
            
            return false;
        });
        //Add to delete_facilitator
        $(document).on("click","a.delete_facilitator",function()
        {
            var facilitator_id = $(this).attr('facilitator_id');
      
            $.ajax({
                type:'POST',
                url: '<?php echo site_url();?>delete-meeting-facilitator/'+facilitator_id,
                cache:false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(data){
                    
                    if(data.result == "success")
                    {
                       


                    }
                    else
                    {
                        alert('Could not diactivate user');
                    }
                },
                error: function(xhr, status, error) {
                    alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
                }
            });
            
            return false;
        });


        //Add to cart
        $(document).on("click","a.send_convenors_mail",function()
        {
            var facilitator_id = $(this).attr('facilitator_id');
          
            $.ajax({
                type:'POST',
                url: '<?php echo site_url();?>send-convenor-notification/'+facilitator_id,
                cache:false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(data){
                    
                    if(data.result == "success")
                    {
                       
                       alert('Could not diactivate user');

                    }
                    else
                    {
                        alert('Could not diactivate user');
                    }
                },
                error: function(xhr, status, error) {
                    alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
                }
            });
            
            return false;
        });
        //Add to cart

         //Add to cart
        $(document).on("click","a.send_mass_convenors_mail",function()
        {
            var meeting_id = $(this).attr('meeting_id');
          
            $.ajax({
                type:'POST',
                url: '<?php echo site_url();?>send-convenor-mass-notification/'+meeting_id,
                cache:false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(data){
                    
                    if(data.result == "success")
                    {
                       
                       alert('Successfully send the mass mail');

                    }
                    else
                    {
                        alert('Could send the mails. Please check the configurations');
                    }
                },
                error: function(xhr, status, error) {
                    alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
                }
            });
            
            return false;
        });



        //Add to cart
        $(document).on("click","a.send_attendees_mail",function()
        {
            var attendee_id = $(this).attr('attendee_id');
          
            $.ajax({
                type:'POST',
                url: '<?php echo site_url();?>send-attendee-notification/'+attendee_id,
                cache:false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(data){
                    
                    if(data.result == "success")
                    {
                       
                       alert('Successfully sent message to the attendee');

                    }
                    else
                    {
                        alert('Could not send the mail');
                    }
                },
                error: function(xhr, status, error) {
                    alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
                }
            });
            
            return false;
        });
        //Add to cart

         //Add to cart
        $(document).on("click","a.send_mass_attendees_mail",function()
        {
            var meeting_id = $(this).attr('meeting_id');
          
            $.ajax({
                type:'POST',
                url: '<?php echo site_url();?>send-attendee-mass-notification/'+meeting_id,
                cache:false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(data){
                    
                    if(data.result == "success")
                    {
                       
                       alert('Successfully send the mass mail');

                    }
                    else
                    {
                        alert('Could send the mails. Please check the configurations');
                    }
                },
                error: function(xhr, status, error) {
                    alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
                }
            });
            
            return false;
        });

        
    </script>