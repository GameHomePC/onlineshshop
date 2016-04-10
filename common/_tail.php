<?php void(); ?>

    </td>
    <td width=0>
        <!-- Bestsellers _tail.php -->
        <?php /*
            $ModuleData = array(
                'header' => 'Bestsellers',
                'condition' => '',
                'order' => 'p.num_choosed desc,priority,rand()',
                'block_head' => "<img src='$SITE_ROOT/img/1x1.gif' width=1 height=4 alt=''><br>"
            );
            include("$ROOT_PATH/modules/products_block.php");
        ?>

        <?php
            $tmp = $CatID ? "categories like '%:$CatID:%'" : 0;
            $res = db_query("select name,products from sc_list where active and col=1 and length(products)>2 and (all_pages or $tmp)");

            while ($lst = @$sql_fetch_assoc($res)) {
                if ($prds = array_filter(call('intval', explode(':', $lst['products'])))) {
                    $ModuleData = array(
                        'header' => $lst['name'],
                        'condition' => 'p.prdID in (' . implode(',', $prds) . ')',
                        'order' => 'priority,rand()',
                        'block_head' => "<img src='$SITE_ROOT/img/1x1.gif' width=1 height=4 alt=''><br>"
                    );
                    include("$ROOT_PATH/modules/products_block.php");
                }
            }
        */?>

    </td>
    </tr>
    </table>

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
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>

            <div class="footer__item">
                <div class="footer__title">Sign up</div>

                <ul class="footer__list">
                    <li><a href="#">Cart</a></li>
                    <li><a href="#">Your Orders</a></li>
                    <li><a href="#">Registry</a></li>
                </ul>
            </div>

            <div class="footer__item">
                <div class="footer__title">Discover</div>

                <ul class="footer__list">
                    <li><a href="#">Shop by Category</a></li>
                    <li><a href="#">Customer Service</a></li>
                    <li><a href="#">Shipping</a></li>
                </ul>
            </div>

            <div class="footer__item">
                <div class="footer__title">Explore</div>

                <ul class="footer__list">
                    <li><a href="#">Search item</a></li>
                    <li><a href="#">Find Form</a></li>
                    <li><a href="#">Useful Links</a></li>
                </ul>
            </div>

            <div class="footer__item">
                <div class="footer__title">Support</div>

                <ul class="footer__list">
                    <li><a href="#">Special Offers</a></li>
                    <li><a href="#">Health Information</a></li>
                    <li><a href="#">Secure Payments</a></li>
                </ul>
            </div>

            <div class="footer__item">
                <div class="footer__title">Connect</div>

                <ul class="footer__list">
                    <li><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
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
