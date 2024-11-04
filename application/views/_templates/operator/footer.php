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
        $(row).css("color", "#4407eb");
        $(row).css("font-weight", "800");
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

setTimeout(function() {
    $('#toast').fadeOut('slow');
}, 2100); 

</script>

<script>
$(document).ready(function() {
    $('#plant_id').change(function() {
        var plant_id = $(this).val();

        $.ajax({
            url: '<?php echo base_url("ProductionLines/get_lines_by_plant_id"); ?>',
            type: 'POST',
            data: { plant_id: plant_id },
            dataType: 'json',
            success: function(data) {
                $('#line_id').empty();
                $.each(data, function(index, value) {
                    $('#line_id').append('<option value="' + value.line_id + '">' + value.line_name + '</option>');
                });
            }
        });
    });

    // If line_id changes, load the workstations.
    $('#line_id').change(function() {
        var line_ids = $(this).val(); // Get selected line IDs

        $.ajax({
            url: '<?php echo base_url("Workstations/get_workstations_by_line_id"); ?>',
            type: 'POST',
            data: { line_ids: line_ids },
            dataType: 'json',
            success: function(data) {
                $('#work_station_id').empty();
                $.each(data, function(index, value) {
                    $('#work_station_id').append('<option value="' + value.work_station_id + '">' + value.work_station_name + '</option>');
                });
            }
        });
    });
});
</script>

</html>