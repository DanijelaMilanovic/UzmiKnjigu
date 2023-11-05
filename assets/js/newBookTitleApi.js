jQuery(document).ready(function($) {
    $(document).ready(function() {
        let titleSelect = $('#titleSelect');
        $(document).on('change', '#categorySelect', function() {
            let value = $(this).val();
            $.ajax({
                url:"/api/title/"+value,
                type:"GET",
                success: function(result) {
                    let optionHtml = `
                        <option value="-1" selected disabled>Naslov</option>
                    `;

                    console.log(result);
                    console.log(result['titles']);
                    for (let key in result['titles']) {
                        let title = result['titles'][key];
                        optionHtml += `<option value="${title.title_id}">${title.title_name}</option>`
                    }

                    titleSelect.html(optionHtml);
                }
            });
        });
    });
});
