@if (Route::is('mahasiswa.program_belajar'))
@else
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary text-sm">
                        Copyright ©
                        <script> document.write(new Date().getFullYear()) </script>
                        <a href="https://suniindonesia.com/" class="font-weight-bold" target="_blank">Suni Indonesia</a>,
                        developed with <i class="fa fa-heart"></i> by
                        <a href="https://mahirtechno.com/" class="font-weight-bold" target="_blank">Mahir Techno</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
@endif
