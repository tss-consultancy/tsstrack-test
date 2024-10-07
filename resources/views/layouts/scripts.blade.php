<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script>
      $(document).ready(function (){
        $('#myTable').DataTable({
          lengthChange:false,
        });
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
          placeholder: "Select a members",
    allowClear: true

        });
    });
    $(document).ready(function() {
        $('.js-example-basic-multiple1').select2({
          placeholder: "Select a committees",
    allowClear: true

        });
    });
    </script>
    
<script>
  (function () {
  /* ========= Preloader ======== */
  const preloader = document.querySelectorAll('#preloader')

  window.addEventListener('load', function () {
    if (preloader.length) {
      this.document.getElementById('preloader').style.display = 'none'
    }
  })

  /* ========= Add Box Shadow in Header on Scroll ======== */
  window.addEventListener('scroll', function () {
    const header = document.querySelector('.header')
    if (window.scrollY > 0) {
      header.style.boxShadow = '0px 0px 30px 0px rgba(200, 208, 216, 0.30)'
    } else {
      header.style.boxShadow = 'none'
    }
  })

  /* ========= sidebar toggle ======== */
  const sidebarNavWrapper = document.querySelector(".sidebar-nav-wrapper");
  const mainWrapper = document.querySelector(".main-wrapper");
  const menuToggleButton = document.querySelector("#menu-toggle");
  const menuToggleButtonIcon = document.querySelector("#menu-toggle i");
  const overlay = document.querySelector(".overlay");

  menuToggleButton.addEventListener("click", () => {
    sidebarNavWrapper.classList.toggle("active");
    overlay.classList.add("active");
    mainWrapper.classList.toggle("active");

    if (document.body.clientWidth > 1200) {
      if (menuToggleButtonIcon.classList.contains("lni-chevron-left")) {
        menuToggleButtonIcon.classList.remove("lni-chevron-left");
        menuToggleButtonIcon.classList.add("lni-menu");
      } else {
        menuToggleButtonIcon.classList.remove("lni-menu");
        menuToggleButtonIcon.classList.add("lni-chevron-left");
      }
    } else {
      if (menuToggleButtonIcon.classList.contains("lni-chevron-left")) {
        menuToggleButtonIcon.classList.remove("lni-chevron-left");
        menuToggleButtonIcon.classList.add("lni-menu");
      }
    }
  });
  overlay.addEventListener("click", () => {
    sidebarNavWrapper.classList.remove("active");
    overlay.classList.remove("active");
    mainWrapper.classList.remove("active");
  });
})();
var submitbtns = document.getElementsByClassName("submitbtn");
var alerts = document.getElementsByClassName("alert");
if (submitbtns.length > 0 && alerts.length > 0) {
    var submitbtn = submitbtns[0];
    var alert = alerts[0];
    submitbtn.addEventListener("click", () => {
        console.log("clicked");
        alert.classList.add("alert-display");
        alert.classList.remove("alert-hide");
    });
}


</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>

 
    $('#committees').on('change', function() {
    var committee_id = $(this).val();

    if (committee_id) {
        var url = '{{ route("getMembers", ":id") }}';
        url = url.replace(':id', committee_id);
        
        $.ajax({
          
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#members').empty();
                
                $('#members').append('<option value="">Select Member</option>');
                $.each(data, function(key, member) {
                    $('#members').append('<option selected value="' + member.member_id + '">' + member.member_name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    } else {
        $('#members').empty();
        $('#members').append('<option value="">Select Member</option>');
    }
});

</script>
<script src="sweetalert2.min.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
        $('#fd-table').DataTable({
            lengthChange: false,
            dom: 'Bfrtip', 
            buttons: [
                'excel', 
                'pdf'
            ]
        });
    });
</script>