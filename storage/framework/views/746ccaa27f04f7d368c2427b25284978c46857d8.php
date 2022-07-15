<!--
MIT License

Copyright (c) 2022 FoxxoSnoot

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(isset($title) ? "{$title} | " . config('site.name') : config('site.name')); ?></title>

    <!-- Preconnect -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Meta -->
    <link rel="shortcut icon" href="<?php echo e(config('site.icon')); ?>">
    <meta name="author" content="<?php echo e(config('site.name')); ?>">
    <meta name="description" content="Explore <?php echo e(config('site.name')); ?>: A free online social hangout.">
    <meta name="keywords" content="<?php echo e(strtolower(config('site.name'))); ?>, <?php echo e(strtolower(str_replace(' ', '', config('site.name')))); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- OpenGraph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo e(config('site.name')); ?>">
    <meta property="og:title" content="<?php echo e(str_replace(' | ' . config('site.name'), '', $title)); ?>">
    <meta property="og:description" content="Explore <?php echo e(config('site.name')); ?>: A free online social hangout.">
    <meta property="og:image" content="<?php echo e(!isset($image) ? config('site.icon') : $image); ?>">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/stylesheet.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/landing.css')); ?>">
  
    <div class="video-overlay"></div>
<div class="min-header">
<div class="grid-x grid-margin-x align-middle">
<div class="auto cell">
<img src="<?php echo e(config('site.logo')); ?>" width="175">
</div>
</div>
</div>
                        <?php echo $__env->yieldContent('content'); ?>
            
<?php /**PATH /var/www/html/resources/views/layouts/error.blade.php ENDPATH**/ ?>