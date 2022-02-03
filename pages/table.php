
<?php
  include 'config.php';
  include 'resources.php';
?>

<html lang="en">
<body>


<div class="jumbotron text-center">
</div>
  
<div class="container">
  <div class="row">
    <div class="col-sm-2">
    </div>

    <div class="col-sm-8">

      <?php
      $query = 'SELECT * FROM customerdata';
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $result = $stmt->get_result();
      ?>  



    <table id="data-table" class="table table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row["firstName"]; ?></td>
          <td><?php echo $row["lastName"]; ?></td>
          <td><?php echo $row["phoneNumber"]; ?></td>
          <td><?php echo $row["email"]; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
  $('#data-table').DataTable({
    paging: true
  });
});
</script>



</body>
</html>