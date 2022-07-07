<div class="row">
    <div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
        <div class="card card-plain">
            <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder">Login</h4>
                <p class="mb-0">Masukkan email dan password anda untuk Login</p>
            </div>
            <div class="card-body">
                <!-- Alert -->
                <% if $StatusLogin == "success" %>
                <div class="alert alert-success alert-message fade show" role="alert">
                    <strong>$msglogin</strong>
                </div>
                <% else_if $StatusLogin == "error" %>
                <div class="alert alert-danger alert-message fade show" role="alert">
                    <strong>$msglogin</strong>
                </div>
                <% end_if %>
                <% if $StatusRegister == "success" %>
                <div class="alert alert-success alert-message fade show" role="alert">
                    <strong>$msgRegister</strong>
                </div>
                <% else_if $StatusRegister == "error" %>
                <div class="alert alert-danger alert-message fade show" role="alert">
                    <strong>$msgRegister</strong>
                </div>
                <% end_if %>
                <!-- End Alert  -->

                <form action="{$BaseHref}Auth/doLogin" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="AuthenticationMethod"
                        value="SilverStripe\Security\MemberAuthenticator\MemberAuthenticator" class="hidden" />

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Email"
                            aria-label="Email" required />
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control form-control-lg"
                            placeholder="Password" aria-label="Password" required />
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="rememberMe" />
                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">
                            Login
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                    Belum punya akun ?
                    <a href="{$BaseHref}Auth/register" class="text-primary text-gradient font-weight-bold">Daftar</a>
                </p>
            </div>
        </div>
    </div>
    <div
        class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
            <span class="mask bg-gradient-primary opacity-6"></span>
            <h4 class="mt-5 text-white font-weight-bolder position-relative">
                "Attention is the new currency"
            </h4>
            <p class="text-white position-relative">
                The more effortless the writing looks, the more effort the
                writer actually put into the process.
            </p>
        </div>
    </div>
</div>
