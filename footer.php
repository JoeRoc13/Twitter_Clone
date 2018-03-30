  <footer>
    <p>&copy; <?php echo date("Y"); ?> {SiteName}, Inc.</p>
  </footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Bootstrap Validator -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<!-- Autosize -->
<script src="assets/js/autosize.min.js" type="text/javascript">

</script>


</body>

<script>

  $(document).ready(function(){
    autosize($('textarea'));

    $('#twittBody').keydown(function(e){
      if (e.keyCode == 13 && !e.shiftKey) {
        if($('#twittBody').val().trim() != ""){
          e.preventDefault();
          $('#formTwitt').submit();
        }
      }
    });

    // $(document).on('keydown', '.commentBody', function(e){
    //   if (e.keyCode == 13 && !e.shiftKey) {
    //     if($('.commentBody').val().trim() != ""){
    //       e.preventDefault();
    //       $(this).parent()[0].submit();
    //     }
    //   }
    // });

     $(".commentBody").keydown(function(e){
       if (e.keyCode == 13 && !e.shiftKey) {
           if($(this).val().trim() != ""){
             e.preventDefault();
             $(this).parent()[0].submit();
           }
         }
     });

  });

</script>
