<!--<?php ini_set("memory_limit", "16M"); ?>-->
<?php 
  include '../timezone.php'; 
  $today = date('Y-m-d');
  $month = date('m');
  if(isset($_GET['month'])){
    $month = $_GET['month'];
  }
?>
<?php
  include 'includes/session.php';


  function generateRow($conn){
    $contents = '';
    $sql = "SELECT d.fulldate as date, t.teacher_id,ai.id as attid, t.firstname, t.lastname,t.time_in as Expected_time_in, ai.time_in as attended_time_in, ai.time_out as attended_time_out, (case when t.time_in = ai.time_in THEN 'ontime' when ai.Teacher_id is null then 'missed' else 'Late'end) as status FROM dates d cross join teacherschedules t left join attendance ai on ai.Teacher_id = t.id and ai.date = d.fulldate where year(date) = '2020' order by date asc ";    

    $query = $conn->query($sql);
    $total = 0;
    while($row = $query->fetch_assoc()){
      $contents .= "
      <tr>
      <td>".$row['date']."</td>
        <td>".$row['firstname'].", ".$row['lastname']."</td>
      <td>".$row['teacher_id']."</td>
        
        <td>".$row['Expected_time_in']."</td>
        <td>".$row['attended_time_in']."</td>
        <td>".$row['attended_time_out']."</td>
        <td>".$row['status']."</td>
        
      </tr>
      ";
    }

    return $contents;
  }

  require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('TCAMsystem - Teacher Attendance');  
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
        <h2 align="center">Teacher Classroom Attendance Monitoring System</h2>
        <h4 align="center">General Attendance</h4>
        <table border="1" cellspacing="0" cellpadding="3">  
           <tr>
           <th  align="center"><b>Date</b></th>  
              <th align="center"><b>Teacher Name</b></th>
                <th align="center"><b>Teacher ID</b></th>
                 <th align="center"><b>Expected_time_in</b></th>
                  <th  align="center"><b>attended_time_in</b></th>
                   <th align="center"><b>attended_time_out</b></th>
                    <th align="center"><b>status</b></th>
         
           </tr>  
      ';  
    $content .= generateRow($conn); 
    $content .= '</table>';  
    $pdf->writeHTML($content); 
    ob_end_clean(); 
    $pdf->Output('attend.pdf', 'I');

?>