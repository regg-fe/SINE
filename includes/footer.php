<script src="jquery/jquery.min.js"></script>
    
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
	<p>Ingeniera de Sistemas &copy;2020</p>
	<p>Version 0.1</p>
</footer>
	</body>
</html>