<!--
MIT License

Copyright (c) 2022 Aeo

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




<?php $__env->startSection('meta'); ?>
    <meta name="item-types-with-padding" content="<?php echo e(json_encode(config('site.item_thumbnails_with_padding'))); ?>">
    <meta name="item-type-padding-amount" content="<?php echo e(itemTypePadding('default')); ?>">
    <meta
        name="routes"
        data-regen="<?php echo e(route('account.character.regenerate')); ?>"
        data-inventory="<?php echo e(route('account.character.inventory')); ?>"
        data-wearing="<?php echo e(route('account.character.wearing')); ?>"
        data-update="<?php echo e(route('account.character.update')); ?>"
    >
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .avatar-body-colors {
            max-width: 370px;
        }

        .avatar-body-color {
            border: 1.5px solid var(--section_border_color);
            border-radius: 5px;
            width: 50px;
            height: 50px;
            cursor: pointer;
            display: inline-block;
        }

        .avatar-item-category.active {
            font-weight: 600;
        }

        .avatar-body-part {
            border: 1.5px solid var(--section_border_color_inside);
            border-radius: 5px;
            outline: none;
            appearance: none;
            cursor: pointer;
        }

        .avatar-body-part:disabled {
            opacity: .8;
            pointer-events: none;
            cursor: not-allowed;
        }

        .angle-buttons .active {
            background: var(--section_bg_inside);
            border-radius: 0;
            box-shadow: var(--section_box_shadow)!important;
        }

       
        @media only screen and (max-width: 768px) {
            .avatar-body-colors {
                max-width: 320px;
            }

            .palette {
                margin-top: 200px;
                margin-left: 20px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!---don't update this please--->
    <script src="<?php echo e(asset('js/character.js?v=34')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="palette" id="colors">
			<div class="palette-header-text" id="colorsTitle">Choose a color</div>
        <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $hex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="background:<?php echo e($hex); ?>;width:50px;height:50px;display:inline-block;cursor:pointer;margin-left:15px;" data-color="<?php echo e($name); ?>" onclick="changeColor(\'<?php echo e($hex); ?>\')"></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="grid-x grid-margin-x">
			<div class="large-4 cell">
				<div class="grid-x grid-margin-x align-middle">
					<div class="auto cell no-margin">
						<h5>Avatar</h5>
					</div>
					<div class="shrink cell right no-margin">
						<input type="button" class="button button-grey" value="Refresh" style="margin:0 auto;padding:3px 15px;font-size:12px;line-height:1.25;" onclick="refreshAvatar()" data-regenerate>
					</div>
				</div>
				<div class="push-5"></div>
				<div class="container border-r lg-padding text-center relative">
                  
                  <img id="character" src="<?php echo e(Auth::user()->thumbnail()); ?>" width="80%">
                 
              </div>
<div class="push-15"></div>
				<h5>Colors</h5>
				<div class="container border-r lg-padding text-center">
                  
                    <div style="margin-bottom:2.5px;">
                        <button class="avatar-body-part" style="background-color:<?php echo e(Auth::user()->avatar()->color_head); ?>;padding:25px;margin-top:-1px;" data-part="head"></button>
                    </div>
                    <div style="margin-bottom:2.5px;">
                        <button class="avatar-body-part" style="background-color:<?php echo e(Auth::user()->avatar()->color_left_arm); ?>;padding:50px;padding-right:0px;" data-part="left_arm"></button>
                        <button class="avatar-body-part" style="background-color:<?php echo e(Auth::user()->avatar()->color_torso); ?>;padding:50px;" data-part="torso"></button>
                        <button class="avatar-body-part" style="background-color:<?php echo e(Auth::user()->avatar()->color_right_arm); ?>;padding:50px;padding-right:0px;" data-part="right_arm"></button>
                    </div>
                    <div>
                        <button class="avatar-body-part" style="background-color:<?php echo e(Auth::user()->avatar()->color_left_leg); ?>;padding:50px;padding-right:0px;padding-left:47px;" data-part="left_leg"></button>
                        <button class="avatar-body-part" style="background-color:<?php echo e(Auth::user()->avatar()->color_right_leg); ?>;padding:50px;padding-right:0px;padding-left:47px;" data-part="right_leg"></button>
                    </div>
				</div>
			</div>
			<div class="large-8 cell">
              
            <h5>Backpack</h5>
				<div class="container border-r lg-padding">
					<div class="edit-character-categories text-center" role="tablist">
                        &nbsp;|&nbsp;
                        <?php $__currentLoopData = config('site.character_editor_item_types'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="nav-link flex-sm-fill <?php if($type == 'hat'): ?> active <?php endif; ?>" data-tab="<?php echo e(lcfirst(itemType($type, true))); ?>"><?php echo e(itemType($type, true)); ?></a>
                        &nbsp;|&nbsp;
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                   <div style="height:15px;"></div>
                    <div class="grid-x grid-margin-x clearfix" id="inventory"></div>
                
              </div>
             <div style="height:25px;"></div>     
            <h5>Wearing</h5>
            <div class="container border-r lg-padding">
					 <div class="grid-x grid-margin-x clearfix" id="wearing"></div>
				</div>
        </div>
    </div>

    <!--<div class="modal fade" id="error" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p id="errorText"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>--->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Character'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/account/character.blade.php ENDPATH**/ ?>