@extends('dashboard.layouts.master')

@section('c-header', ' Computing Payroll...' )


@section('breadcrumb')
		<li><a href="#">Payroll</a></li>
		<li class="active">Generate Payroll</li>
		<li class="active">Computing Payrol...</li>
@endsection

@section('content')


  <div class="progress">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%" id="progress">
      <p id="information">0</p>
    </div>
  </div>

<?php

$total = 10;
// Loop through process
for($i=1; $i<=$total; $i++){
    // Calculate the percentation
    $percent = intval($i/$total * 100)."%";


    // Javascript for updating the progress bar and information
    echo '<script>
    document.getElementById("progress").style.width="'.$percent.'";
    document.getElementById("information").innerHTML="'.$i.' row(s) processed.";
    </script>';


// This is for the buffer achieve the minimum size in order to flush data
    echo str_repeat(' ',1024*64);

    // sleep(1);

// // Send output to browser immediately
    flush();


// // Sleep one second so we can see the delay

}
// Tell user that the process is completed
echo '<script language="javascript">document.getElementById("information").innerHTML="Process completed"</script>';
?>


{{-- <div style="display:none">
	{!! redirect()->action('PagesController@get_index') !!}
</div> --}}

@endsection


