<?php
  // TRACKING_ID
  $TRACKING_ID = "'G-NGWKC9V59J";
?>
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $TRACKING_ID; ?>"></script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', "<?php echo $TRACKING_ID; ?>");
</script>