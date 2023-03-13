<p>Your Name: {{ $data['name'] }}</p> <br/>
<p>Your email address: {{ $data['email'] }}</p> <br/>
<p>Your phone number: {{ $data['phone'] }}</p> <br/>
<p>Your position/role: {{ $data['role'] }}</p> <br/>
<p>Name of business: {{ $data['business_name'] }}</p> <br/>
<p>Address: {{ $data['address'] }}</p> <br/>
<p>City: {{ $data['city'] }}</p> <br/>
<p>State/province: {{ $data['state'] }}</p> <br/>
<p>Country: {{ $data['country'] }}</p> <br/>
<p>No of Employees: {{ $data['no_of_employee'] }}</p> <br/>
<p>Purpose of calling: {{ $data['purpose'] }}</p> <br/>
<p>Exsisting Phone Company's Name: {{ $data['company_name'] }}</p> <br/>
<p>Exsisting Phone Company's Website: {{ $data['company_website'] }}</p> <br/>
<p>Exsisting number of phone in your office: {{ $data['office_phone'] }}</p> <br/>
<p>Do you own the Phones or provided to you by the existing phone company: {{ $data['own_phone'] }}</p> <br/>
<p>How many employees would need a phone: {{ $data['no_of_phone'] }}</p> <br/>
<p>How many employees are on the phone at the same time: {{ $data['emp_same_time'] }}</p> <br/>
<p>Do you want a new phone number or would you keep exsisting number: {{ $data['new_phone'] }}</p> <br/>
<?php if($data['new_phone'] == "Require New Number") { ?>
<p>Enter your desired area code and last 4 digits? : {{ $data['new_area_code']. ' '.$data['new_phone_last'] }}</p> <br/>
<?php } else { ?>
<p>What is the exsisting phone number: {{ $data['exsisting_phone'] }}</p> <br/>
<?php } ?>