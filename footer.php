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

    $("textarea").keypress(function (e) {
        if(e.which == 13) {
          if($.trim($(this).val())) {
            $("#chatbox").append($(this).val() + "<br/>");
            $(this).val("");
            e.preventDefault();
          }
        }
    });
  });

</script>
