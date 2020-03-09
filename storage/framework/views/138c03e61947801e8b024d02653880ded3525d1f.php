<?php $__env->startSection('title'); ?>
    Home
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/frontend/tabbular.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/animate/animate.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/frontend/jquery.circliful.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/owl_carousel/css/owl.carousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/owl_carousel/css/owl.theme.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('top'); ?>
    <?php
        $url = env('API_SERVER_URL'). "api/aboutus";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, "");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $data = json_decode($result)->data;
        foreach (json_decode($data->home_photo) as $image){
            $fileurl = env('API_SERVER_URL'). "productsimage/".$image;
            $file = file_get_contents($fileurl);
            $realpath  = public_path()."/productsimage/".$image;
            file_put_contents($realpath, $file);
        }
    ?>
    <div class="row">
        <div class="col-md-12">
            <div id="owl-demo" class="owl-carousel owl-theme">
                <?php $__currentLoopData = json_decode($data->home_photo); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item  <?php if($photo == 0): ?> active <?php endif; ?>">
                        <img class="img-responsive" src="<?php echo url('/').'/productsimage/'.$result; ?>"
                             alt="First slide">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/jquery.circliful.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/wow/js/wow.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/owl_carousel/js/owl.carousel.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/carousel.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/index.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>