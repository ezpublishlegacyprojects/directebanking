<div class="context-block">
    <div class="box-header">
        <div class="box-tc">
            <div class="box-ml">
                <div class="box-mr">
                    <div class="box-tl">
                        <div class="box-tr">
                            <div>
                                <h2 class="context-title">{'XML-Interface'|i18n('extension/directebanking/modules')}</h2>
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
                    {if and(is_set( $xml ), not($xml.errors) )}
                        {if $xml.transactions}
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
                            <tbody>
                                <tr>
                                    <th>TransaktionsID</th>
                                    <th>Absender</th>
                                    <th>Knt.Nr</th>
                                    <th>BLZ</th>
                                    <th>Betrag</th>
                                    <th>W&auml;hrung</th>
                                    <th>Verwendungszweck</th>
                                    <th>Datum</th>
                                    <th>Bestell-ID</th>
                                </tr>
                                {foreach $xml.transactions as $tra sequence array('bgdark','bglight') as $sequence}
                                    <tr valign="top" class="{$sequence}">
                                        <td>{$tra.transaction_id}</td>
                                        <td>{$tra.sender_holder}</td>
                                        <td>{$tra.sender_account_number}</td>
                                        <td>{$tra.sender_bank_code}</td>
                                        <td>{$tra.amount}</td>
                                        <td>{$tra.currency_id}</td>
                                        <td>{$tra.reason_1}</td>
                                        <td>{$tra.timestamp|l10n('shortdate')}</td>
                                        <td><a href="{concat('/shop/orderview/',$tra.user_variable_1)|ezurl(no)}">{$tra.user_variable_1}</a></td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                        {/if}
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
                            <tr>
                                <th>UserID</th>
                                <th>ProjectID</th>
                                <th>Datum Beginn</th>
                                <th>Datum Ende</th>
                                <th>Anzahl Transaktionen</th>
                            </tr>
                            <tr>
                                <td>{$xml.footer.user_id}</td>
                                <td>{$xml.footer.project_id}</td>
                                <td>{$xml.footer.begin_datetime}</td>
                                <td>{$xml.footer.end_datetime}</td>
                                <td>{$xml.footer.transaction_quantity}</td>
                            </tr>
                        </table>
                    {else}
                        {if and(is_set( $xml ), $xml.errors)}
                            <h3>{$xml.errors}</h3>
                        {/if}
                        <script type="text/javascript" src="{'javascript/jscal2.js'|ezdesign(no)}"></script>
                        <script type="text/javascript" src="{'javascript/de.js'|ezdesign(no)}"></script>
                        <form method="post" action="{'/directebanking/xml'|ezurl(no)}">
                            <label>UserID: <b>{ezini( 'EbankingSettings', 'UserID', 'directebanking.ini' )}</b></label><br />
                            <label>ProjectID: <b>{ezini( 'EbankingSettings', 'ProjectID', 'directebanking.ini' )}</b></label><br />
                            <label>Passwort: <input type="password" value="" name="UserPassword" /></label><br />
                            <div><b>TS von: </b><input id="tsfrom" type="hidden" value="{if $TSFrom}{$TSFrom}{else}{currentdate()}{/if}" name="TSFrom" /><span id="TSFromV"></span><input type="button" value="..." id="tsfrombutton"></div><br />
                            <div><b>TS bis: </b><input id="tsto" type="hidden" value="{if $TSTo}{$TSTo}{else}{currentdate()}{/if}" name="TSTo" /><span id="TSToV"></span><input type="button" value="..." id="tstobutton"></div><br />
                            {literal}
                            <script>
                                cal1 = Calendar.setup({
                                    trigger    : "tsfrombutton",
                                    inputField : "tsfrom",
                                    dateFormat : "%s",
                                    date       : {/literal}{if $TSFrom}{$TSFrom|datetime( 'custom', '%Y%m%d' )}{else}{currentdate()|datetime( 'custom', '%Y%m%d' )}{/if}{literal},
                                    onSelect   : function()
                                    {
                                        document.getElementById('TSFromV').innerHTML = Calendar.intToDate(this.selection.get());
                                        var date = Calendar.intToDate(this.selection.get());
                                        cal2.args.min = date;
                                        cal2.redraw();  
                                        this.hide();
                                    }
                                });
                                cal2 = Calendar.setup({
                                    trigger    : "tstobutton",
                                    inputField : "tsto",
                                    dateFormat : "%s",
                                    date       : {/literal}{if $TSTo}{$TSTo|datetime( 'custom', '%Y%m%d' )}{else}{currentdate()|datetime( 'custom', '%Y%m%d' )}{/if}{literal},
                                    onSelect   : function()
                                    {
                                        document.getElementById('TSToV').innerHTML = Calendar.intToDate(this.selection.get());
                                        var date = Calendar.intToDate(this.selection.get());
                                        cal1.args.max = date;
                                        cal1.redraw();  
                                        this.hide();
                                    }
                                });
                                cal1.selection.set({/literal}{if $TSFrom}{$TSFrom|datetime( 'custom', '%Y%m%d' )}{else}{currentdate()|datetime( 'custom', '%Y%m%d' )}{/if}{literal});
                                cal2.selection.set({/literal}{if $TSTo}{$TSTo|datetime( 'custom', '%Y%m%d' )}{else}{currentdate()|datetime( 'custom', '%Y%m%d' )}{/if}{literal});
                            </script>
                            {/literal}
                            <p><input type="submit" name="GetXML" value="{'Submit'|i18n('extension/directebanking/common')}" /></p>
                        </form>
                    {/if}
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
