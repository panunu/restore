$(document).ready ->
    $('#filter-toggle').live 'click', (e) ->
        e.preventDefault()
        $('#filter').toggleClass 'minimized'