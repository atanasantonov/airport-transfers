jQuery(document).ready(function($) {
    var prefix = '#ns-airport-transfer-form ';

    // load datepicker
    if((prefix+".date").length > 0 ){
      $(prefix+".date" ).datepicker();
    }

    $(prefix+'#transfer_type').on('change', function(){
      let val= $(prefix+'#transfer_type option:selected').val();
      if(val==='from_airport') {
        $(prefix+"#arrival").css('display','block');
        $(prefix+"#departure").css('display','none');
      } else if(val==='to_airport') {
        $(prefix+"#arrival").css('display','none');
        $(prefix+"#departure").css('display','block');
      } else {
        $(prefix+"#arrival").css('display','block');
        $(prefix+"#departure").css('display','block');
      }
    });


    $(prefix+'#submit').on('click', function(){
      if(!nsAirportTransfersValidate(prefix+'#name', nsAirportTransfers.texts.yourName )) {
        return;
      }

      if(!nsAirportTransfersValidate(prefix+'#email',nsAirportTransfers.texts.emailAddress)) {
        return;
      }

      if(!nsAirportTransfersValidate(prefix+'#phone',nsAirportTransfers.texts.mobile)) {
        return;
      }

      $('body').last('div').after('<div id="loading" class="loading"></div>');

      $.post( nsAirportTransfers.adminUrl, {

        // form data
        action: 'send',
        resort: $(prefix+"#resort").val(),
        time_format: $(prefix+"#time_format").val(),

        // personal data
        name: $(prefix+"#name").val(),
        email: $(prefix+"#email").val(),
        phone: $(prefix+"#phone").val(),
        like_to: $(prefix+'input[name=like_to]:checked').val(),
        transfer_type: $(prefix+"#transfer_type option:selected").val(),
        adults: $(prefix+"#adults").val(),
        children: $(prefix+"#children").val(),
        koffers: $(prefix+"#koffers").val(),
        ski: ($(prefix+"#ski").length>0) ? $("#ski").val() : '',

        // arrival data
        arrival_date: $(prefix+"#arrival_date").val(),
        arrival_hour: $(prefix+"#arrival_hour option:selected").val(),
        arrival_minutes: $(prefix+"#arrival_minutes option:selected").val(),
        arrival_us_time: ($(prefix+"#arrival_us_time").length>0) ? $("#arrival_us_time option:selected").val() : '',
        arrival_airport: $(prefix+"#arrival_airport option:selected").val(),
        arrival_flight: $(prefix+"#arrival_flight").val(),

        // departure data
        out_date: $(prefix+"#out_date").val(),
        out_hour: $(prefix+"#out_hour option:selected").val(),
        out_minutes: $(prefix+"#out_minutes option:selected").val(),
        out_us_time: ($(prefix+"#out_us_time").length>0) ? $("#out_us_time option:selected").val() : '',
        out_airport: $(prefix+"#out_airport option:selected").val(),
        out_flight: $(prefix+"#out_flight").val(),

        // address and instructions
        adress: $(prefix+"#adress").val(),
        instructions: $(prefix+"#instructions").val()
      }).done(function(data) {
        let response = $.parseJSON(data);
        if(response.status==='error') {
          $('#modal-error-message').text(response.data);
          $('#modal-error').modal();
          return;
        }

        $('html, body').animate({
          scrollTop: $("#ns-airport-transfer-form").offset().top
        }, 500);

        setTimeout(function(){
            $("#ns-airport-transfer-form").empty();
            $("#ns-airport-transfer-form").html('<h3 class="text-success">'+response.data+'</h3>');
        },500);
      }).fail(function() {
        $('#modal-error-message').text(nsAirportTransfers.texts.SystemError);
        $('#modal-error').modal();
      })
      .always(function() {
        $("#loading").remove();
      })
    });
});

function nsAirportTransfersValidate(el,message) {
  var $ = jQuery;
  if($(el).val()==='') {
    $('html, body').animate({
      scrollTop: $(el).offset().top - 100
    }, 500);
    $('#modal-error-message').text( nsAirportTransfers.texts.MandatoryField + ': ' + message );
    $('#modal-error').modal();
    return false;
  }
  return true;
}
