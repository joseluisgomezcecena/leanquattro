</body>
</html>
<script src="<?php echo base_url(); ?>assets/js/vendors.min.js"></script>
<script>
setTimeout(function() {
    $('#toast').fadeOut('slow');
}, 3100);

//make the alert fade out if clicked.
$('#toast').click(function() {
    $(this).fadeOut('slow');
});
</script>