$(document).ready ->
    $('#filter-toggle').live 'click', (e) ->
        e.preventDefault()
        $('#filter').toggleClass 'minimized'        
    
    $('#filter a').live 'click', (e) ->
        e.preventDefault()
        $(this).addClass 'active'

        $.get '/app_dev.php/tuotteet/suodata', { category: $(this).data 'slug' }, (data) ->
            $('#product-list').fadeOut 500, ->
                $('#product-list').html data
                $('#product-list').fadeIn 500
                
                