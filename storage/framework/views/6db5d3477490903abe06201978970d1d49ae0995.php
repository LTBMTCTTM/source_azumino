

<div class="row pagination-page">
    <div class="col-md-6 col-sm-12">
        <div class="dataTables_paginate paging_simple_numbers">
            <ul class="pagination justify-content-start">
                <li class="page-item <?php echo e($page==$first?"disabled":''); ?>">
                    <a class="page-link" href="#" aria-label="First" page="<?php echo e($first); ?>" onclick="<?php echo $event; ?>">
                        <span aria-hidden="true">＜＜</span>
                    </a>
                </li>
                <li class="page-item <?php echo e($page==$prev?"disabled":''); ?>">
                    <a class="page-link" href="#" aria-label="Previous" page="<?php echo e($prev); ?>" onclick="<?php echo $event; ?>">
                        <span aria-hidden="true">＜</span>
                    </a>
                </li>
                <?php for($p=1; $p<=$pages; $p++): ?>
                    <li class="page-item <?php echo e($p==$page?"active":''); ?>">
                        <a class="page-link" href="#" page="<?php echo e($p); ?>" onclick="<?php echo $event; ?>"><?php echo e($p); ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php echo e($page==$next?"disabled":''); ?>">
                    <a class="page-link" href="#" aria-label="Next" page="<?php echo e($next); ?>" onclick="<?php echo $event; ?>">
                        <span aria-hidden="true">＞</span>
                    </a>
                </li>
                <li class="page-item <?php echo e($page==$last?"disabled":''); ?>">
                    <a class="page-link" href="#" aria-label="Last" page="<?php echo e($last); ?>" onclick="<?php echo $event; ?>">
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
<?php /**PATH /home/vagrant/code/source/resources/views/components/paging.blade.php ENDPATH**/ ?>