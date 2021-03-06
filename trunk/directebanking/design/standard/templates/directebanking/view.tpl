<div class="context-block">
    <div class="box-header">
        <div class="box-tc">
            <div class="box-ml">
                <div class="box-mr">
                    <div class="box-tl">
                        <div class="box-tr">
                            <div>
                                <h2 class="context-title">{'Profile'|i18n('extension/directebanking/modules')} {'view'|i18n('extension/directebanking/modules')}</h2>
                            </div>
                            <div class="header-mainline"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-ml">
        <div class="box-mr">
            <div class="box-content">
                <div class="context-attributes">
                    <h3>Die Bezahlung erfolgt w&auml;hrend des Bestellvorgangs. Der Kunde wird nach der Bezahlung zur&uuml;ck zum Shop geleitet und die Bestellung wird abgeschlossen.</h3>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
                        <tbody>
                            {foreach $settings as $name => $setting}
                                <tr>
                                    <th width="50%">{$name} ({$setting|count()})</th>
                                    <th width="50%">{'value'|i18n('extension/directebanking/modules')}</th>
                                    <th class="tight"></th>
                                </tr>
                                {foreach $setting as $set_name => $set_value sequence array('bgdark','bglight') as $sequence}
                                    <tr valign="top" class="{$sequence}">
                                        <td width="50%">{$set_name}</td>
                                        <td width="50%">{$set_value}</td>
                                        <td width="1" align="right">
                                            <form method="post" action="{'/directebanking/profile/edit'|ezurl(no)}">
                                                <input type="hidden" name="BlockName" value="{$name}" />
                                                <input type="hidden" name="VariableName" value="{$set_name}" />
                                                <input type="image" name="EditSettings" value="" src="{'edit.gif'|ezimage(no)}"/>
                                            </form>
                                        </td>
                                    </tr>
                                {/foreach}
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="controlbar">
        <div class="box-bc">
            <div class="box-ml">
                <div class="box-mr">
                    <div class="box-tc">
                        <div class="box-bl">
                            <div class="box-br">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
