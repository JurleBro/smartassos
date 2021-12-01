<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Codeigniter 4 File Upload - positronx.io</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 500px;
    }
  </style>
</head>

<body>
  <div class="container mt-5">

    <form method="post" action="javascript:uploadFile();" enctype="multipart/form-data">
      <div class="form-group">
        <input id="file" type="file" name="file" class="form-control">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-danger">Upload</button>
      </div>
    </form>

      <ul id="uploadFile">
          <?php if (! empty($files) && is_array($files)): ?>

              <?php foreach ($files as $file): ?>

                  <li><a href="<?php echo base_url('file/'. esc($file['name']));?>" ><?= esc($file['name']) ?></a></li>

              <?php endforeach; ?>

          <?php else: ?>

              <h3>No files</h3>

              <p>Unable to find any files for you.</p>

          <?php endif ?>
      </ul>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</html>
<script>
    function uploadFile() {
        var url = '<?php echo base_url('FileUpload/upload_ajax');?>';
        var file = $('#file')[0].files;
        var url_file = "<?php echo base_url('file/');?>/"+file[0].name;

        var fd = new FormData();
        fd.append('file', file[0]);

        $.ajax({
            url: url,
            type: 'POST',
            data: fd,
              contentType: false,
              processData: false,
            success: function (data) {
                   if(data == 1) {
                       $("#uploadFile").append('<li><a href='+url_file+'> '+file[0].name+'</a></li>');
                   } else {
                       alert('Error ! File not uploaded');
                   }
            }
        });
    }
</script>
