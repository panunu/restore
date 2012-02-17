$(document).ready ->
    
    # History API
    History = window.History
    History.Adapter.bind window, 'statechange', ->
        $.get History.getState().url, (data) ->
            return refresh data
            
    # Refresh filter selection
    selection = ->
        url = document.location.pathname.split '/'
        $('li.brand.active, li.category.active').removeClass 'active'
        activate url, 'merkki',    'brand'
        activate url, 'kategoria', 'category'                       
            
    activate = (url, token, target) ->    
        if (index = $.inArray(token, url)) != -1
            $.map (url[index + 1].split '+'), (value) ->
                $("li.#{target} a[data-slug=" + value + "]").parents(".#{target}").addClass 'active' 
            
    selection()
    
    # Filter by brands and categories
    $('#filter .brand a, #filter .category a').live 'click', ->
        $link = $(this).parents('.brand, .category').toggleClass 'active'
        if not $link.hasClass 'active' then $link.addClass 'deselected' else $link.removeClass 'deselected'
        filter()
        return false

    # Filter products
    filter = ->
        separator  = '+'
        brands     = ($.map $('.brand.active a'), (brand) -> return $(brand).data 'slug').join separator
        categories = ($.map $('.category.active a'), (category) -> return $(category).data 'slug').join separator
        
        url = '/app_dev.php/tuotteet'
        if brands     then url += '/merkki/'    + brands
        if categories then url += '/kategoria/' + categories

        return $.get url, (data) ->
            History.pushState null, History.getState().title, url
    
    # Refresh product list
    refresh = (data) ->
        $('#product-list').fadeOut 250, ->
            $('#product-list').html data            
            selection()
            $('#product-list').fadeIn 250
            return false

    # Deselected filter behaviour
    $('.deselected').live 'mouseout', (e) -> $(this).removeClass 'deselected'
    
    # TODO: Show all categories and brands
    
    # Toggle filter visibility
    $('#filter-toggle').live 'click', ->
        $('#filter').toggleClass 'minimized'      
        return false
        
    # Ajaxify pagination
    $('a', '#pagination').live 'click', ->
        History.pushState null, History.getState().title, $(this).attr 'href'
        return false