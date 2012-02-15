$(document).ready ->
    
    # History API
    stateless = true
    $(window).bind 'popstate', (e) ->
        if not stateless then $.get location.pathname, (data) -> return refresh data
    
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
            refresh data
            window.history.pushState null, null, url
            stateless = false
            return false
    
    # Refresh product list
    refresh = (data) ->
        $('#product-list').fadeOut 250, ->
            $('#product-list').html data
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
    $('#paginator a').live 'click', ->
        url = $(this).attr 'href'
        $.get url, (data) ->
            return refresh data
                
   