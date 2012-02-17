class ProductFilter    
    constructor: (path) ->
        @path      = path.slice 0, -1
        @history   = window.History
        @separator = '+'
        @trigger   = true

        @listen()
        @bind()            
        @select()

    listen: ->
        @history.Adapter.bind window, 'statechange', =>
            $.get @history.getState().url, (data) => @refresh data

    bind: ->
        $('#filter .brand a, #filter .category a').live 'click', (event) =>
            $link = $(event.currentTarget).parents('.brand, .category').toggleClass 'active'
            if not $link.hasClass 'active' then $link.addClass 'deselected' else $link.removeClass 'deselected'                
            @filter()
            false

        $('.deselected').live 'mouseout', -> $(this).removeClass 'deselected'

        $('a', '#pagination').live 'click', (event) =>
            @history.pushState null, @history.getState().title, $(event.currentTarget).attr 'href'
            false

    select: ->
        if not @trigger then return @trigger = true

        url = document.location.pathname.split '/'
        $('li.brand.active, li.category.active').removeClass 'active'
        @activate url, 'merkki',    'brand'
        @activate url, 'kategoria', 'category'

    activate: (url, token, target) ->    
        if (index = $.inArray token, url) != -1
            $.map (url[index + 1].split @separator), (value) ->
                $("li.#{target} a[data-slug='#{value}']").parents(".#{target}").addClass 'active' 

    filter: ->
        brands     = ($.map $('.brand.active a'), (brand) => return $(brand).data 'slug').join @separator
        categories = ($.map $('.category.active a'), (category) => return $(category).data 'slug').join @separator

        url = @path
        if brands     then url += '/merkki/'    + brands
        if categories then url += '/kategoria/' + categories

        $.get url, (data) =>
            @trigger = false
            @history.pushState null, @history.getState().title, url

    refresh: (data) ->
        @select()
        $('#product-list').fadeOut 250, ->
            $(this).html data
            $(this).fadeIn 250
            
$(document).ready ->
    new ProductFilter route_product_index # TODO: FOSJSRouting?