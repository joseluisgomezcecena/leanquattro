</main>
</body>

<script src="<?php echo base_url(); ?>assets/js/vendors.min.js"></script>
<script>
    //on page load focus on the search input with id scan.
    document.getElementById('scan').focus();
</script>

<script>
    $(document).ready(function() {
        // Get the current hour
        var currentHour = new Date().getHours();
        var singleNumber = currentHour < 10 ? "0" + currentHour : currentHour;

        // Scroll to the row with the current hour
        var row = document.getElementById("id_" + singleNumber);
        row.scrollIntoView({behavior: "smooth", block: "center", inline: "nearest"});

        // Change the text color of the row with the current hour
        $(row).css("color", "#06cf0d");
    });
</script>

<script>
//make the alert fade out after 3 seconds.
setTimeout(function() {
    $('#error-alert').fadeOut('slow');
}, 5000); // <-- time in milliseconds

//make the alert fade out if clicked.
$('#error-alert').click(function() {
    $(this).fadeOut('slow');
});

</script>

</html>