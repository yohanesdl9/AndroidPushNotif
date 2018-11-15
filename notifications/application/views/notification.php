<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme.css" type="text/css"> 
  <script src="<?php echo base_url() ?>assets/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url() ?>assets/popper.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bootstrap.min.js"></script>  
</head>

<body>
  <div class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="">Send Firebase Push Notifications</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <form action="<?php echo base_url() ?>index.php/notifications/send" method="post">
            <div class="form-group">
              <label for="send_to">Send To</label>
              <select class="custom-control custom-select" id="send_to" name="send_to">
                <option value="single">Single Device</option>
                <option value="topic">Topic</option>
              </select>
            </div>
            <div class="form-group">
              <label for="firebase_api">Firebase Server API Key</label>
              <input type="text" class="form-control" id="firebase_api" placeholder="Enter Firebase Server API Key" name="firebase_api"> </div>
            <div class="form-group">
              <label for="firebase_token">Firebase Token</label>
              <input type="text" class="form-control" id="firebase_token" placeholder="Enter Firebase Token" name="firebase_token"> </div>
            <div class="form-group" style="display: none;" id="topic_group">
              <label for="topic">Topic</label>
              <input type="text" class="form-control" id="topic" placeholder="Enter Topic Name" name="topic"> </div>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" placeholder="Enter Notification Title" name="title"> </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea class="form-control" id="message" rows="3" name="message" placeholder="Enter Notification Message"></textarea>
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="include_image" name="include_image">
                <label class="custom-control-label" for="include_image">Include Image</label>
              </div>
            </div>
            <div class="form-group" style="display: none;" id="image_url_group">
              <label for="image_url">Enter Image URL</label>
              <input type="url" class="form-control" id="topic" placeholder="Enter Image URL" name="image_url"> </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="include_action" name="include_action">
                <label class="custom-control-label" for="include_action">Include Action</label>
              </div>
            </div>
            <div class="form-group" style="display: none;" id="action_group">
              <label for="exampleInputEmail1">Action :</label>
              <select class="custom-control custom-select" id="action" name="action">
                <option value="url">Open URL</option>
                <option value="activity">Open Activity</option>
              </select>
            </div>
            <div class="form-group" style="display: none;" id="action_destination_group">
              <label for="exampleInputEmail1">Action Destination</label>
              <input type="text" class="form-control" id="action_destination" placeholder="Enter Destination URL or Activity Name" name="action_destination"> </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $('#include_image').change(function(e){
		if($(this).prop("checked")==true){
			$('#image_url_group').show();
			$("#image_url").prop('required',true);
		}else{
			$('#image_url_group').hide();
			$("#image_url").prop('required',false);
		}
	});
	$('#include_action').change(function(e){
		if($(this).prop("checked")==true){
			$('#action_group').show();
			$('#action_destination_group').show();
			$("#action_destination").prop('required',true);
		}else{
			$('#action_group').hide();
			$('#action_destination_group').hide();
			$("#action_destination").prop('required',false);
		}
	});	
	$('#send_to').change(function(e){
		var selectedVal = $("#send_to option:selected").val();
		if(selectedVal=='topic'){
			$('#topic_group').show();
			$("#topic").prop('required',true);
			$('#firebase_token_group').hide();
			$("#firebase_token").prop('required',false);
		}else{
			$('#topic_group').hide();
			$("#topic").prop('required',false);
			$('#firebase_token_group').show();
			$("#firebase_token").prop('required',true);
		}
	});
  </script>
</body>

</html>