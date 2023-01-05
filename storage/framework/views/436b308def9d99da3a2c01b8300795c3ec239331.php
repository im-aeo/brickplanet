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
    <title><?php echo e(isset($title) ? "{$title} | " . config('site.name') . ' Administration' : config('site.name') . ' Administration'); ?></title>

    <!-- Preconnect -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Meta -->
    <link rel="shortcut icon" href="<?php echo e(config('site.icon')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php echo $__env->yieldContent('meta'); ?>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap">
    <?php echo $__env->yieldContent('fonts'); ?>

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #eee;
            color: #333;
            font-family: 'Noto Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        p:last-child {
            margin-bottom: 0;
        }

        b, strong {
            font-weight: 600;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .btn {
            box-shadow: none!important;
        }

        .navbar {
            background: #000;
        }

        .navbar .navbar-brand {
            margin-top: -5px;
        }

        .navbar .nav-link {
            color: #fff;
        }

        .navbar .headshot a {
            text-decoration: none;
        }

        .navbar .headshot .dropdown-toggle {
            margin-right: none!important;
        }

        .navbar .headshot .dropdown-toggle::after {
            border: none!important;
            margin: 0!important;
        }

        .card {
            margin-bottom: 16px;
        }

        .card, .breadcrumb {
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 0;
        }

        @media only screen and (min-width: 768px) {
            .show-sm-only {
                display: none !important
            }

            .mb-sm-only {
                margin-bottom: 0 !important
            }

            .nav-tabs.card-header-nav-tabs {
                margin-bottom: -5px
            }
        }

        @media only screen and (max-width: 768px) {
            .hide-sm {
                display: none !important
            }

            .full-width-sm {
                width: 100% !important
            }

            .text-center-sm {
                text-align: center !important
            }
        }
    </style>
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <?php if(request()->route()->getName() == 'admin.login.index'): ?>
        <div class="container" style="margin-top:50px;">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <?php if(count($errors) > 0): ?>
                        <div class="alert bg-danger text-white">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div><?php echo $error; ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <nav class="navbar navbar-expand-md border-bottom mb-4">
            <div class="container">
                <a href="<?php echo e(route('admin.index')); ?>" class="navbar-brand">
                    <img src="<?php echo e(config('site.logo')); ?>" width="150px">
                </a>

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="<?php echo e(route('home.index')); ?>" class="nav-link">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown headshot">
                        <a href="#" class="dropdown-toggle headshot" data-toggle="dropdown">
                            <img src="<?php echo e(staffUser()->headshot()); ?>" style="background:#292727;border-radius:50%;" width="40px">
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?php echo e(route('admin.logout')); ?>" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <?php if(count($errors) > 0): ?>
                <div class="alert bg-danger text-white">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo $error; ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php if(session()->has('success_message')): ?>
                <div class="alert bg-success text-white">
                    <?php echo session()->get('success_message'); ?>

                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-4">
                    <h3>Admin</h3>
                </div>
                <div class="col-8 text-right">
                    <?php echo $__env->yieldContent('header'); ?>
                </div>
            </div>
            <?php if(isset($title)): ?>
                <ul class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
                    <li class="breadcrumb-item active"><?php echo e($title); ?></li>
                </ul>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <footer class="container text-center mb-5 mt-5">
            <div><strong>Copyright &copy; <?php echo e(config('site.name')); ?> <?php echo e(date('Y')); ?></strong></div>
            <div class="text-muted" style="font-size:13px;"><strong>Powered by <a href="https://m.do.co/c/886a1e675549" target="_blank">Digitalocean</a></strong></div>
        </footer>
    <?php endif; ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <?php echo $__env->yieldContent('js'); ?>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/admin.blade.php ENDPATH**/ ?>