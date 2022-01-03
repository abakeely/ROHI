
    <a
            class="sidebar-link {if $menu_item.has_child}has-arrow waves-effect waves-dark{/if}"
            href="{if !$menu_item.has_child}{base_url($target)}{else}javascript:void(0){/if}"
            {if $menu_item.has_child}aria-expanded="false"{/if} item-current="{if $current}1{else}0{/if}">
        {if $menu_item.icon_image == null}
            <i class="{$menu_item.icon_html}"></i>
        {else}
            <img src="{$menu_item.icon_image}" alt="">
        {/if}
        
        <span class="hide-menu">{$menu_item.label} </span>
    </a>
    {$sub_menu}
