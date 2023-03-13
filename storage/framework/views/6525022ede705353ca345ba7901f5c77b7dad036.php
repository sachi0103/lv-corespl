<p>Your Name: <?php echo e($data['name']); ?></p> <br/>
<p>Your email address: <?php echo e($data['email']); ?></p> <br/>
<p>Your phone number: <?php echo e($data['phone']); ?></p> <br/>
<p>Your position/role: <?php echo e($data['role']); ?></p> <br/>
<p>Name of business: <?php echo e($data['business_name']); ?></p> <br/>
<p>Address: <?php echo e($data['address']); ?></p> <br/>
<p>City: <?php echo e($data['city']); ?></p> <br/>
<p>State/province: <?php echo e($data['state']); ?></p> <br/>
<p>Country: <?php echo e($data['country']); ?></p> <br/>
<p>No of Employees: <?php echo e($data['no_of_employee']); ?></p> <br/>
<p>Purpose of calling: <?php echo e($data['purpose']); ?></p> <br/>
<p>Exsisting Phone Company's Name: <?php echo e($data['company_name']); ?></p> <br/>
<p>Exsisting Phone Company's Website: <?php echo e($data['company_website']); ?></p> <br/>
<p>Exsisting number of phone in your office: <?php echo e($data['office_phone']); ?></p> <br/>
<p>Do you own the Phones or provided to you by the existing phone company: <?php echo e($data['own_phone']); ?></p> <br/>
<p>How many employees would need a phone: <?php echo e($data['no_of_phone']); ?></p> <br/>
<p>How many employees are on the phone at the same time: <?php echo e($data['no_phone_at_same_time']); ?></p> <br/>
<p>Do you want a new phone number or would you keep exsisting number: <?php echo e($data['new_phone']); ?></p> <br/>
<?php if($data['new_phone'] == "Require New Number") { ?>
<p>Enter your desired area code and last 4 digits? : <?php echo e($data['new_area_code']. ' '.$data['new_phone_last']); ?></p> <br/>
<?php } else { ?>
<p>What is the exsisting phone number: <?php echo e($data['exsisting_phone']); ?></p> <br/>
<?php } ?><?php /**PATH /home/corespl/login.corespl.com/jsdgdshfewiqruqwrujdfhsxzmv/resources/views/mail/contact_us.blade.php ENDPATH**/ ?>