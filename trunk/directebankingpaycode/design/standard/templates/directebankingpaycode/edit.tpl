<form method="post" action="{'/directebankingpaycode/profile/update'|ezurl(no)}">
<div class="context-block">
    <div class="box-header">
        <div class="box-tc">
            <div class="box-ml">
                <div class="box-mr">
                    <div class="box-tl">
                        <div class="box-tr">
                            <div>
                                <h2 class="context-title">{'Profile'|i18n('extension/directebanking/modules')} {'edit'|i18n('extension/directebanking/modules')}</h2>
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
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
                        <tbody>
                            <tr>
                                <th>[{$block_name}] - {$variable_name}</th>
                            </tr>
                            <tr valign="top" class="bgdark">
                                <td><input type="text" name="VariableValue" value="{$variable_value}" /></td>
                            </tr>
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
                                <input type="hidden" name="BlockName" value="{$block_name}" />
                                <input type="hidden" name="VariableName" value="{$variable_name}" />
                                <input type="submit" name="UpdateProfile" value="{'update'|i18n('extension/directebanking/modules')}" class="button" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
