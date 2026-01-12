<?php $__env->startSection('title','Order Detail'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card">
<h5 class="card-header">Order       <a href="<?php echo e(route('order.pdf',$order->id)); ?>" class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> Generate PDF</a>
  </h5>
  <div class="card-body">
    <?php if($order): ?>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>S.N.</th>
            <th>Order No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Quantity</th>
            <th>Charge</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td><?php echo e($order->id); ?></td>
            <td><?php echo e($order->order_number); ?></td>
            <td><?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></td>
            <td><?php echo e($order->email); ?></td>
            <td><?php echo e($order->quantity); ?></td>
            <td>$<?php echo e(optional($order->shipping)->price ?? 0); ?></td>
            <td>$<?php echo e(number_format($order->total_amount,2)); ?></td>
            <td>
                <?php if($order->status=='new'): ?>
                  <span class="badge badge-primary"><?php echo e($order->status); ?></span>
                <?php elseif($order->status=='process'): ?>
                  <span class="badge badge-warning"><?php echo e($order->status); ?></span>
                <?php elseif($order->status=='delivered'): ?>
                  <span class="badge badge-success"><?php echo e($order->status); ?></span>
                <?php else: ?>
                  <span class="badge badge-danger"><?php echo e($order->status); ?></span>
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo e(route('order.edit',$order->id)); ?>" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                <form method="POST" action="<?php echo e(route('order.destroy',[$order->id])); ?>">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('delete'); ?>
                      <button class="btn btn-danger btn-sm dltBtn" data-id=<?php echo e($order->id); ?> style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>

        </tr>
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">ORDER INFORMATION</h4>
              <table class="table">
                    <tr class="">
                        <td>Order Number</td>
                        <td> : <?php echo e($order->order_number); ?></td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td> : <?php echo e($order->created_at->format('D d M, Y')); ?> at <?php echo e($order->created_at->format('g : i a')); ?> </td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td> : <?php echo e($order->quantity); ?></td>
                    </tr>
                    <tr>
                        <td>Order Status</td>
                        <td> : <?php echo e($order->status); ?></td>
                    </tr>
                    <tr>
                      <td>Courier</td>
                      <td> : <?php echo e($order->courier_name ?? '-'); ?></td>
                    </tr>
                    <tr>
                      <td>Tracking Number</td>
                      <td> : <?php echo e($order->tracking_number ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td>Shipping Charge</td>
                      <td> : $ <?php echo e(optional($order->shipping)->price ?? 0); ?></td>
                    </tr>
                    <tr>
                      <td>Coupon</td>
                      <td> : $ <?php echo e(number_format($order->coupon,2)); ?></td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td> : $ <?php echo e(number_format($order->total_amount,2)); ?></td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td> : <?php if($order->payment_method=='cod'): ?> Cash on Delivery <?php else: ?> Paypal <?php endif; ?></td>
                    </tr>
                    <tr>
                        <td>Payment Status</td>
                        <td> : <?php echo e($order->payment_status); ?></td>
                    </tr>
              </table>
            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
              <table class="table">
                    <tr class="">
                        <td>Full Name</td>
                        <td> : <?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> : <?php echo e($order->email); ?></td>
                    </tr>
                    <tr>
                        <td>Phone No.</td>
                        <td> : <?php echo e($order->phone); ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td> : <?php echo e($order->address1); ?>, <?php echo e($order->address2); ?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td> : <?php echo e($order->country); ?></td>
                    </tr>
                    <tr>
                        <td>Post Code</td>
                        <td> : <?php echo e($order->post_code); ?></td>
                    </tr>
              </table>
            </div>
          </div>

          <div class="col-lg-12 mt-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">COURIER TRACKING</h4>

              <form method="POST" action="<?php echo e(route('order.tracking.store', $order->id)); ?>" class="mb-3">
                <?php echo csrf_field(); ?>
                <div class="form-row">
                  <div class="col-md-3 mb-2">
                    <input type="text" name="status" class="form-control" placeholder="Status (e.g. Shipped)" required>
                  </div>
                  <div class="col-md-3 mb-2">
                    <input type="text" name="location" class="form-control" placeholder="Location (optional)">
                  </div>
                  <div class="col-md-4 mb-2">
                    <input type="text" name="description" class="form-control" placeholder="Description (optional)">
                  </div>
                  <div class="col-md-2 mb-2">
                    <input type="datetime-local" name="event_time" class="form-control">
                  </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Add Update</button>
              </form>

              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Status</th>
                      <th>Location</th>
                      <th>Description</th>
                      <th>Event Time</th>
                      <th style="width: 70px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $order->shipmentTrackings()->orderBy('event_time','desc')->orderBy('id','desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tracking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <tr>
                        <td><?php echo e($tracking->status); ?></td>
                        <td><?php echo e($tracking->location); ?></td>
                        <td><?php echo e($tracking->description); ?></td>
                        <td><?php echo e($tracking->event_time ? $tracking->event_time->format('D d M, Y g:i a') : ''); ?></td>
                        <td>
                          <form method="POST" action="<?php echo e(route('order.tracking.destroy', $tracking->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('delete'); ?>
                            <button class="btn btn-danger btn-sm" type="submit" title="Delete">X</button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                      <tr>
                        <td colspan="5">No tracking updates yet.</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern-Job\Complete-Ecommerce-in-laravel-10-master\resources\views/backend/order/show.blade.php ENDPATH**/ ?>