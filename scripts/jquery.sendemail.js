jQuery(document).ready(function () {
$("#contact_form").submit(function() {
   var email = $("#contactEmail").val(); // get email field value
   var name = $("#contactName").val(); // get name field value
   var subject = $("#contactSubject").val(); //get subject field value
   var msg = $("#msg").val(); // get message field value
     $.ajax({
       type: "POST",
       url: "https://mandrillapp.com/api/1.0/messages/send.json",
       data: {
         'key': '2oePE4AGdCw4T9ZK_SdIYw',
         'message': {
           'from_email': email,
           'from_name': name,
           'headers': {
             'Reply-To': email
           },
           'subject': subject,
           'text': msg,
           'to': [
           {
             'email': 'duldavis@gmail',
             'name': 'Dustin Davis',
             'type': 'to'
           }]
         }
       },
       success: function(data){
         $('#message-success').text('Email Sent Successfully!');
         console.log('Your message has been sent. Thank you!')
         $("#contactName").val('');
         $("#contactEmail").val('');
         $("#contactSubject").val('');
         $("#contactMessage").val('');
       },
       error: function(data) {
         $('#message-warning').text("You're message has not been sent.");
         console.log('Error sending massage.')
       }
     })
   return false; // prevent page refresh
 });
});