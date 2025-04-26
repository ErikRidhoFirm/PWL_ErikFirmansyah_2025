{{-- Jobsheet 7 Tugas No.4 --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Registrasi Pengguna</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

  <style>
    body {
      background: linear-gradient(135deg, #89f7fe, #66a6ff);
      font-family: 'Poppins', sans-serif;
    }

    .login-box {
      max-width: 480px;
      margin: 60px auto;
    }

    .card {
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      background-color: transparent;
      border-bottom: none;
    }

    .form-control {
      border-radius: 12px;
    }

    .btn-primary {
      border-radius: 12px;
      background-color: #5c6bc0;
      border: none;
    }

    .btn-primary:hover {
      background-color: #3f51b5;
    }

    .input-group-text {
      background: #f0f0f0;
      border-radius: 12px 0 0 12px;
    }

    .text-link {
      text-align: center;
      margin-top: 1rem;
    }

    .text-link a {
      color: #3f51b5;
      text-decoration: none;
      font-weight: 500;
    }

    .text-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="{{ url('/') }}" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Registrasi Pengguna Baru</p>

        <form action="{{ route('register') }}" method="post" id="form-register">
          @csrf

          <!-- Username -->
          <div class="input-group mb-3">
            <input type="text" id="username" name="username" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text"><i class="fas fa-envelope"></i></div>
            </div>
            <small id="error-username" class="error-text text-danger"></small>
          </div>

          <!-- Nama Lengkap -->
          <div class="input-group mb-3">
            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap">
            <div class="input-group-append">
              <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            <small id="error-nama" class="error-text text-danger"></small>
          </div>

          <!-- Password -->
          <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <small id="error-password" class="error-text text-danger"></small>
          </div>

          <!-- Konfirmasi Password -->
          <div class="input-group mb-3">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
              placeholder="Konfirmasi Password">
            <div class="input-group-append">
              <div class="input-group-text"><i class="fas fa-key"></i></div>
            </div>
            <small id="error-password_confirmation" class="error-text text-danger"></small>
          </div>

          <div class="row">
            <div class="col-8 text-link">
              <p><a href="{{ route('login') }}">Sudah punya akun?</a></p>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

  <script>
    $(document).ready(function () {
      $("#form-register").validate({
        rules: {
          level_id: { required: true },
          username: { required: true, minlength: 3, maxlength: 20 },
          nama: { required: true, minlength: 3, maxlength: 100 },
          password: { required: true, minlength: 5, maxlength: 20 },
          password_confirmation: { required: true, equalTo: '[name="password"]' },
        },
        messages: {
          level_id: "Pilih level akun Anda",
          username: {
            required: "Username tidak boleh kosong!",
            minlength: "Minimal 3 karakter!",
            maxlength: "Maksimal 20 karakter!"
          },
          nama: {
            required: "Nama tidak boleh kosong!",
            minlength: "Minimal 3 karakter!",
            maxlength: "Maksimal 100 karakter!"
          },
          password: {
            required: "Password tidak boleh kosong!",
            minlength: "Minimal 5 karakter!",
            maxlength: "Maksimal 20 karakter!"
          },
          password_confirmation: {
            required: "Konfirmasi tidak boleh kosong!",
            equalTo: "Password dan konfirmasi harus sama!"
          },
        },
        submitHandler: function (form) {
          $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function (response) {
              if (response.status) {
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil',
                  text: response.message,
                }).then(function () {
                  window.location = response.redirect;
                });
              } else {
                $('.error-text').text('');
                $.each(response.msgField, function (prefix, val) {
                  $('#error-' + prefix).text(val[0]);
                });
                Swal.fire({
                  icon: 'error',
                  title: 'Terjadi Kesalahan',
                  text: response.message
                });
              }
            }
          });
          return false;
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.input-group').append(error);
        },
        highlight: function (element) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>
</body>

</html>
