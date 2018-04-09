<script type="text/javascript">
    $.ajax({
        dataType: 'json',
        url: "{!! route('categories.index') !!}",
        success: function(data) { // What to do if we succeed
            maxOrder = data['max_order'];
            categories = data['categories'];
            var html = '';

            for (var i=0; i < categories.length; i++) {
                html += 
                    '<tr id="' + (i+1) + '">' + 
                        '<td class="order">' + (i+1) + '</td>' +
                        '<td class="txt text-left">' + categories[i]['txt'] + '</td>' +
                    '</tr>';
            }
            $("#workTbody").append(html);
        }
    });
</script> 
