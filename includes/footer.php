<?php include("info.php") ?>
<script src="js/jquery.min.js"></script>
    
    <script>
      $(document).ready(function(){
        $('.btn').click(function(){
          $('.items').toggleClass("show");
          $('.navbar').toggleClass("show");
          $('.list').toggleClass("show");
          $('header a').toggleClass("hide");
        });
      });
    </script>
<footer>
	<p>Ingeniería de Sistemas &copy;2020</p>
	<p><?php echo $version; ?></p>
</footer>
	</body>
</html>