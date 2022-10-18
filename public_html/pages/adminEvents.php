<div class="classTable" id="adminEvent">

<?php

use \Rl\Models\Event;
use \Rl\Models\Member;

global $MEMBERPASSWORD;

if(!isset($_SESSION['memberpassword'])){
	if(isset($_POST['memberpassword'])){
		if ($_POST['memberpassword'] == "$MEMBERPASSWORD"){
			$_SESSION['memberpassword'] = $_POST['memberpassword'];
		} else {
			session_destroy();
			echo $twig->render('member/memberloginfailed.twig');
		}
	} else {
		echo $twig->render('member/memberloginform.twig');
	}
}

if (isset($_POST['createEvent'])) {
	//$neweventdate = $_POST['year0'] . "-" . $_POST['month0'] . "-" . $_POST['day0'];
	$event = new Event;
	//$event->eventdate = $neweventdate;
	$event->eventdate = $_POST['neweventdate'];
	$event->save();
}

else if (isset($_POST['modifyEvent'])) {
	$event = findOne(Event::class, $_POST['modifyEvent']);
	$event->id = $_POST['modifyEvent'];
	$event->eventdate = $_POST['newdate'];
	$event->leader1 = $_POST['newleader1'];
	$event->leader2 = $_POST['newleader2'];
	$event->helper1 = $_POST['newhelper1'];
	$event->helper2 = $_POST['newhelper2'];
	$event->helper3 = $_POST['newhelper3'];
	$event->helper4 = $_POST['newhelper4'];
	$event->save();
}

else if (isset($_POST['deleteEvent'])) {
	$event = findOne(Event::class, $_POST['deleteEvent']);
	$event->delete();
}

if(isset($_POST['showAllEvent'])){
	$events = findAll(Event::class);
} else {
	$events = showActualEvent();
	
}
$members = findAll(Member::class);
if(isset($_SESSION['password']) || isset($_SESSION['memberpassword'])){
	echo $twig->render('admin/adminEventList.twig', [
		"isShowAllEvent" => isset($_POST['showAllEvent']),
		"events" => $events,
		"members" => $members,
		"modifyEventPick" => @$_POST['modifyEventPick'],
		"isAdmin" => isset($_SESSION['password'])
	]);

	if(isset($_SESSION['password'])){
		echo $twig->render('toAdmin.twig');
	}

	echo $twig->render('logout.twig');

 }



?>
</div>