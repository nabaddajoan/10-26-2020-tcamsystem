<!--<?php ini_set("memory_limit", "16M"); ?>-->

<?php
	include 'includes/session.php';
  include '../timezone.php';
   $today = date('Y-m-d');
$year = date('Y');
if(isset($_GET['year'])){
  $year = $_GET['year'];
}
  $month = date('m');
  if(isset($_GET['month'])){
    $month = $_GET['month'];
  } 


$numberofday = cal_days_in_month(CAL_GREGORIAN, $month,$year);
	function generateRow($conn){
		$contents = '';  
    $sql = "SELECT teacher_id ,firstname,lastname,count(case when status !='missed' then 1 end) as days_present ,count(case when status ='missed' then 1 end) as days_absent ,(count(case when status != 'missed' then 1 end) / ( '23') *100 ) as percentage from attendance_report where weekend = '0' and month(date) = '7' and  year(date) = 'Y'GROUP by teacher_id ";		

		$query = $conn->query($sql);
		$total = 0;
		while($row = $query->fetch_assoc()){
			$contents .= "
			<tr>
      <td>".$row['teacher_id']."</td>
        <td>".$row['firstname'].", ".$row['lastname']."</td>      	
				<td>".$row['days_present']."</td>
        <td>".$row['days_absent']."</td>
        <td>".$row['percentage']."</td>       	
			</tr>
			";
		}

		return $contents;
	}

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('TCAMsystem - Teacher Attendance%');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '
      	<h2 align="center">Teacher Classroom Attendance Monitoring System%%</h2>
      	<h4 align="center">General Attendance</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>
            <th align="center"><b>Teacher ID</b></th>
           	<th align="center"><b>Teacher Name</b></th>       
                 <th align="center"><b>days_present</b></th>
                  <th  align="center"><b>days_absent</b></th>
                   <th align="center"><b>percentage</b></th>

           </tr>  
      ';  
    $content .= generateRow($conn); 
    $content .= '</table>';  
    $pdf->writeHTML($content); 
    ob_end_clean(); 
    $pdf->Output('individual%attend.pdf', 'I');

?>