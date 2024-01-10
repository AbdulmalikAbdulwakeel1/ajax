<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Bundles</title>
    <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="network nt">
    <h4>Network:</h4>
    <select class="box" name="network" id="network" required>
        <option selected value="">Select Network Type</option>
        <option value="1">MTN</option>
        <option value="2">Glo</option>
        <option value="3">Airtel</option>
        <option value="6">9Mobile</option>
    </select>
</div>

<div class="network nt">
    <h4>Data Bundle:</h4>
    <select class="box" name="data_type" id="data_type">
        <!-- Options will be dynamically populated using jQuery -->
    </select>
</div>

<div class="network nt">
    <h4>Amount:</h4>
    <div class="box" style="cursor: not-allowed;">
        <input type="text" name="price" id="amount" disabled>
    </div>
</div>

<script>
    // When the network selection changes
    $(document).on('change', '#network', function() {
        var networkId = $(this).val();
        // Make an AJAX request to fetch data bundles for the selected network
        $.ajax({
            url: 'fetch_data_bundles.php',
            method: 'POST',
            data: { networkId: networkId },
            success: function(response) {
                // Populate the data bundles dropdown with the fetched options
                $('#data_type').html(response);

                // Trigger the change event to update the amount input
                $('#data_type').trigger('change');
            }
        });
    });

    // When the data bundle selection changes
    $(document).on('change', '#data_type', function() {
        // Fetch the selected data bundle's amount and update the amount input
        var amount = $('option:selected', this).attr('data-amount');
        $('#amount').val(amount);
    });
</script>

</body>
</html>
