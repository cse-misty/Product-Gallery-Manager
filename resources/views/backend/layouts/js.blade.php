<!-- General JS Scripts -->
<script src="{{asset('backend')}}/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="{{asset('backend')}}/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('backend')}}/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="{{asset('backend')}}/js/scripts.js"></script>
  <!-- Custom JS File -->

  <!-- JS Libraies -->
  <script src="{{asset('backend')}}/bundles/datatables/datatables.min.js"></script>
  <script src="{{asset('backend')}}/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('backend')}}/js/page/datatables.js"></script>
  <!-- Custom JS File -->
  <script src="{{asset('backend')}}/js/custom.js"></script>

  <script src="{{asset('backend')}}/bundles/select2/dist/js/select2.full.min.js"></script>

  <!-- JS Libraies -->
  <script src="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.js"></script>
  <script src="{{asset('backend')}}/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>

  <script src="{{asset('backend')}}/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('backend')}}/js/page/create-post.js"></script>
  <!-- Custom JS File -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editor = new Jodit('#details1', {
                height: 500,
                uploader: {
                    insertImageAsBase64URI: true
                },
            });
        });
    </script>
