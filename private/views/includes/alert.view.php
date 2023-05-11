<script type="text/javascript">
  <?php
    if(isset($_SESSION['message']) && $_SESSION['message'] != ""){ 
    ?>
    swal({
        text: "<?php echo $_SESSION['message'];?>",
        icon: "<?php echo $_SESSION['message_type']; ?>",
        button: "OK",
    });
    <?php
    }
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
  ?>
</script>