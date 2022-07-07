<div class="row">
    <div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
        <div class="card card-plain">
            <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder">Daftar</h4>
                <p class="mb-0">Isikan identitas anda untuk Daftar</p>
            </div>
            <div class="card-body">
                <form action="{$BaseHref}Auth/doRegister" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="mb-3">
                        <input type="text" name="namaDepan" class="form-control form-control-lg"
                            placeholder="Nama Depan" aria-label="Nama Depan" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="namaBelakang" class="form-control form-control-lg"
                            placeholder="Nama Belakang" aria-label="Nama Belakang" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Email"
                            aria-label="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control form-control-lg"
                            placeholder="Password" aria-label="Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="confirmPassword" class="form-control form-control-lg"
                            placeholder="Ulangi Password" aria-label="Ulangi Password" required>
                    </div>
                    <div class="form-check form-check-info text-start">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Saya setuju dengan <a href="javascript:;" class="text-dark font-weight-bolder">Syarat dan
                                Ketentuan</a>
                        </label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Daftar</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                    Sudah punya akun ?
                    <a href="{$BaseHref}Auth/login" class="text-primary text-gradient font-weight-bold">Login</a>
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
            <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new
                currency"</h4>
            <p class="text-white position-relative">The more effortless the writing looks, the more
                effort the writer actually put into the process.</p>
        </div>
    </div>
</div>
