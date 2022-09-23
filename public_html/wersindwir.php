<div class='classTable' id='member'>
	<h1 class='text-3xl font-bold text-center'>Wer sind wir?</h1>
	<br>

	<?php

	use \Rl\Models\Member;

	if(isset($_POST['newMember'])) {
		echo "NEWMEMBER isset<br>";
		$member = new Member();
		// TODO: create form and set $_POST data
		$member->membername = $_POST['membername'];
		$member->memberimg = $_POST['memberimg'];
		$member->memberfunction = $_POST['memberfunction'];
		$member->little_akiba = $_POST['little_akiba'];
		$member->e_mail = $_POST['e_mail'];
		$member->mobile = $_POST['mobile'];
		$member->involved_since = $_POST['involved_since'];
		$member->active = 1;
		$member->save();
	} else if(isset($_POST['modifyMember'])){
		$member = findOne(Member::class, $_POST['modifyMember']);
		$member->memberimg = $_POST['memberimg'];
		$member->membername = $_POST['membername'];
		$member->memberfunction = $_POST['memberfunction'];
		$member->involved_since = $_POST['involved_since'];
		$member->little_akiba = $_POST['little_akiba'];
		$member->e_mail = $_POST['e_mail'];
		$member->mobile = $_POST['mobile'];
		$member->active = $_POST['active'];
		$member->save();
	} else if(isset($_POST['deleteMember'])) {
		$member = findOne(Member::class, $_POST['deleteMember']);
		$member->delete();
	}

	$members = findAll(Member::class);
	echo $twig->render('member/membertable.twig', [
		"isMember" => isset($_SESSION['memberpassword']),
		"isAdmin" => isset($_SESSION['password']),
		'members' => $members,
		'modifyMemberPick' => @$_POST['modifyMemberPick']
	]);
	$dateSample = date("Y-m-d");

	echo $twig->render('member/newMember.twig', ["isAdmin" => isset($_SESSION['password']), "dateSample" => $dateSample]);

	echo $twig->render('member/recruitmember.twig');

	?>

</div>



