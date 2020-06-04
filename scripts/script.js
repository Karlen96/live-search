$(function () {
	let searchInput = $('.search__input');

	$(searchInput).on('input', () => {
		let search = $(searchInput).val();
		if ($(searchInput).val().length != 0) {
			$.ajax({
				url: 'php/search.php',
				type: 'get',
				data: {
					value: search
				},
				success: function (data) {
					let arr = JSON.parse(data);
					chooseOption(arr);
				}
			});
		}
	});

	function chooseOption(array) {
		let searchResult = $('.search__result');
		$(searchResult).html('');
		for (let i = 0; i < array.length; i++) {
			let li = document.createElement('li');
			$(li).html(array[i]);
			$(searchResult).append(li);
		}
		$('.search__result li').on('click', function () {
			$(searchInput).val($(this).text());
			$(searchResult).html('');
		});
	}
});