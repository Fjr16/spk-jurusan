
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login | SPK - Sistem Pendukung Keputusan</title>
    @include('layouts.partials.style')
</head>
<body>
    <div class="container-xxl flex-grow-1 container-p-y">
        <form action="" method="POST">
            @csrf
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center h-px-500">
                <form class="w-px-400 border rounded p-3 p-md-5">
                    <h3 class="mb-6">Sign In</h3>

                    <div class="form-floating form-floating-outline mb-6">
                    <input type="text" id="form-alignment-username" name="username" class="form-control" placeholder="Username">
                    <label for="form-alignment-username">Username</label>
                    </div>

                    <div class="mb-6 form-password-toggle">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                        <input type="password" id="form-alignment-password" name="password" class="form-control" placeholder="············" aria-describedby="form-alignment-password2">
                        <label for="form-alignment-password">Password</label>
                        </div>
                        <span class="input-group-text cursor-pointer" id="form-alignment-password2"><i class="icon-base ri ri-eye-off-line"></i></span>
                    </div>
                    </div>
                    <div class="mb-4">
                    <label class="form-check m-0">
                        <input type="checkbox" class="form-check-input">
                        <span class="form-check-label">Remember me</span>
                    </label>
                    </div>
                    <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Login</button>
                    </div>
                </form>
                </div>
            </div>
        </form>
    </div>

    @include('layouts.partials.scripts')
</body>
</html>

