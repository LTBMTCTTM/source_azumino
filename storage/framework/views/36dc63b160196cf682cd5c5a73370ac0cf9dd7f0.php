
<div class="row pagination-page">
    <div class="col-md-6 col-sm-12">
        <div class="dataTables_paginate paging_simple_numbers">
            <ul class="pagination justify-content-start">
                <li class="page-item <?php echo e($page==1?"disabled":''); ?>">
                    <a class="page-link" href="#" aria-label="First" page="<?php echo e(1); ?>" onclick="<?php echo $event; ?>">
                        <span aria-hidden="true">＜＜</span>
                    </a>
                </li>
                <li class="page-item <?php echo e($page==$prev?"disabled":''); ?>">
                    <a class="page-link" href="#" aria-label="Previous" page="<?php echo e($prev); ?>" onclick="<?php echo $event; ?>">
                        <span aria-hidden="true">＜</span>
                    </a>
                </li>
                <?php $__currentLoopData = $arrBtn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $btn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="page-item <?php echo e($page==$btn?"active":''); ?>">
                        <a class="page-link" href="#" page="<?php echo e($btn); ?>" onclick="<?php echo $event; ?>"><?php echo e($btn); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li class="page-item <?php echo e($page==$next?"disabled":''); ?>">
                    <a class="page-link" href="#" aria-label="Next" page="<?php echo e($next); ?>" onclick="<?php echo $event; ?>">
                        <span aria-hidden="true">＞</span>
                    </a>
                </li>
                <li class="page-item <?php echo e($page==$pages?"disabled":''); ?>">
                    <a class="page-link" href="#" aria-label="Last" page="<?php echo e($pages); ?>" onclick="<?php echo $event; ?>">
                        <span aria-hidden="true">＞＞</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-6  col-sm-12 text-right">
        <div class="dataTables_info font-weight-bold" role="status" aria-live="polite"><?php echo e($min); ?>-<?php echo e($max); ?>件/<?php echo e($total); ?>件</div>
    </div>
</div>
<?php /**PATH /home/vagrant/Code/azumino/resources/views/components/paging.blade.php ENDPATH**/ ?>