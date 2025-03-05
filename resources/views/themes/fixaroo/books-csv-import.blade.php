<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Styles -->
        <style>

            .file-upload input[type='file'] {
              display: none;
            }

            body {
              background: #743d9e;
              background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);
              background: linear-gradient(to right, #743d9e, #be26ff);
              height: 100vh;
            }

            .rounded-lg {
              border-radius: 1rem;
            }

            .custom-file-label.rounded-pill {
              border-radius: 50rem;
            }

            .custom-file-label.rounded-pill::after {
              border-radius: 0 50rem 50rem 0;
            }

            .btn-primary{
                background-color: #ba27fa;
                border-color: #ae2bea;
                padding: 5px 40px;
                text-transform: uppercase;
            }

            .btn-primary:hover {
              background-color: #7a00af;
              border-color: #7a00af;
            }

            .btn-primary:focus, .btn-primary:active {
              box-shadow: 0 0 0 0.2rem rgba(184, 40, 247, 0.41) !important;
              background-color: #ba27fa !important;
              border-color: #ae2bea !important;
            }
            a {
              text-decoration: underline;
            }

        </style>
    </head>
    <body>
      <section>
        <div class="container p-5">
          <div class="row mb-5 text-center text-white">
            <div class="col-lg-10 mx-auto">
              <h1 class="display-4">File Upload </h1>
              <p class="lead">Use for below to upload new books using a csv document.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-5 mx-auto">
              <div class="p-5 bg-white shadow rounded-lg">
                <img src="{{ url('img/upload-to-cloud.png') }}" alt="" width="64px" class="d-block mx-auto mb-4 rounded-pill">
                <h6 class="text-center mb-5 text-muted">
                  You can start the process by selecting a file.
                </h6>
                <form class="" action="{{ url("books/import") }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">

                    @if ($errors->has('file'))
                      <div class="alert alert-danger alert-dismissible fade show help-block text-center" role="alert">
                        {{ $errors->first('file') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    <!-- @if ($importQueueItems > 0)
                        <p class="text-center mb-5 text-muted">
                          Books left to import: {{ $importQueueItems }}
                        </p>
                    @endif -->
                    <p class="text-center mb-5 text-muted">
                      {{ session('status') }}
                    </p>

                    <div class="custom-file overflow-hidden rounded-pill mb-5">
                      <input id="file" name="file" type="file" class="custom-file-input rounded-pill" onchange="updateLabel(this)">
                      <label for="file" class="custom-file-label rounded-pill" id="custom-upload-label">Choose file</label>
                    </div>
                    <div class="overflow-hidden text-center">
                      <button type="submit" id="sub" name="button" class="rounded-pill btn btn-primary js-custom-btn-hidden">Submit</button>
                    </div>
                  </div>

                </form>
                <p class="mt-5 pt-5 text-muted mb-0 text-center">
                  <small>Made with <i class="fa fa-heart"></i> and 47 <i class="fa fa-coffee"></i> in <a href="https://en.wikipedia.org/wiki/KwaBhaca" target="_blank" class="text-muted">KwaBhaca, South Africa</a></small>
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="modal fade" id="customModel" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Import Upload</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>{{ session('status') }}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js">

    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js">

    </script>

    <script type="text/javascript">

      function updateLabel(input){
        var file = input.files[0];

        if (file) {
            document.getElementById('custom-upload-label').innerHTML = file.name;
        }
      }

      $(document).ready(() => {
        $("#sub").on('click', (e) => {
          // e.preventDefault();
          // $("#customModel").modal('show');
        });

        // if ($('form.submited')) {
        //   $("#customModel").modal('show');
        // }

      });
    </script>
</html>
