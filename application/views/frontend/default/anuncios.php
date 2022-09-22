
  <style>
      .arregloscroll {
          border: solid;
           height: 548px;
            overflow: auto;
            scrollbar-width: thin;
            scrollbar-color: #debfff #b0ffff;
        }
  </style>
  <div class="col-md-4 arregloscroll" style="background-color:blueviolet; border-radius: 13px;">
    <?php foreach ($announceActive as $key => $value) { ?>
      <br>
      <p>
        <?php echo $value->title; ?><br><br>
      </p>
      <p>
        <?php echo $value->html; ?>
      </p>
      <hr>
    <?php } ?>
  </div>