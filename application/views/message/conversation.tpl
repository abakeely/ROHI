{if $oMessage != null}

    {foreach from=$oMessage item=oMessageView}
    <div id="conversation" class="col-lg-6">
        {if $oMessageView.message_expediteurId == $oUser.id}
            <div class="right clearfix col-lg-3">
                <p>{$oMessageView.message_texte}</p>
            </div>
            {else}
            <div class="left clearfix col-lg-3">
                <p>{$oMessageView.message_texte}</p>
            </div>
        {/if}
    </div>
    {/foreach}
    
    



{/if}

{literal}
<style>
   #conversation {
        width : 100%;
        display: block;
  }
    .right {
        float: right;
        display: block;
     }
    .left {
        float : left;
        display: block;
     }

</style>
{/literal}