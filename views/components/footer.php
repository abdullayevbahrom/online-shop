<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" crossorigin="anonymous"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script type="text/javascript">
  let productTable = new DataTable('#productTable');
  let categoryTable = new DataTable('#categoryTable');
  let brandTable = new DataTable('#brandTable');
</script>
<script type="text/javascript">
  $("#category_message").hide();

  function delayMessage() {
    $("#category_message").hide();
  }

  function sendAvailableCategory(data) {
    let flag = $(data).prop('checked');
    let category_id = parseInt($(data).attr('id'));
    let category_status;

    if (!flag && confirm("When disabled all sub-categories and product in this category will be hidden")) {
      category_status = 0;
    } else {
      category_status = 1;
    }

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/categories/action/available",
      data: {
        category_id: category_id,
        category_status: category_status
      },
      success: function(response) {
        if (response.status == "success") {
          $("#category_message").show();
          setTimeout(delayMessage, 1000);
        }
      }
    });
  }
</script>
<script type="text/javascript">
  $("#brand_message").hide();

  function delayMessage() {
    $("#brand_message").hide();
  }

  function sendAvailableBrand(data) {
    let flag = $(data).prop('checked');
    let brand_id = parseInt($(data).attr('id'));
    let brand_status;

    if (!flag && confirm("When disabled all sub-categories and product in this category will be hidden")) {
      brand_status = 0;
    } else {
      brand_status = 1;
    }

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/brands/action/available",
      data: {
        brand_id: brand_id,
        brand_status: brand_status
      },
      success: function(response) {
        if (response.status == "success") {
          $("#brand_message").show();
          setTimeout(delayMessage, 1000);
        }
      }
    });
  }
</script>
<script type="text/javascript">
  $("#product_message").hide();

  function delayMessageProduct() {
    $("#product_message").hide();
  }

  function sendAvailableProduct(data) {
    let flag = $(data).prop('checked');
    let product_id = parseInt($(data).attr('id'));
    let product_status;

    if (!flag && confirm("When disabled all sub-categories and product in this category will be hidden")) {
      product_status = 0;
    } else {
      product_status = 1;
    }

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/products/action/available",
      data: {
        product_id: product_id,
        product_status: product_status
      },
      success: function(response) {
        if (response.status == "success") {
          $("#product_message").show();
          setTimeout(delayMessageProduct, 1000);
        }
      }
    });
  }
</script>
<script type="text/javascript">
  const imageInput = document.getElementById('imageInput');
  const previewImage = document.getElementById('previewImage');

  function previewSelectedImage() {
    const file = imageInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = function(e) {
        previewImage.src = e.target.result;
      }
    }
  }
  imageInput.addEventListener('change', previewSelectedImage);
</script>
<script type="text/javascript">
  function changeColor(data) {
    let product_id = parseInt($(data).attr('data-id'));

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/orders/action/add",
      data: {
        product_id: product_id,
      },
      success: function(response) {
        if (response.status == "success") {
          $("#product_message").show();
          setTimeout(delayMessageProduct, 1000);
        }
      }
    });
  }
</script>
</body>

</html>