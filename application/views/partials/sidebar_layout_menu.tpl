{function submenu_render level='first-level'}
    {if $data.data.has_child}
        {if isset($sub_menu[$data.data.key])}
            <ul aria-expanded="false" class="collapse {$level}">
                {foreach from=$sub_menu[$data.data.key] item=sub_menu_item}
                    <li class="sidebar-item">{$sub_menu_item.html}
                    {if $sub_menu_item.data.has_child}
                        {submenu_render data=$sub_menu_item level='second-level'}
                    {/if}
                    </li>
                {/foreach}
            </ul>
        {/if}
    {/if}
{/function}
<ul id="sidebarnav">
    <li class="p-15 mt-4 mb-4">&nbsp;</li>
    {foreach from=$parent_menu item=menu}
    <li class="sidebar-item">
        {$menu.html}
        {submenu_render data=$menu}
        {*if $menu.data.has_child}
            {if isset($sub_menu[$menu.data.key])}
                <ul aria-expanded="false" class="collapse  first-level">
                    {foreach from=$sub_menu[$menu.data.key] item=sub_menu_item}
                        <li class="sidebar-item">{$sub_menu_item.html}</li>
                    {/foreach}
                </ul>
            {/if}
        {/if*}
    </li>
    {/foreach}
</ul>