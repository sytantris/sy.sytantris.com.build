$(function () {
  var form = $('#contact-form');

  $('#contact-submit').on('click', function (e) {
    event.preventDefault();
    var formData = $(form).serialize();

    $.ajax({
      type: 'POST',
      url: $(form).attr('action'),
      data: formData
    })
    .done(function (response) {
      $('#form-error').slideUp(100);
      $('#form-success').slideDown(400);
      $('#form-success').text(response);

      $('#contact-name, #contact-email, #contact-message').val('');
    })
    .fail(function (data) {
      $('#form-success').slideUp(100);
      $('#form-error').slideDown(400);
      $('#form-error').text('Oops! An error occured. Please try again.');

      if (data.responseText !== '') {
        $('#form-success').text(data.responseText);
      } else {
        $('#form-error').text('Oops! An error occured and your message could not be sent.');
      }
    });
  });
});
