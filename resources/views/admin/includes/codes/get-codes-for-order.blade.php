<script type="text/javascript">
    $.ajax({
        dataType: 'json',
        url: "{!! route('codes.index') !!}" + '?category_id=' + currentCategoryId,
        success: function(data) { // What to do if we succeed
            codes = data['codes'];
            var html = '';
            for (var i=0; i < codes.length; i++) {
                html += 
                    '<tr id="' + (i+1) + '">' + 
                        '<td class="order">' + (i+1) + '</td>' +
                        '<td class="txt text-left">' + codes[i]['txt'] + '</td>' +
                    '</tr>';
            }
            $("#workTbody").append(html);
        }
    });
</script> 
