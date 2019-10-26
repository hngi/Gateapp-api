<?php $__env->startSection('content'); ?>
<div class="col-12 download-footer px-0">
<div class="col-12 download-app row mx-0">

    <div class="login col-md-5 offset-md-3">
        <h3>Login</h3>
        <form role="form">
            <div class="form-group">
                <input type="email" style="border: 1px solid #000;" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <div class="form-group">
                <input type="password"  style="border: 1px solid #000;" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-success form-control">Submit</button>
        </form>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tobecci/development/Gateapp-api/resources/views/login.blade.php ENDPATH**/ ?>