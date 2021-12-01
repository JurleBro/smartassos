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
    <?php if (! empty($files) && is_array($files)): ?>

        <?php foreach ($files as $file): ?>

            <a href="<?php echo base_url('file/'. esc($file['name']));?>" ><?= esc($file['name']) ?></a>

        <?php endforeach; ?>

    <?php else: ?>

        <h3>No files</h3>

        <p>Unable to find any files for you.</p>

    <?php endif ?>

    <form method="post" action="<?php echo base_url('FileUpload/upload');?>" enctype="multipart/form-data">
      <div class="form-group">
        <label>Avatar</label>
        <input type="file" name="file" class="form-control">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-danger">Upload</button>
      </div>
    </form>

  </div>
</body>

</html>
