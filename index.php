<?php

$TOTAL_SPOTS = 16;

require("postgresql.conf");

pg_connect("host=".DB_settings::$host." port=".DB_settings::$port." dbname=".DB_settings::$database." user=".DB_settings::$user." password=".DB_settings::$password);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = pg_escape_string($_POST['name']);
	$email = pg_escape_string($_POST['email']);

	$sql = "INSERT into signup (name, email) values ('$name', '$email')";
	pg_query($sql);
}

function get_free_spaces_count() {
	global $TOTAL_SPOTS;
	return $TOTAL_SPOTS - get_signup_count();
}

function get_signup_count() {
	$sql = "SELECT count(*) from signup";
	$res = pg_fetch_assoc(pg_query($sql));

	if($res['count'] > 0) {
		return intval($res['count']);
	}

	return 0;
}

?><!DOCTYPE html>
<html>
	<head>
		<title>Ballmer Peak Oslo</title>
		<link rel="icon" type="image/png" href="favicon.png">
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<h1>Ballmer Peak Oslo</h1>
		<p>Ballmer Peak Oslo er Norges først offesielle ballmerpeakathon. Og hva er så det?</p>

		<h2>Ballmerpeakathon?</h2>
		<p>Et ballmerpeakathon har sitt navn fra <a href="http://xkcd.com/323/">denne stripa fra XKCD</a>. TL;DR så er det en god blanding av et <a href="http://en.wikipedia.org/wiki/Hackathon">hackathon</a> og et <a href="http://www.meetup.com/">meetup</a>. Vi kommer sammen, programmerer, og prøver å holde en kostant promille rundt 0,1337‰ noe som i følge mytene vil utløse endeløs kreativitet og uante programmeringsevner.</p>

		<h2>Så hvordan gjør vi det?</h2>
		<p>Vi har vært så heldige å få låne lokalene til verdens kuleste Drupal-nerder, <a href="http://wunderkraut.no/">Wunderkraut</a>, i Brugata 17B. Der skal vi bruke fem timer på å snekre sammen noe spennede på web med god underholdningsverdi. Arrangørene kommer til å stille med ulike domenenavn, og du som deltaker skal velge deg et navn du synes er spennende og hacke i vei. Det vil dannes fire lag og laget som kommmer opp med det beste produktet på slutten av dagen vil få heder, ære og en flott premie. Kunsten er å holde seg på toppen!</p>

		<h2>Så hva må jeg ta med?</h2>
		<p>Det viktigste er deg selv, en datamaskin, godt humør og en god porsjon pågangsmot. Vi vil stille med alkohol til svært overkommelige priser, testservere og god stemning. Våre testservere vil allerede være knyttet opp til domenet du skal hacke på og vil støtte de største språkene og rammeverkene. Vi har allerede satt opp et git repo, så det er bare å klone og kode i vei. Ønsker du støtte for et spesielt rammeverk kan vi sette det opp på serverne, men si i fra i god tid. Husk å være klar med rammeverk og verktøy på maskinen din. Med fem timer til rådighet ønsker du ikke å knot med å sette opp et utviklingsmiljø.</p>

		<h2>Så når skjer det?</h2>
		<p>Neste ballmerpeakathon skjer <time datetime="2013-01-12">lørdag den 12. januar 2013</time> (tidspunkt blir annonsert). Når kodingen er over for dagen tar vi en skikkelig fest for å feire produktiviteten, så ikke legg planer for kvelden!</p>

		<h2>Ok, nå er jeg skikkelig gira. Hvor møter jeg opp?</h2>
		Vi har vært så heldige å få låne flotte lokaler fra Wunderkraut i Brugata 17B.<br />
		<iframe class="map" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Brugata+17B,+Oslo,+Norge&amp;aq=0&amp;oq=Brugata+17B+o&amp;sll=60.964182,8.565002&amp;sspn=5.133776,14.227295&amp;t=w&amp;ie=UTF8&amp;hq=&amp;hnear=Brugata+17B,+Gr%C3%BCnerl%C3%B8kka,+0186+Oslo,+Norway&amp;z=14&amp;ll=59.914055,10.757454&amp;output=embed"></iframe>

		<h2>Overbevist?</h2>
		<? if(($free_spaces = get_free_spaces_count()) > 0): ?>
		<p>Meld deg på her! Det er for tiden <?php echo $free_spaces; ?> ledige plasser.</p>
		<form action="index.php" method="post">
			<label for="name">Navn</label>
			<input name="name" type="text" placeholder="Alan Turing">

			<label for="email">Epost<label>
			<input name="email" type="text" placeholder="ballmer@msft.com">

			<input type="submit" value="Meld på">
		</form>
		<?else: ?>
		<p>Vi er desverre fulltegnet for denne gang, men følg med! Det kommer alltid en neste :)</p>
		<?endif;?>
		
		<!-- Piwik --> 
		<script type="text/javascript">
		var pkBaseURL = (("https:" == document.location.protocol) ? "https://stats.rixim.no/" : "http://stats.rixim.no/");
		document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
		</script><script type="text/javascript">
		try {
		var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 2);
		piwikTracker.trackPageView();
		piwikTracker.enableLinkTracking();
		} catch( err ) {}
		</script><noscript><p><img src="http://stats.rixim.no/piwik.php?idsite=2" style="border:0" alt="" /></p></noscript>
		<!-- End Piwik Tracking Code -->
	</body>
</html>

<?php /* vi: se noet: */ ?>
