<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

    <![endif]-->
    <title>
        <?php $__env->startSection('title'); ?>
            | Shop
        <?php echo $__env->yieldSection(); ?>
    </title>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/lib.css')); ?>">
    <style type="text/css">
        #overlay {
            background: #222222;
            color: #ffffff;
            position: fixed;
            height: 100%;
            width: 100%;
            z-index: 5000;
            top: 0;
            left: 0;
            float: left;
            text-align: center;
            padding-top: 25%;
            opacity: .80;
        }

        .spinner {
            margin: 0 auto;
            height: 64px;
            width: 64px;
            animation: rotate 0.8s infinite linear;
            border: 5px solid #59a457;
            border-right-color: transparent;
            border-radius: 50%;
        }

        @keyframes  rotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
<?php echo $__env->yieldContent('header_styles'); ?>
</head>
<body>
<header>
    <?php
    $url = env('API_SERVER_URL'). "api/aboutus";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, "");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $data = json_decode($result)->data;
    $instagram = $data->instagram;
    $skype = $data->skype;
    $about_us = $data->about_us;
    $phone = $data->phone;
    $fax = $data->fax;
    $email = $data->email;
    ?>
    <div class="icon-section skin-blue">
        <div class="container">
            <ul class="list-inline">
                <li>
                    <a href="<?php echo $instagram; ?>"> <i class="livicon" data-name="instagram" data-size="18" data-loop="true" data-c="#fff"
                                    data-hc="#757b87"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- //Icon Section End -->
    <!-- Nav bar Start -->
    <nav class="navbar navbar-default container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                    <span><a href="#"><i class="livicon" data-name="responsive-menu" data-size="25" data-loop="true"
                                                    data-c="#757b87" data-hc="#ccc"></i>
                    </a></span>
            </button>
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('assets/images/emaillogo.PNG')); ?>" style="width: 150px; height: 50px" alt="logo" class="logo_position">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="collapse">
            <ul class="nav navbar-nav navbar-right">
                <li <?php echo (Request::is('/home') ? 'class="active"' : ''); ?>><a href="<?php echo e(route('home')); ?>" class="nav_button"> Home</a>
                </li>
                <li class="dropdown <?php echo (Request::is('/products')) ? 'class="active"' : ''; ?>">
                    <a href="<?php echo e(URL::to('products')); ?>" class="nav_button">Products</a>
                </li>
                <li class="<?php echo (Request::is('/news')) ? 'class="active"' : ''; ?>">
                    <a href="<?php echo e(URL::to('news')); ?>" class="nav_button">News</a>
                </li>
            </ul>
        </div>

    </nav>
</header>
<div id="overlay" style="display:none;">
    <div class="spinner"></div>
    <br/>
    Loading...
</div>
<?php echo $__env->yieldContent('top'); ?>
<!-- Content -->
<?php echo $__env->yieldContent('content'); ?>
<!-- Footer Section Start -->
<footer>
    <div class="container footer-text">
        <!-- About Us Section Start -->
        <div class="col-sm-6">
            <h4>About Us</h4>
            <p>
                <?php echo $about_us; ?>

            </p>
            <hr id="hr_border2">
            <h4 class="menu">Follow Us</h4>
            <ul class="list-inline">
                <li>
                    <a href="<?php echo $instagram; ?>"> <i class="livicon" data-name="instagram" data-size="18" data-loop="true" data-c="#ccc"
                                    data-hc="#ccc"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-sm-6">
            <h4>Contact Us</h4>
            <ul class="list-unstyled">
                <li style="margin-bottom: 10px">
                    <i class="livicon icon4 icon3" data-name="cellphone" data-size="18" data-loop="true" data-c="#ccc"
                       data-hc="#ccc"></i>WICKR:<?php echo $phone; ?>

                </li>
                <li style="margin-bottom: 10px">
                    <i class="livicon icon4 icon3" data-name="cellphone" data-size="18" data-loop="true" data-c="#ccc"
                       data-hc="#ccc"></i> THREEMA:<?php echo $fax; ?>

                </li>
                <li style="margin-bottom: 10px">
                    <i class="livicon icon3" data-name="mail-alt" data-size="20" data-loop="true" data-c="#ccc"
                       data-hc="#ccc"></i> Email:<span class="text-success" style="cursor: pointer;">
                        <?php echo $email; ?></span>
                </li>
                <li style="margin-bottom: 10px">
                    <i class="livicon icon4 icon3" data-name="telegram" data-size="18" data-loop="true" data-c="#ccc"
                       data-hc="#ccc"></i> TELEGRAM:
                    <span class="text-success" style="cursor: pointer;"><?php echo $skype; ?></span>
                </li>
            </ul>
            <hr id="hr_border">
        </div>
    </div>
</footer>
<!-- //Footer Section End -->
<div class="copyright">
    <div class="container">
        <p>Copyright &copy; Shop Procuts, 2019</p>
    </div>
</div>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top"
   data-toggle="tooltip" data-placement="left">
    <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
</a>
<!--global js starts-->
<script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/lib.js')); ?>"></script>
<script type="text/javascript">
    $(function () {
        $('.nav_button').click(function () {
            $('#overlay').fadeIn().delay(100000000).fadeOut();
        })
    })
</script>
<!--global js end-->
<!-- begin page level js -->
<?php echo $__env->yieldContent('footer_scripts'); ?>
<!-- end page level js -->

</body>
</html>
