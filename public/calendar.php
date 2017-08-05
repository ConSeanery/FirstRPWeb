<?php

require($_SERVER[ 'DOCUMENT_ROOT' ] . '/../includes/application_includes.php');

// Include the HTML layout class
require_once(FS_TEMPLATES . 'Layout.php');
require_once(FS_TEMPLATES . 'News.php');


// Connect to the database
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Get the stories for column 1 from the database
$sql = 'SELECT SUBSTRING(title,1,20) AS title, startDate, id FROM posts ORDER BY startDate ASC';
$sql2 = 'select * from audio ORDER BY id DESC limit 12';

$postCount = 0;
$posts = $db->query($sql);
$sermons = $db->query($sql2);
// Run a simple query that will be rendered in column 2 below

Layout::pageTop('Csc206 Project');

?>


   
        <section class="content">
 <h1>News and Events</h1>
 


<?php
date_default_timezone_set('America/Los_Angeles');
$month= date ("m");
$year=date("Y");
$day=date("d");
$endDate=date("t",mktime(0,0,0,$month,$day,$year));
echo '<font face="arial" size="2">';
echo '<table class="" align="center" border="0" cellpadding=5 cellspacing=5 style="" class="calendar"><tr>';
echo "<h3>Today: ".date("F d Y ",mktime(0,0,0,$month,$day,$year)). "</h3>";
echo '</tr></table>';
echo '<table class="calendar" align="center" border="0" cellpadding=1 cellspacing=1 style="border:1px solid #CCCCCC">
<tr class="calendarHead" bgcolor="#EFEFEF">
<td align=center>Sunday</td>
<td align=center>Monday</td>
<td align=center>Tuesday</td>
<td align=center>Wednesday</td>
<td align=center>Thursday</td>
<td align=center>Friday</td>
<td align=center>Saturday</td>
</tr>';
$s=date ("w", mktime (0,0,0,$month,1,$year));
for ($ds=1;$ds<=$s;$ds++) { 

echo "<td class='calendar' style=\"font-family:arial;color:#B3D9FF\" align=center valign=middle bgcolor=\"#FFFFFF\">
</td>";}

for ($d=1;$d<=$endDate;$d++){
	
$postTitle = $d;
$linkId = 'calendar.php';
$posts = $db->query($sql);


while ($post = $posts->fetch()){
if ($d > 9){ if ( "$year-$month-$d 00:00:00" == $post['startDate'] ){$postTitle  = "<p>". $post['title']. "</p>"; $id = $post['id']; $linkId = '/View.php?id='. $id;}}
else if ($d < 10){
if ( "$year-$month-0$d 00:00:00" == $post['startDate'] ){$postTitle  = "<p>" .$post['title'] ."</p>"; $id = $post['id']; $linkId = '/View.php?id='. $id;}}
}
			
if (date("w",mktime (0,0,0,$month,$d,$year)) == 0) { echo "<tr>"; }
$fontColor="#000000";
if (date("D",mktime (0,0,0,$month,$d,$year)) == "Sun") { $fontColor="red"; }
		
echo "<td class='calendar' style=\"font-family:arial;color:#333333\" align=center valign=middle> 
<span style=\"color:$fontColor\"> <a href=$linkId> <div class='calTitle'>$postTitle</div></a></span></td>";
if (date("w",mktime (0,0,0,$month,$d,$year)) == 6) { echo "</tr>"; }}
echo '</table>'; 

?>


<a href="calendarNEXT.php">-Next-</a>

	</div>


				<!--The Side Well -->
		<?php
		layout::pageSide('Csc206 Project');	
		echo <<<yes
		<!-- Side Widget Well -->
		<div class="col-md-4">
                <div class="well">
                    <h4>Audio Sermons</h4>
yes;
					
while ($sermon = $sermons->fetch()) {
         // Call the method to create the layout for a post
          News::sermon($sermon);
		   
     }		 
	 
	 echo <<<end
					
                </div>
            </div>
        </div>
				
			<!-- /.row -->

        <hr>
end;
?>


<?php
Layout::pageBottom();
