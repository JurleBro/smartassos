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
    <form method="post" action="javascript:submitMsg();" enctype="multipart/form-data">
        <div class="form-group">
            <input id="pseudo" type="text" name="pseudo" placeholder="Pseudo" class="form-control">
        </div>
        <div class="form-group">
            <input id="msg" type="text" name="message" placeholder="Message" class="form-control">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
        <ul id="liste_messages">
            <?php if (! empty($messages) && is_array($messages)): ?>

                <?php foreach ($messages as $message): ?>

                    <li><?= esc($message['pseudo']) ?> : <?= esc($message['msg']) ?></li>

                <?php endforeach; ?>

            <?php endif ?>
        </ul>
    </form>

</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</html>
<script>

    let submitMsg = () => {
        let msg = $("#msg").val();
        let pseudo = $("#pseudo").val()
        let url = '<?php echo base_url('ChatController/saveChat');?>'+'/'+pseudo+'/'+msg;
        $.ajax(url, () => {});
        sendMsg(msg);
        $("#msg").val("");
    }

    var conn = new WebSocket('ws://localhost:8081');
    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        addMessage(e.data);
    };

    let addMessage = (msg) => {
        $("#liste_messages").append("<li>"+msg+"</li>");
    }

    let sendMsg = msg => {
        addMessage("You : " + msg);
        conn.send($("#pseudo").val() +" : "+msg);
    }
</script>
