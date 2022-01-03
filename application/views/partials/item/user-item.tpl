{if $current_user.id != $user.user_id}
    <div class="user-list-item {if isset( $smarty.get._uid ) && $user.id == $utils::decrypt($smarty.get._uid)}current_active{/if}">
        <div class="card mb-2">
            <div class="card-body">
                <div class="media-user row">
                    <div class="col-sm-3">
                        {if isset($smarty.get.dep)}
                            {assign var='dep_selected' value='&dep='|cat:$smarty.get.dep}
                        {else}
                            {assign var='dep_selected' value=''}
                        {/if}
                        <a class="{if !$user.is_evaluated}not-evaluated{/if}" href="{if $account == COMPTE_EVALUATEUR}{$user._url_action}{$dep_selected}{elseif $account == COMPTE_AUTORITE}/evaluations/notes_agent/?_uid={$utils::encrypt($user.id)}{$dep_selected}{else}#{/if}">
                            {assign var="file_user_photo" value=PATH_ROOT_DIR|cat:'/upload/'|cat:$user.id|cat:'.'|cat:$user.type_photo}
                            {*if file_exists($file_user_photo)}
                                {assign var="user_photo" value='/upload'|cat:'/'|cat:$user.id|cat:'.'|cat:$user.type_photo}
                            {else}
                                {assign var="user_photo" value='/application/modules/evaluations/assets/images/user.png'}
                            {/if*}
                            {if file_exists($file_user_photo)}
                                {assign var="user_photo" value=base_url('/upload')|cat:'/'|cat:$user.id|cat:'.'|cat:$user.type_photo}
                            {else}
                                {assign var="user_photo" value=base_url('/application/modules/evaluations/assets/images/user.png')}
                            {/if}
                            <img class="rounded-circle {if !$user.is_evaluated}not-evaluated-img{/if}" src="{$user_photo}" width="50" height="50" alt="">
                            <!--img class="rounded-circle {if !$user.is_evaluated}not-evaluated{/if}" src="{*$utils::resize($image_lib, $user_photo)*}" width="50" height="50" alt=""-->
                        </a>
                    </div>
                    <div class="col-sm-9">
                        <a href="{if $account == COMPTE_EVALUATEUR}{$user._url_action}{$dep_selected}{elseif $account == COMPTE_AUTORITE}/evaluations/notes_agent/?_uid={$utils::encrypt($user.id)}{$dep_selected}{else}#{/if}">
                            <span class="fullname">{$user.nom} {$user.prenom}</span><br>
                            <span class="matricule"><small>{$user.matricule}</small></span><br>
                            <span class="job">{$user.poste} {* {$user.user_id} - {$user.id} *}</span>
                        </a>
                    </div>
                </div>
                {if $account == COMPTE_EVALUATEUR}
                    <div class="btn-group" role="group" data-tools-sidebar style="display: none;">
                        <a href="/evaluations/notes_agent/?_uid={$utils::encrypt($user.id)}" class="btn btn-secondary btn-edit">
                            <i class="fa fa-file"></i>
                        </a>
                        <a href="/evaluations/evaluate_user/?_uid={$utils::encrypt($user.id)}" class="btn btn-secondary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a data-uid="{$user.user_id}" href="#" class="btn btn-secondary btn-delete">
                            <span class="fa fa-trash"></span>
                        </a>
                    </div>
                {/if}
            </div>
        </div>
    </div>
{/if}