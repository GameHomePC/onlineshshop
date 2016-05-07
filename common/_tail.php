<?php void(); ?>

            </div>
        </div>
    </div>
</div>
<!-- end .window -->

<footer class="footer">
    <div class="wrapper">
        <div class="footer__top">
            <div class="footer__item">
                <div class="footer__title">Company</div>

                <ul class="footer__list">
                    <li><a href="<?= $SITE_ROOT ?>/">About us</a></li>
                    <li><a href="<?= $SITE_ROOT ?>/news.html">News</a></li>
                    <li><a href="<?= $SITE_ROOT ?>/contact_us.html">Contact Us</a></li>
                </ul>
            </div>

            <div class="footer__item">
                <div class="footer__title">Catalog</div>

                <ul class="footer__list">
                    <li><a href="#">Specials</a></li>
                    <li><a href="#">New Products</a></li>
                    <li><a href="#">Featured Products</a></li>
                    <li><a href="#">Bestsellers</a></li>
                </ul>
            </div>

            <div class="footer__item">
                <div class="footer__title">Service & support</div>

                <ul class="footer__list">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Shipping & Returns</a></li>
                </ul>
            </div>

            <div class="footer__item footer__item_form">
                <div class="footer__title">JOIN OUR MAILING LINST</div>

                <div class="formSend">
                    <form id="footerSend">
                        <fieldset class="fieldset">
                            <input class="input-text" type="email" name="email" required />
                        </fieldset>

                        <fieldset class="fieldset fieldset__wrapSubmit">
                            <button class="btn btn__green"><span>Join the list</span></button>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="footer__item footer__item_soc">
                <ul class="footerSoc">
                    <li><a class="fa fa-facebook" href=""></a></li>
                    <li><a class="fa fa-twitter" href=""></a></li>
                    <li><a class="fa fa-google-plus" href=""></a></li>
                </ul>
            </div>
        </div>

        <div class="footer__botton">
            <div class="footer__itemB">
                <span>2003-2016, OnlineHealthcare, Inc.</span>
                <?php /* echo $Config['site_name']*/  ?>
            </div>

            <div class="footer__itemB right">
                <a href="#">Condition of Use</a>
                <a href="#">Privacy Notice</a>
            </div>
        </div>
    </div>
</footer>
