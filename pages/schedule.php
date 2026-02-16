<?php
$doctor_id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Select Slot</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container py-5">
    <div class="card p-4 shadow">
      <h2 class="mb-4 text-center">Select Appointment Slot</h2>
      <div class="mb-4">
        <label for="date" class="form-label">Select Date:</label>
        <input type="date" id="date" class="form-control w-25">
      </div>

      <h5>Available Slots:</h5>
      <div class="d-flex flex-wrap gap-2" id="slots">
        <p id="error"></p>
      </div>

      <a href="./book" class="btn btn-primary mt-3">Book Selected Slot</a>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script>
    $(document).ready(function () {
      let doctor_id = <?php echo $doctor_id; ?>;

      $('#date').change(function () {
        let date = $('#date').val();
        if (!date) return;

        $.ajax({
          url: './server',
          type: 'POST',
          data: { date: date, doctor_id: doctor_id },
          success: function (response) {
            let slots = $.parseJSON(response);

            let container = $('#slots');
            container.html('');  
            $('#error').text('');
            if ($.isEmptyObject(slots)) {
              $('#error').text('Doctor is not available on this date');
            } else {
              slots.forEach(function (time) {
                container.append(`<button type="button" class="btn btn-success btn-sm">${time}</button>`);
              });
            }
          }

        });
      });
      let selectedSlot = '';
      $(document).on("click", "#slots .btn", function () {
        $("#slots .btn").removeClass("active");
        $(this).addClass("active");
        selectedSlot = $(this).text();
        //console.log(selectedSlot);

      });
      $('.btn-primary').click(function (e) {
        e.preventDefault();

        let date = $('#date').val();

        if (selectedSlot == '') {
          alert('please select the slot');
          //console.log(selectedSlot);

        } else {
          window.location.href = 'book?slot=' + encodeURIComponent(selectedSlot) + '&id=' + doctor_id + '&date=' + date;
          //console.log(typeof selectedSlot);

        }
      });
    });
  </script>
</body>

</html>