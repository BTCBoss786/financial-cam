    <script type="text/javascript" src="core/jquery/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="core/bootstrap/js/bootstrap.min.js"></script>
    <?php
      if (isset($customJs))
        foreach ($customJs as $jsFile)
          echo '<script type="module" src="'.$jsFile.'"></script>';
    ?>
  </body>
</html>
