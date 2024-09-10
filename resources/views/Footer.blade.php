<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5 class="text-uppercase font-weight-bold">Suka Film?</h5>
                <p class="small">Tempat untuk menemukan dan melacak film favoritmu. Selalu update dengan film-film terbaru dan informasi menarik seputar dunia perfilman.</p>
            </div>
            <div class="col-md-4 mb-3 text-center">
                <h5 class="text-uppercase font-weight-bold">Follow Me</h5>
                <div class="d-flex justify-content-center align-items-center">
                    <a href="https://github.com/AzzamSyakir" class="text-white mx-2" target="_blank">
                        <i class="fab fa-github fa-2x"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/azzamsyakir/" class="text-white mx-2" target="_blank">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                    <a href="https://www.instagram.com/azmsykr_/" class="text-white mx-2" target="_blank">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                    <a href="https://x.com/assa_kussa" class="text-white mx-2" target="_blank">
                        <i class="fab fa-twitter fa-2x"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-3 text-right">
                <h5 class="text-uppercase font-weight-bold">Contact Me</h5>
                <a href="mailto:azzamsykir@gmail.com" class="btn btn-outline-light btn-sm">Contact Me</a>
            </div>
        </div>
        <hr class="border-gray-700">
        <div class="text-center small">
            <p class="mb-0">&copy; 2024 Suka Film? All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        function updateCarouselControls(carouselId) {
            var carousel = $(carouselId);
            var activeIndex = carousel.find('.carousel-item.active').index();
            var itemCount = carousel.find('.carousel-item').length;

            carousel.find('.carousel-control-prev').toggleClass('d-none', activeIndex === 0);
            carousel.find('.carousel-control-next').toggleClass('d-none', activeIndex === itemCount - 1);
        }

        $('.carousel').on('slid.bs.carousel', function () {
            updateCarouselControls('#' + $(this).attr('id'));
        });

        $('.carousel').each(function () {
            updateCarouselControls('#' + $(this).attr('id'));
        });
    });
</script>
