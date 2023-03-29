function initializeSorting() {

    var $elementRows = $(".drag-handle").parents('table.data tbody');

    Sortable.create($elementRows[0], {
		handle: '.drag-handle',
		animation: 150,
		onEnd: function (evt) {
			var $inputs = $(evt.srcElement).find('td>div.drag-handle>input');
			var $form = $('<form style="display: none;">');
			$form
                .append($inputs.clone())
                .request('onReorderRelation', {
					complete: function () {
                        $form.remove();
                        initializeSorting();
					}
				});
		}
    });

}

$(function () {
	initializeSorting();
});
