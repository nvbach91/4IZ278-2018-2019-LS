$(document).ready(function () {
	//Spočítá šířku zápatí
	$headerWidth = 0;
	$(".header").children().each(function () {
		$headerWidth += $(this).width();
	});

	//Zobrazení notifikací
	function notifikaceToggle() {
		$('#notifikaceIkona,#notifikaceCislo').click(function () {
			$("#notifikace").fadeToggle("fast");
			$("#notifikaceCislo").fadeOut("fast");
		});
	}

	//Nastavení pozadí loginu a akce alespoň jako doplnění do výšky okna prohlížeče

	//Spočítá výšku akce
	$akceHeight = $(".akce").height();

	function responsivniAkce() {
		if ($akceHeight > ($(window).height() - $('.headercont').height() - $('.menucont').height())) {
			$('.akce').css('min-height', $akceHeight);
		}
		else {
			$('.akce').css('min-height', $(window).height() - $('.headercont').height() - $('.menucont').height());
		}
	}

	function responsivniRegistrace() {
		if ($(window).height() >= $(document).height()) {
			$('.document').css('height', $(document).height() - $('.headercont').height());
		} else {

		}
	}

	//Vytvoření čtverců u data akce
	$heightdatum = $('.akcedatum').height();
	$widthdatum = $('.akcedatum').width();

	if ($widthdatum > $heightdatum) {
		$('.akcedatum').height($widthdatum);
	}
	else {
		$('.akcedatum').width($heightdatum);
	}

	notifikaceToggle();
	responsivniAkce();
	responsivniRegistrace();

	$(window).resize(function () {
		notifikaceToggle();
		responsivniAkce();
		responsivniRegistrace();
	});
});