<ul class="breadcrumb">
    <li><i class="icon-home"></i><a href=""> Home</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
    <li><i class="icon-dashboard"></i><a href="index.php/users/dashboard"> Dashboard</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
    <li class="active">Send Message</li>
    <li class="moveDown pull-right">
        <span class="time"></span>
        <span class="date"></span>
    </li>
</ul>

<!-- ==================== MASTER ACTIONS ROW ==================== -->
<div class="row-fluid" style="width: 600px;">
    <div class="containerHeadline">
        <i class="icon-envelope-alt"></i><h2>New Message</h2>
        
    </div>
    <div class="floatingBox">
        <div class="container-fluid">
            <?php if (validation_errors()): ?>
                <div class="alert alert-error">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif ?>
            <?php echo form_open('index.php/messages/send', array('id' => 'send')) ?>
            <ul>

                <input type="hidden" name="from" value="{{user:id}}">

                <li>
                    <label for="To">To</label>
                    <input type="text" name="to" value="" />
                </li>

                <li>
                    <label for="Subject">Subject</label>
                    <input type="text" name="subject" value="" />
                </li>
                <li>
                    <label for="body">Body</label>
                    <textarea name="body" rows="7" style="width: 500px"></textarea>
                </li>



                <li>
                    <?php echo form_submit('btnSubmit', 'Send Message') ?>
                </li>
            </ul>
            <?php echo form_close() ?>
        </div></div></div>